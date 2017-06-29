<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'libraries/Base_lib.php';

class Booking_lib extends Base_lib{

    var $model;

    function __construct() {
        $this->ci = &get_instance();
        $this->getModel();
    }

    function getModel() {
        $this->ci->load->model('booking_model');
        $this->model = $this->ci->booking_model;
    }

    function get_user() {
        $user_id = $this->ci->session->userdata('user_id');
        return $this->model->get_user_data($user_id);
    }

    function check_user_email($email) {

        $checkemail = $this->model->check_email($email);
        if (!empty($checkemail)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function getMyAccountUrl(){

        $this->ci->data['myAccountUrl'] = "home.html";
        if($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_USER_NAME ){ 
            $this->ci->data['myAccountUrl'] = "user_home.html";
        }else if( $this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME){
            $this->ci->data['myAccountUrl'] = "admin_home.html";
        }else if($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME){
            $this->ci->data['myAccountUrl'] = "vendor_home.html";
        }else if($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME){
            $this->ci->data['myAccountUrl'] = "vendor_home.html";
        }

    }

    /**
     *
     * Create new user in the Db 
     *
     * @param	array	$data	array of person data
     * @param 	array 	$condition multiple conditions in array format
     * @return	nil
     */
    function _create_user($user_data) {

        $person_id = $this->model->insert($user_data);
        return $person_id;
    }

    function _checkServiceAvailable() {

        $this->resetResponse();
        if(isset($_POST['pincode']) && !empty($_POST['pincode'])){
            $pincode = $this->ci->input->post('pincode', true);
            $this->ci->session->set_userdata('service_location_search',$pincode);
            
        }else if($this->ci->session->userdata('service_location_search') !== null){
            $pincode = $this->ci->session->userdata('service_location_search');
        }
        
        $result = $this->model->get_tb('mm_vendor_service_location','*',array('vendor_service_location_postcode'=>$pincode, 'vendor_service_location_archived'=>Globals::UN_ARCHIVE))->result();
        
        if ($result) {
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $result;

        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('no_records_found');
            $this->_rdata = array();
        }
       return $this->getResponse();
    }
    
    
    function _getServices($data){
        $this->resetResponse();
        $postcode = $this->ci->security->xss_clean($data->postcode);
        $services = $this->model->get_tb('mm_services', 'service_id,service_name', array('service_archived' => 0))->result();
        
        if ($services) {
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $services;

        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('no_records_found');
            $this->_rdata = array();
        }
       return $this->getResponse();
    }
    
    
    function _getServicePackages($data){
        $this->resetResponse();
        $postcode = $this->ci->security->xss_clean($data->postcode);
        $serviceIds = $this->ci->security->xss_clean($data->serviceId);
        $packages = $this->model->getServicePackages($serviceIds);
        
        if ($packages) {
            $array = array();
            foreach($packages as $pack){
                $postPrice = $this->model->getPackagePostcodePrice($pack->service_package_id, $postcode);
                
                if($postPrice){
                    $temp = array("spl_price"=> $postPrice[0]->postcode_service_price_price ,"package"=>$pack);
                }else{
                    $temp = array("spl_price"=> null,"package"=>$pack);
                }
                $array[$pack->service_package_service_id][$pack->service_package_id] = $temp;
            }
            
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $array;           

        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('no_records_found');
            $this->_rdata = array();
        }
        return $this->getResponse();
    }
    
    
    function _getServiceFrequencies($data){
        
        $this->resetResponse();
        $postcode = $this->ci->security->xss_clean($data->postcode);
        $serviceIds = $this->ci->security->xss_clean($data->serviceId);
        $frequencies = $this->model->getServiceFrequencies($serviceIds);
        if ($frequencies) {
            $array = array();
            foreach($frequencies as $freq){
                $array[$freq->service_frequency_offer_service_id][$freq->service_frequency_offer_id] = $freq;
            }
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $array;           

        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('no_records_found');
            $this->_rdata = array();
        }
        return $this->getResponse();
        
    }
    
    
    function _getServiceAddons($data){
        
        $this->resetResponse();
        $postcode = $this->ci->security->xss_clean($data->postcode);
        $serviceIds = $this->ci->security->xss_clean($data->serviceId);
        $addons = $this->model->getServiceAddons($serviceIds);
        if ($addons) {
            $array = array();
            foreach($addons as $addon){
                $array[$addon->service_addon_price_service_id][$addon->service_addon_price_id] = $addon;
            }
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $array;           

        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('no_records_found');
            $this->_rdata = array();
        }
        return $this->getResponse(); 
    }
    
    function _getServiceSplRequests($data){
        
        $this->resetResponse();
        $postcode = $this->ci->security->xss_clean($data->postcode);
        $serviceIds = $this->ci->security->xss_clean($data->serviceId);
        $splRequests = $this->model->getServiceSplRequests($serviceIds);
        if ($splRequests) {
            $array = array();
            foreach($splRequests as $splRequest){
                $array[$splRequest->service_spl_request_service_id][$splRequest->service_spl_request_id] = $splRequest;
            }
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $array;
            
        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('no_records_found');
            $this->_rdata = array();
            
        }
        return $this->getResponse(); 
    }
    
    
    /* Save Booking Information */
    function _saveServiceBooking($data){
        //print_r($data); exit;
        $this->ci->load->library('form_validation');

        $this->resetResponse();
        $this->_status = TRUE;
        
        if(!isset($data->service) || $data->service =='' || $data->service == null){
            $this->_status = FALSE;
        }
        
        if(!isset($data->package) || $data->package =='' || $data->package == null){
            $this->_status = FALSE;
        }
        
        if(!isset($data->servicePostcode) || $data->servicePostcode =='' || $data->servicePostcode == null){
            $this->_status = FALSE;
        }
        
        if($this->_status){
            $service_pincode = $data->servicePostcode;
            
            $result = $this->model->getVendorAndServiceDetails($service_pincode);
            if ($result) {
                $vendorIds = array();
                foreach($result as $val){
                    $vendorIds[] = array("id"=>$val->vendor_service_location_vendor_id,"mobile"=>$val->person_mobile);
                }
                
                if(!empty($vendorIds)){                   
                                        
                    if($this->ci->session->userdata('user_id') == null){
                        if(!isset($data->userInfo->email) || $data->userInfo->email =='' || $data->userInfo->email == null){
                            $this->_status = FALSE;
                        }
                        if(!isset($data->userInfo->pass) || $data->userInfo->pass =='' || $data->userInfo->pass == null){
                            $this->_status = FALSE;
                        }
                        if(!isset($data->userInfo->address) || $data->userInfo->address =='' || $data->userInfo->address == null){
                            $this->_status = FALSE;
                        }
                        if(!isset($data->userInfo->city) || $data->userInfo->city =='' || $data->userInfo->city == null){
                            $this->_status = FALSE;
                        }
                        if(!isset($data->userInfo->state) || $data->userInfo->state =='' || $data->userInfo->state == null){
                            $this->_status = FALSE;
                        }
                        if(!isset($data->userInfo->phone) || $data->userInfo->phone =='' || $data->userInfo->phone == null){
                            $this->_status = FALSE;
                        }
                        if(!isset($data->userInfo->pincode) || $data->userInfo->pincode =='' || $data->userInfo->pincode == null){
                            $this->_status = FALSE;
                        }
                        if(!isset($data->userInfo->firstName) || $data->userInfo->firstName =='' || $data->userInfo->firstName == null){
                            $this->_status = FALSE;
                        }
                        if(!isset($data->userInfo->lastName) || $data->userInfo->lastName =='' || $data->userInfo->lastName == null){
                            $this->_status = FALSE;
                        }
                        
                        if($this->_status){
                            $user_info = array();
                            $user_info['person_first_name']     = $data->userInfo->firstName;
                            $user_info['person_last_name']      = $data->userInfo->lastName;
                            $user_info['person_email']          = $data->userInfo->email;
                            $user_info['person_password']       = hash('sha512', $data->userInfo->pass);
                            $user_info['person_address']        = $data->userInfo->address;
                            $user_info['person_city']           = $data->userInfo->city;
                            $user_info['person_state']          = $data->userInfo->state;
                            $user_info['person_mobile']         = $data->userInfo->phone;
                            $user_info['person_postal_code']    = $data->userInfo->pincode;
                            $user_info['person_country_code']   = "my";
                            $user_info['person_lang_code']      = "en";
                            $user_info['person_type']           = Globals::PERSON_TYPE_USER; /* Person_type = 1 ==> 'user' type */
                            $this -> ci -> load-> library('person_lib');
                            $result = $this->ci->person_lib->booking_user_registration($user_info);
                            if($result['status']){
                                $user = $this->model->getUserDetails('person_id, person_email, person_first_name, person_last_name, person_id, person_type_name, person_lang_code, person_status, person_profile_image, person_country_code, person_type, person_type_name', array('person_email' => $user_info['person_email'], 'person_password' => $user_info['person_password'], 'person_status' => 1))->row();

                                $this->ci->person_lib->_set_last_ip_and_last_login($user->person_id);
                                $this->ci->person_lib->_set_session($user->person_type_name, $user);
                            }else{
                                $this->_status = false;
                                $this->_message = $result['message'];
                                $this->_rdata = null;
                                return $this->getResponse();
                            }
                        }else{
                            $this->_status = false;
                            $this->_message = 'Data missing';
                            $this->_rdata = null;
                            return $this->getResponse();
                        }
                    }
                    
                    $info = array();
                    $info['booking_service_id']     = $data->service;
                    $info['booking_package_id']     = $data->package;
                    $info['booking_pincode']        = $data->servicePostcode;
                    $info['booking_booked_on']      = date('Y-m-d H:i:s', strtotime('now'));
                    $info['booking_amount']         = $data->totalPrice;
                    $info['booking_payment_status'] = Globals::PAYMENT_PENDING;
                    $info['booking_status']         = Globals::BOOKING_PROCESSING;
                    $info['booking_service_date']   = $data->userInfo->serviceDate;
                    $info['booking_note']           = $data->userInfo->note;
                    $info['booking_user_id']        = $this->ci->session->userdata('user_id');
                    $info['booking_order_id']       = substr(md5(uniqid("bookingOrderId12345678904238472984MyMaidz", true)), 0, 20);
                    //$info['booking_contact_status'] = $data->userInfo->contactStatus;
                    $booking_id = $this->model->insert_tb('mm_booking', $info);
                    if($booking_id > 0){
                                              
                        $res = $this->prePaymentSetup($booking_id);
                        if($res['status']){
                            $this->_status = true;
                            $this->_message = 'Booking Recorded. Redirecting for Payment Gateway.';
                            $this->_rdata = $res['payData'];
                        }else{
                            $this->_status = true;
                            $this->_message = 'Booking Recorded. But soemthing Went Wrong. Please try again.';
                            $this->_rdata = $res['payData'];
                        }

                    }
                }else{
                    $this->_status = false;
                    $this->_message = 'No Vendor/s available';
                    $this->_rdata = null;
                }
            }else{
                $this->_status = false;
                $this->_message = 'Service Not Available for this Pincode.';
                $this->_rdata = null;
            }
        }else{
            $this->_status = false;
            $this->_message = 'Data missing';
            $this->_rdata = null;
        }
        
        return $this->getResponse();
        
    }
    
    /*
     * Function to get the user details
     */
    function _getUserDeatils(){
        $this->resetResponse();
        if($this->ci->session->userdata('user_id') != null){
            $person_id = $this->ci->session->userdata('user_id');
            $result = $this->model->get_tb('mm_person', 'person_first_name, person_last_name, person_email, person_address, person_address1, person_city, person_state, person_mobile, person_postal_code', array('person_id'=>$person_id))->result();
            if($result){
                $this->_status = true;
                $this->_message = '';
                $this->_rdata = $result;
            }else{
                $this->_status = false;
                $this->_message = '';
                $this->_rdata = array();
            }
        }else{
            $this->_status = false;
            $this->_message = '';
            $this->_rdata = array();
        }
        
        return $this->getResponse();
    }

    
    /*
     * Function to request for payment for the booking
     */
    function prePaymentSetup($booking_id){
        
        $booking_info = $this->model->getServiceBookingDetail($booking_id);       
        //get required Payment form data
        $payData = $this->getPaymentRequestData($booking_info[0]);
        $response = array();
        
        $data = array();
        $data['payment_attempt_for']            = "service booking";
        $data['payment_attempt_for_id']         = $booking_id;
        $data['payment_attempt_order_id']       = $payData['payment_order_id'];
        $data['payment_attempt_invoice_id']     = $payData['payment_id'];
        $data['payment_attempt_person_id']      = $this->ci->session->userdata('user_id');
        $data['payment_attempt_amount']         = $booking_info[0]->booking_amount;
        $data['payment_attempt_hash_value']     = $payData['payment_hash_value'];
        $data['payment_attempt_description']    = $payData['payment_desc'];
        $insertId = $this->model->insert_tb('mm_payment_attempt', $data);
        unset($data);
        if($insertId > 0){
            $response = array('status'=>true, 'payData'=>$payData);
        }else{
            $response = array('status'=>false, 'payData'=>array());
        }
        return $response;
    }
    
    
    function getPaymentRequestData($info){
        //Invoice Id must be unique for each Payment Gateway Request( USed for Invoice Id)
        $invoice_id = substr(md5(uniqid("ServiceInvoiceId1234567890abcdefghijklmnopqrstuvwxyzMyMaidz", true)), 0, 20);
        
        $pay_data = array();
        $pay_data['payment_url']                = $this->ci->data['config']['payment_test_url'];
        $pay_data['payment_pass']               = $this->ci->data['config']['payment_test_pass'];
        $pay_data['payment_transaction_type']   = 'SALE';
        $pay_data['payment_method']             = 'ANY';
        $pay_data['payment_service_id']         = $this->ci->data['config']['payment_test_service_id'];
        $pay_data['payment_order_id']           = $info->booking_order_id;
        $pay_data['payment_id']                 = $invoice_id;
        $pay_data['payment_desc']               = 'Payment Testing';
        $pay_data['payment_merchant_name']      = $this->ci->data['config']['payment_test_merchant_name'];
        $pay_data['payment_return_url']         = $this->ci->data['config']['payment_test_return_url'];
        $pay_data['payment_callback_url']       = ($this->ci->data['config']['payment_test_callback_url'] != null) ? $this->ci->data['config']['payment_test_callback_url'] : '';
        $pay_data['payment_amount']             = '1.00'; //$info->booking_amount;
        $pay_data['payment_currency_code']      = 'MYR';
        $pay_data['payment_customer_ip']        = '192.168.43.55';
        $pay_data['payment_customer_name']      = $info->person_first_name.' '. $info->person_last_name;
        $pay_data['payment_customer_email']     = $info->person_email;
        $pay_data['payment_customer_phone']     = $info->person_mobile;
        $pay_data['payment_token']              = '';
        $pay_data['payment_terms_url']          = $this->ci->data['config']['payment_test_terms_url'];
        $pay_data['payment_language_code']      = 'en';
        $pay_data['payment_page_timeout']       = '780';
       
        // $Password.$ServiceID.$PaymentID.$MerchantReturnURL.$Amount.$CurrencyCode.$CustIP.$PageTimeout;
        $HashString = $pay_data['payment_pass'].$pay_data['payment_service_id'].$pay_data['payment_id'].$pay_data['payment_return_url'].$pay_data['payment_amount'].$pay_data['payment_currency_code'].$pay_data['payment_customer_ip'].$pay_data['payment_page_timeout'];

        $pay_data['payment_hash_value'] = hash("SHA256", $HashString);

        return $pay_data;
    }
    
    
    function _checkPayResponse(){
        $this->resetResponse();
        $flag = 1;
        if(isset($_POST['PaymentID']) && $_POST['PaymentID'] != ''){
            $flag = (int)($flag * 1);
        } else {
            $flag = (int)($flag * 0); 
            
        }
        
        if(isset($_POST['OrderNumber']) && $_POST['OrderNumber'] != ''){
            $flag = (int)($flag * 1);
        } else {
            $flag = (int)($flag * 0); 
            
        }
        
        if(isset($_POST['TxnStatus']) && $_POST['TxnStatus'] != ''){
            $flag = (int)($flag * 1);
        } else {
            $flag = (int)($flag * 0); 
            
        }
        
        if(isset($_POST['HashValue']) && $_POST['HashValue'] != ''){
            $flag = (int)($flag * 1);
        } else {
            $flag = (int)($flag * 0); 
            
        }
        
        if($flag === 1){
            $payment_status = $this->ci->input->post('TxnStatus', true);
            $payment_id = $this->ci->input->post('PaymentID', true);
            $order_number = $this->ci->input->post('OrderNumber', true);
            $resp_msg = $this->ci->input->post('TxnMessage', true);
            $hash_value = $this->ci->input->post('HashValue', true);
            
            $now = date('Y-m-d H:i:s', strtotime('now'));
            
            if($payment_status == '0'){
                
                $info = $this->model->get_tb('mm_payment_attempt', '*', array('payment_attempt_order_id'=>$order_number, 'payment_attempt_invoice_id'=>$payment_id))->result();
                if(!empty($info)){
                    $pay_attempt_id = $info[0]->payment_attempt_id;
                    $booking_id = $info[0]->payment_attempt_for_id;
                    
                    $this->model->update_tb('mm_booking', array('booking_id'=>$booking_id), array('booking_payment_status'=> Globals::PAYMENT_SUCCESS));
                    
                    $this->model->update_tb('mm_payment_attempt', array('payment_attempt_id'=>$pay_attempt_id), array('payment_attempt_response_status_id'=>$payment_status, 'payment_attempt_response_time'=>$now, 'payment_attempt_response_status_message'=>$resp_msg, 'payment_attempt_response_hash_value'=>$hash_value));
                    
                    $booking_detail = $this->model->getServiceBookingDetail($booking_id);
                    
                    $result = $this->model->getVendorAndServiceDetails($booking_detail[0]->booking_pincode);
                    if($result) {
                        
                        foreach($result as $val){                           
                            //SMS
                            $this->sendSMS("+60".$val->person_mobile, "New Service request from user for the date: ".$booking_detail[0]->booking_service_date);                     
                        }   
                    }
                    //SMS to User
                    $this->sendSMS("+60".$booking_detail[0]->person_mobile, "Your Service request has been placed successfully. The Service date is: ".$booking_detail[0]->booking_service_date); 
                        
                    $this->_status = true;
                    $this->_message = 'Transaction Successfull!';
                    $this->_rdata = null;
                
                }else{
                    $this->_status = false;
                    $this->_message = 'Order Information Missing!';
                    $this->_rdata = null;
                }
                
            }else if($payment_status == '1'){
                
                $this->_status = false;
                $this->_message = 'Transaction Failed!';
                $this->_rdata = null;
            }else if($payment_status == '2'){
                $this->_status = false;
                $this->_message = 'Transaction Under process!';
                $this->_rdata = null;
            }
            
        }
        
        return $this->getResponse();
    }
}
