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
    
    function _service_request_submission(){
        $this->resetResponse();
        $this->ci->load->library('form_validation');

        $this->ci->form_validation->set_rules('requester_name', 'Name', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('requester_email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('requester_postcode', 'Postcode', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('requesterTelNum', 'Telephone Number', 'trim|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $errors = $this->ci->form_validation->error_array();           
            $message = "<ul>";

            foreach ($errors as $key => $value) {
                $message .= "<li>".$value."</li>";
            }
            $message .= "</ul>";
            $this->_status = false;
            $this->_message = $message;
            $this->_rdata = array();
            
        } else {
            
            $info = array();
            $info['request_email']      = $this->ci->input->post('requester_email', true);
            $info['request_name']       = $this->ci->input->post('requester_name', true);
            $info['request_postcode']   = $this->ci->input->post('requester_postcode', true);
            $info['request_tel_number'] = $this->ci->input->post('requester_tel_number', true);

            $insert_id = $this->model->insert_tb('mm_service_request', $info);

            $this->ci->load->library('email_lib');
            $this->ci->email_lib->service_request_mail($info);

            $this->_status = true;
            $this->_message = "Request submitted sucessfully.";
            $this->_rdata = array();
            
        }
        return $this->getResponse();
    }
    
    function _getServices($data){
        $this->resetResponse();
        $postcode = $this->ci->security->xss_clean($data->postcode);
        $services = $this->model->get_tb('mm_services', 'service_id,service_name, service_image_url', array('service_archived' => 0))->result();
        
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
                            $this->_message = 'Please enter valid email id';
                        }
                        if(!isset($data->userInfo->reEmail) || $data->userInfo->reEmail =='' || $data->userInfo->reEmail == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please re enter valid email id';
                        }
                        if( isset($data->userInfo->reEmail) && isset($data->userInfo->email) ){
                            if($data->userInfo->reEmail != $data->userInfo->email){
                                $this->_status = FALSE;
                                $this->_message = 'Email id miss match..!! Please re enter same email id as login id';
                            }
                        }
                        if(!isset($data->userInfo->pass) || $data->userInfo->pass =='' || $data->userInfo->pass == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please enter password';
                        }
                        if(!isset($data->userInfo->address) || $data->userInfo->address =='' || $data->userInfo->address == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please enter address';
                        }
                        if(!isset($data->userInfo->city) || $data->userInfo->city =='' || $data->userInfo->city == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please enter city';
                        }
                        if(!isset($data->userInfo->state) || $data->userInfo->state =='' || $data->userInfo->state == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please select state';
                        }
                        if(!isset($data->userInfo->phone) || $data->userInfo->phone =='' || $data->userInfo->phone == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please enter phone number';
                        }
                        if(!isset($data->userInfo->pincode) || $data->userInfo->pincode =='' || $data->userInfo->pincode == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please enter pincode';
                        }
                        if(!isset($data->userInfo->firstName) || $data->userInfo->firstName =='' || $data->userInfo->firstName == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please enter first name';
                        }
                        if(!isset($data->userInfo->lastName) || $data->userInfo->lastName =='' || $data->userInfo->lastName == null){
                            $this->_status = FALSE;
                            $this->_message = 'Please enter last name';
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
                            
                            $this->_rdata = null;
                            return $this->getResponse();
                        }
                    }
                    
                    $price = $this->validate_service_price($data);
                    if($price['total_price'] > 0){
                        $info = array();
                        $info['booking_service_id']     = $data->service;
                        $info['booking_package_id']     = $data->package;
                        $info['booking_pincode']        = $data->servicePostcode;
                        $info['booking_booked_on']      = date('Y-m-d H:i:s', strtotime('now'));
                        $info['booking_amount']         = $price['total_price'];
                        $info['booking_gst']            = $price['gst'];
                        $info['booking_gst_status']     = $price['gst_status'];
                        $info['booking_sub_total']      = $price['sub_total'];
                        $info['booking_price_alter_found'] = $price['price_alter'];
                        $info['booking_payment_status'] = Globals::PAYMENT_PENDING;
                        $info['booking_status']         = Globals::BOOKING_PROCESSING;
                        $info['booking_service_date']   = $data->serviceDateSession[0]->date;
                        $info['booking_service_session']= $data->serviceDateSession[0]->session;
                        $info['booking_note']           = $data->userInfo->note;
                        $info['booking_user_id']        = $this->ci->session->userdata('user_id');

                        $count = $this->model->get_table_row_count('mm_booking')->result();
                        $new_count = sprintf('%09d', ($count[0]->count+1) );
                        $info['booking_invoice_id']       = "MM".$new_count;
                        //$info['booking_contact_status'] = $data->userInfo->contactStatus;
                        $booking_id = $this->model->insert_tb('mm_booking', $info);
                        if($booking_id > 0){
                            
                            //Store User Details
                            $service_user_info = array();                           
                            $service_user_info['booking_user_detail_first_name']    = $data->userInfo->firstName;
                            $service_user_info['booking_user_detail_last_name']     = $data->userInfo->lastName;
                            $service_user_info['booking_user_detail_email']         = $this->ci->session->userdata('user_email');
                            $service_user_info['booking_user_detail_phone']         = $data->userInfo->phone;
                            $service_user_info['booking_user_detail_address']       = $data->userInfo->address;
                            $service_user_info['booking_user_detail_pincode']       = $data->userInfo->pincode;
                            $service_user_info['booking_user_detail_city']          = $data->userInfo->city;
                            $service_user_info['booking_user_detail_state']         = $data->userInfo->state;
                            $service_user_info['booking_user_detail_booking_id']    = $booking_id;
                            $this->model->insert_tb('mm_booking_user_detail', $service_user_info);
                                    
                            //Store Addons of Booking
                            $addons_info = array();
                            $i=0;
                            foreach($data->addon as $addon){
                                if($addon->addonCount > 0){
                                    $addons_info[$i]['booking_addons_addon_price_id']      = $addon->addonId;
                                    $addons_info[$i]['booking_addons_count']         = $addon->addonCount;
                                    $addons_info[$i]['booking_addons_booking_id']    = $booking_id;
                                    $i++;
                                }
                            }
                            if(count($addons_info) > 0){
                                $this->model->insert_batch_tb('mm_booking_addons', $addons_info);
                            }

                            //Store extraService of Booking
                            $splRequest_info = array();
                            $i=0;
                            foreach($data->extraService as $splId){
                                $splRequest_info[$i]['booking_spl_request_service_spl_request_id']= $splId;
                                $splRequest_info[$i]['booking_spl_request_booking_id']    = $booking_id;
                                $i++;
                            }
                            if(count($splRequest_info) > 0){
                                $this->model->insert_batch_tb('mm_booking_spl_request', $splRequest_info);
                            }

                            //Store frequency of Booking
                            $frequency_info = array();
                            $frequency_info['booking_frequency_frequency_offer_id']       = $data->frequency;
                            $frequency_info['booking_frequency_frequency_value']    = $data->frequencyValue;
                            $frequency_info['booking_frequency_booking_id']         = $booking_id;

                            if(count($frequency_info) > 0){
                                $this->model->insert_tb('mm_booking_frequency', $frequency_info);
                            }

                            //Store Service Sessions and date
                            $sessions_info = array();
                            $i=0;
                            foreach($data->serviceDateSession as $dateSess){
                                $sessions_info[$i]['booking_sessions_session_id']   = $dateSess->session;
                                $sessions_info[$i]['booking_sessions_service_date'] = $dateSess->date;
                                $sessions_info[$i]['booking_sessions_booking_id']   = $booking_id;
                                $i++;
                            }
                            if(count($sessions_info) > 0){
                                $this->model->insert_batch_tb('mm_booking_sessions', $sessions_info);
                            }


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
                        $this->_message = 'Invalid Price.';
                        $this->_rdata = null;
                    }
                }else{
                    $this->_status = false;
                    $this->_message = 'No Vendor/s available.';
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
    
    
    function validate_service_price($data){
        $price = 0;
        $service_id = $data->service;
        $package_id = $data->package;
        $postcode   = $data->servicePostcode;
        
        $splPackageDetail = $this->model->get_tb('mm_postcode_service_price', '*', array('postcode_service_price_postcode'=>$postcode, 'postcode_service_price_package_id'=>$package_id, 'postcode_service_archived'=> Globals::UN_ARCHIVE))->result();
        if($splPackageDetail && !empty($splPackageDetail)){
            
            $price = $splPackageDetail[0]->postcode_service_price_price;
            
        }else{
            $package_detail = $this->model->get_tb('mm_service_package', '*', array('service_package_service_id'=>$service_id, 'service_package_id'=>$package_id, 'service_package_archive'=> Globals::UN_ARCHIVE))->result();
            if($package_detail && !empty($package_detail)){
                $price = $package_detail[0]->service_package_onetime_price;
            }
        }
        
        if($price > 0){
            
            //Get Addon Price if choosen
            //TODO:: Need to optmize the code
            foreach($data->addon as $addon){
                if($addon->addonCount > 0){
                    $addon_price_id = $addon->addonId;
                    $addon_count    = $addon->addonCount;
                    $addon_detail   = $this->model->get_tb('mm_service_addon_price','*',array('service_addon_price_id'=>$addon_price_id, 'service_addon_price_service_id'=>$service_id, 'service_addon_price_archived'=> Globals::UN_ARCHIVE))->result();
                    if($addon_detail){
                        $addon_price = $addon_detail[0]->service_addon_price_price * $addon_count;
                        $price += $addon_price;
                    }
                   
                }
            }
            
            //Get Spl request Price If choosen
            foreach($data->extraService as $splId){
                $spl_req_detail = $this->model->get_tb('mm_service_spl_request', '*', array('service_spl_request_id'=>$splId, 'service_spl_request_service_id'=>$service_id, 'service_spl_request_archived'=> Globals::UN_ARCHIVE))->result();
                if($spl_req_detail){
                    if($spl_req_detail[0]->service_spl_request_price !== null && $spl_req_detail[0]->service_spl_request_price > 0){
                       $price += $spl_req_detail[0]->service_spl_request_price;
                    }
                }
            }
            
            
            //Get Frequency Discount if choosen
            $frq_offer_id =  $data->frequency;
            if($frq_offer_id != '0'){
                $freq_detail = $this->model->get_freqDetail($frq_offer_id);
                if($freq_detail){
                    $discount = $freq_detail[0]->service_frequency_offer_value;
                    if( strtolower($freq_detail[0]->service_frequency_name) === Globals::FREQUENCY_WEEKLY){                    
                        $price = $price * 4;

                    }else if(strtolower($freq_detail[0]->service_frequency_name) === Globals::FREQUENCY_BIWEEKLY){
                        $price = $price * 2;

                    }
                    $price = $price - ($price * $discount)/100;
                }
            }
            $sub_total = $price;
            
            //Set TAX(GST) and Calculate Final price
            $gst = $this->ci->data['config']['gst'];
            $gst_status = $this->ci->data['config']['status']['gst'];
            if( $gst_status == 1){         
                $price = round( ($price + ($gst*$price)/100) , 2 );
            }
     
        }
        $price_alter = 0;
        if($data->totalPrice != $price){
            $price_alter = 1;
        }

        return array('total_price'=> $price, 'sub_total'=>$sub_total, 'gst'=>$gst, 'gst_status'=>$gst_status, 'price_alter'=>$price_alter);
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
        $data['payment_attempt_payment_id']     = $payData['payment_id'];
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
    
    /*
    * Function to populate all payment related data and return for payment process
    */
    function getPaymentRequestData($info){
        //Invoice Id must be unique for each Payment Gateway Request( USed for Invoice Id)
        $payment_id = substr(md5(uniqid("ServiceInvoiceId1234567890abcdefghijklmnopqrstuvwxyzMyMaidz", true)), 0, 20);
        
        $pay_data = array();
        $pay_data['payment_url']                = $this->ci->data['config']['payment_test_url'];
        $pay_data['payment_pass']               = $this->ci->data['config']['payment_test_pass'];
        $pay_data['payment_transaction_type']   = 'SALE';
        $pay_data['payment_method']             = 'ANY';
        $pay_data['payment_service_id']         = $this->ci->data['config']['payment_test_service_id'];
        $pay_data['payment_order_id']           = $info->booking_invoice_id;
        $pay_data['payment_id']                 = $payment_id;
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
    
    /*
    * Function to read the payment gateway response
    */
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
                
                $info = $this->model->get_tb('mm_payment_attempt', '*', array('payment_attempt_order_id'=>$order_number, 'payment_attempt_payment_id'=>$payment_id))->result();
                if(!empty($info)){
                    $pay_attempt_id = $info[0]->payment_attempt_id;
                    $booking_id = $info[0]->payment_attempt_for_id;
                    
                    $this->model->update_tb('mm_booking', array('booking_id'=>$booking_id), array('booking_payment_status'=> Globals::PAYMENT_SUCCESS, 'booking_payment_id'=>$payment_id));
                    
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
                    $this->sendSMS("+60".$booking_detail[0]->booking_user_detail_phone, "Your Service request has been placed successfully. The Service date is: ".$booking_detail[0]->booking_service_date); 
                    
                    //Send Mail to User
                    $paymentId = $_POST['PaymentID'];
                    $this->_sendEmailInvoiceToUser($booking_id, $order_number);

                    $this->_status = true;
                    $this->_message = 'Transaction Successfull!';
                    $this->_rdata = array('booking_id'=>$booking_detail[0]->booking_id);
                
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

    function _sendEmailInvoiceToUser($booking_id, $invoiceId){
        $this->ci->load->library('email_lib');
            $data = array();
            $data['other'] = $this->model->getServiceOrderDetails($booking_id);
            $data['session'] = $this->model->getBookingSessionDateDetails($booking_id);
            $data['addons'] = $this->model->getBookingAddonDetails($booking_id);
            $data['spl_request'] = $this->model->getBookingSplRequestDetails($booking_id);
            $data['invoiceId']  = $invoiceId;
            $data['gst']    = $this->ci->data['config']['gst'];
            
            $this->ci->email_lib->invoice_Inline_Mail($data);

    }
    
    
    function _getServiceOrderDetails(){
        $booking_id = $this->ci->input->post('booking_id', true);
        if($booking_id != '' && $booking_id !=0 && $booking_id != null){

            $data = array();
            $data['other'] = $this->model->getServiceOrderDetails($booking_id);
            $data['session'] = $this->model->getBookingSessionDateDetails($booking_id);
            $data['addons'] = $this->model->getBookingAddonDetails($booking_id);
            $data['spl_request'] = $this->model->getBookingSplRequestDetails($booking_id);
            $data['status']  = true;
            return $data;
        }
    }
    
    function _getEmployeeDetails(){
       $bookingId = $this->ci->input->post('bookingId', true);
       $this->resetResponse();
       
        if($bookingId != '' && $bookingId !=0 && $bookingId != null){

            $employee_detail = $this->model->getEmployeeDetails($bookingId);
            
           if($employee_detail){
               $sessionIds = array();
               foreach($employee_detail as $detail){
                   $sessionIds[$detail->booking_sessions_id] = $detail->booking_sessions_service_date;
               }
            $sessionIds = array_unique($sessionIds);
               
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $employee_detail;
            $this->_extra = $sessionIds;   
           }else{
               $this->_status = false;
                $this->_message = 'Invalid Request.!!';
                $this->_rdata = null;
            
           }
        }         
        return $this->getResponse();
    }

    function _contactUsMessage(){
        $this->resetResponse();

        $this->ci->load->library('form_validation');

        $this->ci->form_validation->set_rules('name', 'Contact Person Name', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {
            $info = array();
            $info['contact_us_name'] = $this->ci->input->post('name', true);
            $info['contact_us_subject'] = $this->ci->input->post('subject', true);
            $info['contact_us_email'] = $this->ci->input->post('email', true);
            $info['contact_us_message'] = $this->ci->input->post('message', true);

            $insert_id = 0;
            $insert_id = $this->model->insert_tb('mm_contact_us_message', $info);
            
            if($insert_id > 0){
                $this->_status = true;
                $this->_message = 'Thank you for contacting us! Will get back to you soon.';

                $this->ci->load->library('email_lib');
                $this->ci->email_lib->contactUsMessageIntimation($info);
                $this->ci->session->set_flashdata('success_message', 'Thank you for contacting us! Will get back to you soon.');
            }
            unset($info);

        }

        return $this->getResponse();
    }
    
    
    function _checkEmployeeAvailabilityForDate($data){
        $this->resetResponse();

        $service_date = $data->serviceDate.'';
        $session_id = $data->sessionId;
        $postcode = $data->postcode;
        $package_id = $data->package;
        
        $crews = $this->model->get_tb('mm_service_package','service_package_min_crew_member', array('service_package_id'=>$package_id))->result();
        
        if($crews && count($crews) >0){
            $crewCount = $crews[0]->service_package_min_crew_member;
            
            $dayofweek = strtolower(date('l', strtotime($service_date)));
            $employee_ids = array();
            $response_1 = $this->model->getEmployeeSessionAndDayAvailability($dayofweek, $session_id);
            //echo $this->model->last_query(); echo "<br>";
            $response_2 = $this->model->getEmployeeSplSessionAvailability($service_date, $session_id);
            //echo $this->model->last_query(); echo "<br>";
            $response_3 = $this->model->getEmployeeAssignedJob($service_date);
            //echo $this->model->last_query(); echo "<br>";

            $response_5 = $this->model->getEmployeeWhoGotSplSession($service_date);
            //echo $this->model->last_query(); echo "<br>";

            $response_6 = $this->model->getEmployeeWhoGotSplSessionHoliday($service_date);
            //echo $this->model->last_query(); exit;

            if(!empty($response_1)){
                foreach($response_1 as $id){
                    $employee_ids[] = $id->employee_id;
                }
            }

            if(!empty($response_5)){
                $new_array = array();
                foreach($response_5 as $id){
                    $new_array[] = $id->employee_id;
                }
                //Filter out(remove) the same employee of a spl session from default session
                $employee_ids = array_diff($employee_ids, $new_array);
            }


            if(!empty($response_2)){
                foreach($response_2 as $id){
                    $employee_ids[] = $id->employee_id;
                }
            }

            if(!empty($response_6)){
                $new_array = array();
                foreach($response_6 as $id){
                    $new_array[] = $id->employee_id;
                }
                //Filter out(remove) the same employee Who took holiday on service date
                $employee_ids = array_diff($employee_ids, $new_array);
            }

            if(!empty($response_3)){
                $new_array = array();
                foreach($response_3 as $id){
                    $new_array[] = $id->employee_id;
                }
                //Filter out(remove) the employees who assigned job oon selected date
                $employee_ids = array_diff($employee_ids, $new_array);
            }

            $employee_ids = array_unique($employee_ids);  
            if(!empty($employee_ids)){

                $employeesStr = implode(',', $employee_ids);
                $response_4 = $this->model->getEmployeeServingForLocation($employeesStr, $postcode, $crewCount);        
                //echo $this->model->last_query(); exit;
                $meet_req_count = 0;
                
                if(!empty($response_4)){
                    foreach($response_4 as $val){
                        $meet_req_count = $val->meet_req_count; //Either 1(yes) OR 0(NO)
                        if($meet_req_count){ 
                            $this->_status = true; 
                            $this->_rdata = $response_4;
                            break;
                        }
                    }
                    if(!$meet_req_count){
                        $this->_status = false; 
                        $this->_message = "Service not available for the selected date: ".$service_date." and session:  '".Globals::getSessionName($session_id)."' ";
                    }

                }else{
                    $this->_status = false;
                    $this->_message = "Service not available for the selected date: ".$service_date." and session:  '".Globals::getSessionName($session_id)."' ";
                }

            }else{
                $this->_status = false;
                $this->_message = "Service not available for the selected date: ".$service_date." and session:  '".Globals::getSessionName($session_id)."' ";
            }
        }else{
            $this->_status = false;
            $this->_message = "Invalid service package selected.";
        }
        
        return $this->getResponse();
        
    }
}