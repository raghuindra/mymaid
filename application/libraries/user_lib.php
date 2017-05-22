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
            
            $response = array(
                'status' => true,
                'message' => '',
                'data' => $services
            );

        } else {
            $response = array(
                'status' => false,
                'message' => $this->ci->lang->line('no_records_found'),
                'data' => array()
            );
        }
       return $response; 
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
            $response = array(
                'status' => true,
                'message' => '',
                'data' => $array
            );

        } else {
            $response = array(
                'status' => false,
                'message' => $this->ci->lang->line('no_records_found'),
                'data' => array()
            );
        }
       return $response;
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
            $response = array(
                'status' => true,
                'message' => '',
                'data' => $array
            );

        } else {
            $response = array(
                'status' => false,
                'message' => $this->ci->lang->line('no_records_found'),
                'data' => array()
            );
        }
        return $response; 
        
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
            $response = array(
                'status' => true,
                'message' => '',
                'data' => $array
            );

        } else {
            $response = array(
                'status' => false,
                'message' => $this->ci->lang->line('no_records_found'),
                'data' => array()
            );
        }
        return $response; 
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
            $response = array(
                'status' => true,
                'message' => '',
                'data' => $array
            );

        } else {
            $response = array(
                'status' => false,
                'message' => $this->ci->lang->line('no_records_found'),
                'data' => array()
            );
        }
        return $response; 
    }

}
