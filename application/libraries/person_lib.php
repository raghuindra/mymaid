<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * person_lib is library to carryout all operations related to person  
 *
 */
class Person_lib {

    var $model;

    function __construct() {
        $this->ci = &get_instance();
        $this->getModel();
        //$this->ci->lang->load("np", "english");
    }

    function getModel() {
        $this->ci->load->model('person_model');
        $this->model = $this->ci->person_model;
    }

    /*
     * 
     *
     */
    function _register_user() {

        $this->ci->load->library('form_validation');
        $this->data['success_message'] = "";
        $this->data['error_message'] = "";

        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|xss_clean|encode_php_tags|matches[password]');
        $this->ci->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('address', 'address', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('address1', 'address 1', 'trim|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('pincode', 'Postal Code', 'trim|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('state', 'State', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('idcard', 'Id Card', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('idcardnumber', 'Id Card Number', 'trim|required|xss_clean|encode_php_tags');
    
        if ($this->ci->form_validation->run() == FALSE) {
            $this->data['form_data'] = $this->get_form_data();    
            return FALSE;
        }else{
            
            
        }
        
        
    }

}
