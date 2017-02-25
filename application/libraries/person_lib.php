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
        $this->ci->lang->load("mm", "english");
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
        $this->ci->form_validation->set_rules('repassword', 'Password Confirmation', 'trim|required|xss_clean|encode_php_tags|matches[password]');
        $this->ci->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
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
            $this->data['error_message'] = $this -> ci -> lang -> line('Validation_error');
            $this->ci->session->set_flashdata('error_message', $this->data['error_message']);
            return FALSE;
        }else{
            $info = array();
            $info['person_first_name']          =   $this -> ci -> input -> post('firstname', true);
            $info['person_last_name']           =   $this -> ci -> input -> post('lastname', true);
            $info['person_email']               =   $this -> ci -> input -> post('email', true);
            $info['person_password']            =   hash('sha512', $this -> ci -> input -> post('password', true));
            $info['person_address']             =   $this -> ci -> input -> post('address', true);
            $info['person_address1']            =   $this -> ci -> input -> post('address1', true);
            $info['person_city']                =   $this -> ci -> input -> post('city', true);        
            $info['person_state']               =   $this -> ci -> input -> post('state', true);
            $info['person_country_code']        =   "my";
            $info['person_mobile']              =   $this -> ci -> input -> post('mobile', true);
            $info['person_postal_code']         =   $this -> ci -> input -> post('pincode', true);
            $info['person_identity_card']       =   $this -> ci -> input -> post('idcard', true);
            $info['person_identity_card_number']=   $this -> ci -> input -> post('idcardnumber', true);
            $info['person_lang_code']           =   "en";
            $info['person_type']                =   1;
            
            $this -> ci->load -> library('user_lib');
            if($this->ci->user_lib->check_user_email($info['person_email']))
            {
                
                //Insert person data into Person Table
                $person_id = $this->create_person($info);
                $user_info = array();
                $user_info['user_first_name']           = $info['person_first_name'];
                $user_info['user_last_name']            = $info['person_last_name'];
                $user_info['user_email']                = $info['person_email'];
                $user_info['user_password']             = $info['person_password'];
                $user_info['user_address']              = $info['person_address'];
                $user_info['user_address1']             = $info['person_address1'];
                $user_info['user_city']                 = $info['person_city'];        
                $user_info['user_state']                = $info['person_state'];
                $user_info['user_country']              = $info['person_country_code'];
                $user_info['user_mobile']               = $info['person_mobile'];
                $user_info['user_postal_code']          = $info['person_postal_code'];
                $user_info['user_identity_card']        = $info['person_identity_card'];
                $user_info['user_identity_card_number'] = $info['person_identity_card_number'];
                $user_info['user_lang_code']            = $info['person_lang_code'];
                $user_info['user_person_id']            = $person_id;
                
                $user_id = $this->ci->user_lib->_create_user($user_info);
                if ($user_id != '') {
                    $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('mm_user_created_successfully'));
                }
                return true; 
                
            }else{
                $this->ci->session->set_flashdata('error_message',  $this -> ci -> lang -> line('mm_email_available'));
            }      
            
            
            
            
            
        }
                           
        
    }
    
    /**
	 *
	 * Create new person in the Db 
	 *
	 * @param	array	$data	array of person data
	 * @param 	array 	$condition multiple conditions in array format
	 * @return	nil
	 */
	function create_person($person_data){
            $person_id=$this->model->insert($person_data);
            return $person_id;
	}

}
