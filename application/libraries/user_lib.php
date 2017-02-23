<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_lib{
    
    var $model;
	function __construct() {
		$this -> ci = &get_instance();
		$this -> getModel();
	}

	function getModel() {
		$this -> ci -> load -> model('user_model');
		$this -> model = $this -> ci -> user_model;
	}
        
        function get_user(){
            $user_id = $this->ci->session->userdata('user_id');
            return $this->model->get_user_data($user_id);
        }
        
        /*
         * 
         *          */
        function _register_user(){
            
            $this -> ci -> load -> library('form_validation');
            $this->data['success_message']="";
            $this->data['error_message']="";
            
            $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|xss_clean|encode_php_tags|matches[password]');
            $this->ci->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('address', 'address', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('address1', 'address 1', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('address2', 'address 2', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('pincode', 'Postal Code', 'trim|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean|encode_php_tags');
            
            if(isset($_POST['email'])){
                $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
            }           
            $this->ci->form_validation->set_rules('telephone', 'Telephone', 'trim|required|xss_clean|encode_php_tags');
            if(isset($_POST['contract_start'])){
                 $this->ci->form_validation->set_rules('contract_start', 'Contract Start Date', 'trim||xss_clean|encode_php_tags');
            }
            if(isset($_POST['contract_end'])){
                 $this->ci->form_validation->set_rules('contract_end', 'Contract End Date', 'trim|xss_clean|encode_php_tags');
            }
            if(isset($_POST['number_of_place'])){
                  $this->ci->form_validation->set_rules('number_of_place', 'Number Of Place', 'trim|required|xss_clean|encode_php_tags');
            }
        }
}