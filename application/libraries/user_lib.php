<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'libraries/Base_lib.php';

class User_lib extends Base_lib{

    var $model;

    function __construct() {
        $this->ci = &get_instance();
        $this->getModel();
    }

    function getModel() {
        $this->ci->load->model('user_model');
        $this->model = $this->ci->user_model;
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
                    $info['booking_payment_status'] = Globals::PAYMENT_SUCCESS;
                    $info['booking_status']         = Globals::BOOKING_PROCESSING;
                    $info['booking_service_date']   = $data->userInfo->serviceDate;
                    $info['booking_note']           = $data->userInfo->note;
                    $info['booking_user_id']        = $this->ci->session->userdata('user_id');
                    //$info['booking_contact_status'] = $data->userInfo->contactStatus;
                    $booking_id = $this->model->insert_tb('mm_booking', $info);
                    if($booking_id > 0){
                        $this->_status = true;
                        $this->_message = 'Booking Successfull';
                        $this->_rdata = $booking_id;
                        
                        foreach($vendorIds as $vendor){
                            //SMS
                            $this->sendSMS("+60".$vendor['mobile'], "New Service request from user for the date: ".$data->userInfo->serviceDate);                     
                        }
                        
                        //SMS to User
                        $this->sendSMS("+60".$data->userInfo->phone, "Your Service request has been placed successfully. The Service date is: ".$data->userInfo->serviceDate); 
                    }
                }
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

}
