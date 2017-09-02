<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'libraries/Base_lib.php';
/**
 * person_lib is library to carryout all operations related to person  
 *
 */
class Person_lib extends Base_lib{

    var $model;
    var $google;

    function __construct() {
        $this->ci = &get_instance();
        $this->getModel();
        $this->ci->lang->load("mm", "english");
    }

    function getModel() {
        $this->ci->load->model('person_model');
        $this->model = $this->ci->person_model;
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
    
    /*
     * 
     *
     */

    function _register_user() {

        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";

        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('repassword', 'Password Confirmation', 'trim|required|xss_clean|encode_php_tags|matches[password]');
        $this->ci->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('address', 'address', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('address1', 'address 1', 'trim|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('pincode', 'Postal Code', 'trim|xss_clean|encode_php_tags|numeric|min_length[4]');
        $this->ci->form_validation->set_rules('state', 'State', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|encode_php_tags|numeric|min_length[10]');
        $this->ci->form_validation->set_rules('idcard', 'Id Card', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('idcardnumber', 'Id Card Number', 'trim|required|xss_clean|encode_php_tags');

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return FALSE;
        } else {
            $info = array();
            $info['person_first_name'] = $this->ci->input->post('firstname', true);
            $info['person_last_name'] = $this->ci->input->post('lastname', true);
            $info['person_email'] = $this->ci->input->post('email', true);
            $info['person_password'] = hash('sha512', $this->ci->input->post('password', true));
            $info['person_address'] = $this->ci->input->post('address', true);
            $info['person_address1'] = $this->ci->input->post('address1', true);
            $info['person_city'] = $this->ci->input->post('city', true);
            $info['person_state'] = $this->ci->input->post('state', true);
            $info['person_country_code'] = "my";
            $info['person_mobile'] = $this->ci->input->post('mobile', true);
            $info['person_postal_code'] = $this->ci->input->post('pincode', true);
            $info['person_identity_card'] = $this->ci->input->post('idcard', true);
            $info['person_identity_card_number'] = $this->ci->input->post('idcardnumber', true);
            $info['person_lang_code'] = "en";
            $info['person_type'] = Globals::PERSON_TYPE_USER; /* Person_type = 1 ==> 'user' type */

            if ($this->check_person_email($info['person_email'])) {

                //Insert person data into Person Table
                $person_id = $this->create_person($info);
                if ($person_id) {
                    $this->ci->load->model('mm_model');
                    $role_id = $this->ci->mm_model->get_tb('mm_permission_type', 'permission_type_name, permission_type_id', array('permission_type_name' => Globals::ROLE_USER))->row();
                    $this->ci->mm_model->insert_tb('mm_permission', array('permission_permission_type_id' => $role_id->permission_type_id, 'person_id' => $person_id));

                    $user_info = array();
                    $user_info['user_first_name'] = $info['person_first_name'];
                    $user_info['user_last_name'] = $info['person_last_name'];
                    $user_info['user_email'] = $info['person_email'];
                    //$user_info['user_password']             = $info['person_password'];
                    $user_info['user_address'] = $info['person_address'];
                    $user_info['user_address1'] = $info['person_address1'];
                    $user_info['user_city'] = $info['person_city'];
                    $user_info['user_state'] = $info['person_state'];
                    $user_info['user_country'] = $info['person_country_code'];
                    $user_info['user_mobile'] = $info['person_mobile'];
                    $user_info['user_postal_code'] = $info['person_postal_code'];
                    $user_info['user_identity_card'] = $info['person_identity_card'];
                    $user_info['user_identity_card_number'] = $info['person_identity_card_number'];
                    $user_info['user_lang_code'] = $info['person_lang_code'];
                    $user_info['user_person_id'] = $person_id;

                    $user_id = $this->_create_user('mm_user', $user_info);
                    if ($user_id != '') {
                        $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('mm_user_created_successfully'));
                        
                        $sender = $this->ci->data['config']['sender_email'];
                        $recipient = $info['person_email'];
                        $subject = "Login Information";
                        $message = "<html><body>";
                        $message .= "<p>Dear User,</p><br>";
                        $message .= "<p>Your Login Credentials:</p>";
                        $message .= "<p>Email: &nbsp; <b>".$info['person_email']."</b></p>";
                        $message .= "<p>Password: &nbsp; <b>".$this->ci->input->post('password', true)."</b></p>";
                        $message .= "<p><a href='". base_url()."user_login.html'>Click here</a> to login</p>";
                        $message .= "</body></html>";
                        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
                        
                        // SMS
                        $this->sendSMS($info['person_mobile'], "Welcome to MyMaidz. Registration is successfull. Login to get service.");                     
                        
                        
                        redirect('home.html', 'refresh');
                        exit;
                    }
                } else {
                    
                }
            } else {
                $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('mm_email_available'));
                return FALSE;
            }
        }
    }
    
    /*
     * 
     */
    function booking_user_registration($info){
        
            if ($this->check_person_email($info['person_email'])) {

                //Insert person data into Person Table
                $person_id = $this->create_person($info);
                if ($person_id) {
                    $this->ci->load->model('mm_model');
                    $role_id = $this->ci->mm_model->get_tb('mm_permission_type', 'permission_type_name, permission_type_id', array('permission_type_name' => Globals::ROLE_USER))->row();
                    $this->ci->mm_model->insert_tb('mm_permission', array('permission_permission_type_id' => $role_id->permission_type_id, 'person_id' => $person_id));

                    $user_info = array();
                    $user_info['user_first_name'] = $info['person_first_name'];
                    $user_info['user_last_name'] = $info['person_last_name'];
                    $user_info['user_email'] = $info['person_email'];
                    $user_info['user_address'] = $info['person_address'];
                    $user_info['user_city'] = $info['person_city'];
                    $user_info['user_state'] = $info['person_state'];
                    $user_info['user_country'] = $info['person_country_code'];
                    $user_info['user_mobile'] = $info['person_mobile'];
                    $user_info['user_postal_code'] = $info['person_postal_code'];
                    $user_info['user_lang_code'] = $info['person_lang_code'];
                    $user_info['user_person_id'] = $person_id;

                    $user_id = $this->_create_user('mm_user', $user_info);
                    if ($user_id != '') {
                        
                        $sender = $this->ci->data['config']['sender_email'];
                        $recipient = $info['person_email'];
                        $subject = "Login Information";
                        $message = "<html><body>";
                        $message .= "<p>Dear User,</p><br>";
                        $message .= "<p>Your Login Credentials:</p>";
                        $message .= "<p>Email: &nbsp; <b>".$info['person_email']."</b></p>";
                        $message .= "<p>Password: &nbsp; <b>".$this->ci->input->post('password', true)."</b></p>";
                        $message .= "<p><a href='". base_url()."user_login.html'>Click here</a> to login</p>";
                        $message .= "</body></html>";
                        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
                        
                        // SMS
                        $this->sendSMS($info['person_mobile'], "Welcome to MyMaidz. Registration is successfull. Login to get service.");                     
                        
                              
                        return array('status'=>true, 'message'=>$this->ci->lang->line('mm_user_created_successfully'),'data'=>array('person_id'=>$person_id));
                    }
                } else {
                    
                }
            } else {
                $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('mm_email_available'));
                return array('status'=>false, 'message'=>'Email already registered!','data'=>array());
            }
        
    }

    /*
     * 
     *      
     */

    function _login_user() {

        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";

        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
            $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            redirect('user_login.html', 'refresh');
            exit;
        } else {

            $user_data['email'] = $this->ci->input->post('email', true);
            $user_data['password'] = hash('sha512', $this->ci->input->post('password', true));

            $user = $this->model->getUserDetails('person_id, person_email, person_first_name, person_last_name, person_id, person_type_name, person_lang_code, person_status, person_profile_image, person_country_code, person_type, person_type_name', array('person_email' => $user_data['email'], 'person_password' => $user_data['password'], 'person_status' => 1))->row();

            if (isset($user->person_id) && strlen($user->person_id) > 0) {

                $this->_set_last_ip_and_last_login($user->person_id);
                $this->_set_session($user->person_type_name, $user);

                $this->ci->data['success_message'] = $this->ci->lang->line('mm_user_login_welcome');
                $this->ci->session->set_flashdata('success_message', $this->ci->data['success_message']);
                $this->redirect_home();
                exit;
            } else {

                $this->ci->data['error_message'] = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
                $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
                redirect('user_login.html', 'refresh');
                exit;
            }
        }
    }
    
    
    function _booking_login_user(){
        $this->ci->load->library('form_validation');

        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
        $this->ci->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean|encode_php_tags');

        if ($this->ci->form_validation->run() == FALSE) {

             return array(
                    'status' => false,
                    'message' => $this->ci->lang->line('mm_frontend_login_error_login_incorrect'),
                    'data' => array()
                );
            
        } else {
            $response = array();
            $user_data['email'] = $this->ci->input->post('email', true);
            $user_data['password'] = hash('sha512', $this->ci->input->post('pass', true));

            $user = $this->model->getUserDetails('person_id, person_email, person_first_name, person_last_name, person_id, person_type_name, person_lang_code, person_status, person_profile_image, person_country_code, person_type, person_type_name', array('person_email' => $user_data['email'], 'person_password' => $user_data['password'], 'person_status' => 1))->row();

            if (isset($user->person_id) && strlen($user->person_id) > 0) {

                $this->_set_last_ip_and_last_login($user->person_id);
                $this->_set_session($user->person_type_name, $user);

                $this->ci->data['success_message'] = $this->ci->lang->line('mm_user_login_welcome');
                $this->ci->session->set_flashdata('success_message', $this->ci->data['success_message']);
                
                $response = array(
                    'status' => true,
                    'message' => $this->ci->lang->line('mm_user_login_welcome'),
                    'data' => array()
                );

            } else {

                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('mm_frontend_login_error_login_incorrect'),
                    'data' => array()
                );
            }
            
            return $response;
        }
    }

    /*
     * 
     *
     */

    function _register_vendor() {

        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";

        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('repassword', 'Password Confirmation', 'trim|required|xss_clean|encode_php_tags|matches[password]', array('required' => 'Both password must match.'));
        $this->ci->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('address', 'address', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('address1', 'address 1', 'trim|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('pincode', 'Postal Code', 'trim|required|xss_clean|encode_php_tags|max_length[6]|numeric');
        $this->ci->form_validation->set_rules('state', 'State', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|encode_php_tags|max_length[10]|numeric');
        $this->ci->form_validation->set_rules('idcard', 'Id Card', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('idcardnumber', 'Id Card Number', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('type', 'Vendor/Freelancer selection', 'trim|required|xss_clean|encode_php_tags|numeric');
        if ($this->ci->input->post('type', true) == 1) {
            $this->ci->form_validation->set_rules('compName', 'Company Name', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('compRegister', 'Company Registration number', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('compAddress', 'Company Address', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('compPin', 'Company Postal Code', 'trim|required|xss_clean|encode_php_tags|numeric');
            $this->ci->form_validation->set_rules('compMobile', 'Company Mobile', 'trim|required|xss_clean|encode_php_tags|min_length[10]|numeric');
            $this->ci->form_validation->set_rules('compLandPhone', 'Company Landphone', 'trim|required|xss_clean|encode_php_tags');
            $this->ci->form_validation->set_rules('compFax', 'Company Fax', 'trim|required|xss_clean|encode_php_tags|min_length[8]|numeric');
            $this->ci->form_validation->set_rules('compEmpMin', 'Company Minimum Employees count', 'trim|required|xss_clean|encode_php_tags|numeric');
            $this->ci->form_validation->set_rules('compEmpMax', 'Company Maximum Employees count', 'trim|required|xss_clean|encode_php_tags|numeric');
        }

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);

            return FALSE;
        } else {

            $info = array();
            $info['person_first_name'] = $this->ci->input->post('firstname', true);
            $info['person_last_name'] = $this->ci->input->post('lastname', true);
            $info['person_email'] = $this->ci->input->post('email', true);
            $info['person_password'] = hash('sha512', $this->ci->input->post('password', true));
            $info['person_address'] = $this->ci->input->post('address', true);
            $info['person_address1'] = $this->ci->input->post('address1', true);
            $info['person_city'] = $this->ci->input->post('city', true);
            $info['person_state'] = $this->ci->input->post('state', true);
            $info['person_country_code'] = "my";
            $info['person_mobile'] = $this->ci->input->post('mobile', true);
            $info['person_postal_code'] = $this->ci->input->post('pincode', true);
            $info['person_identity_card'] = $this->ci->input->post('idcard', true);
            $info['person_identity_card_number'] = $this->ci->input->post('idcardnumber', true);
            $info['person_lang_code'] = "en";
            $info['person_status'] = 0;

            if ($this->ci->input->post('type', true) == 1) {
                $info['person_type'] = Globals::PERSON_TYPE_VENDOR; /* Person_type = 2 ==> 'vendor' type */
                $role = Globals::ROLE_VENDOR;
            } else {
                $info['person_type'] = Globals::PERSON_TYPE_FREELANCER; /* Person_type = 4 ==> 'freelancer' type */
                $role = Globals::ROLE_FREELANCER;
            }

            if ($this->check_person_email($info['person_email'])) {

                //Insert person data into Person Table
                $person_id = $this->create_person($info);
                if ($person_id) {
                    $this->ci->load->model('mm_model');
                    $role_id = $this->ci->mm_model->get_tb('mm_permission_type', 'permission_type_name, permission_type_id', array('permission_type_name' => $role))->row();
                    $this->ci->mm_model->insert_tb('mm_permission', array('permission_permission_type_id' => $role_id->permission_type_id, 'person_id' => $person_id));

                    $user_info = array();
                    $user_info['vendor_first_name'] = $info['person_first_name'];
                    $user_info['vendor_last_name'] = $info['person_last_name'];
                    $user_info['vendor_email'] = $info['person_email'];
                    $user_info['vendor_address'] = $info['person_address'];
                    $user_info['vendor_address1'] = $info['person_address1'];
                    $user_info['vendor_city'] = $info['person_city'];
                    $user_info['vendor_state'] = $info['person_state'];
                    $user_info['vendor_country'] = $info['person_country_code'];
                    $user_info['vendor_mobile'] = $info['person_mobile'];
                    $user_info['vendor_postal_code'] = $info['person_postal_code'];
                    $user_info['vendor_identity_card'] = $info['person_identity_card'];
                    $user_info['vendor_identity_card_number'] = $info['person_identity_card_number'];
                    $user_info['vendor_lang_code'] = $info['person_lang_code'];
                    $user_info['vendor_person_id'] = $person_id;
                    $user_info['vendor_status'] = 0;

                    $user_id = $this->_create_user('mm_vendor', $user_info);
                    $comp_info = array();
                    if ($this->ci->input->post('type', true) == 1) {
                        
                        $comp_info['company_person_id'] = $person_id;
                        $comp_info['company_name'] = $this->ci->input->post('compName', true);
                        $comp_info['company_reg_number'] = $this->ci->input->post('compRegister', true);
                        $comp_info['company_address'] = $this->ci->input->post('compAddress', true);
                        $comp_info['company_pincode'] = $this->ci->input->post('compPin', true);
                        $comp_info['company_mobile'] = $this->ci->input->post('compMobile', true);
                        $comp_info['company_landphone'] = $this->ci->input->post('compLandPhone', true);
                        $comp_info['company_fax'] = $this->ci->input->post('compFax', true);
                        $comp_info['company_emp_min'] = $this->ci->input->post('compEmpMin', true);
                        $comp_info['company_emp_max'] = $this->ci->input->post('compEmpMax', true);
                        
                    }else{
                        
                        $comp_info['company_person_id'] = $person_id;
                        $comp_info['company_name'] = "Freelancer - ". $info['person_first_name']." ".$info['person_last_name'];
                        $comp_info['company_email_id'] = $info['person_email'];
                        $comp_info['company_contact_person_name'] = $info['person_first_name']." ".$info['person_last_name'];
                        $comp_info['company_reg_number'] = $info['person_identity_card_number'];
                        $comp_info['company_address'] = $info['person_address'];
                        $comp_info['company_address1'] = $info['person_address1'];
                        $comp_info['company_pincode'] = $info['person_postal_code'];
                        $comp_info['company_mobile'] = $info['person_mobile'];
                        $comp_info['company_landphone'] = $info['person_mobile'];
                        $comp_info['company_fax'] = $info['person_mobile'];
                        $comp_info['company_emp_min'] = '1';
                        $comp_info['company_emp_max'] = '1';                       
                    }
                    
                    $comp_id = $this->_create_company('mm_vendor_company', $comp_info);
                    
                    if ($user_id != '') {
                        if($comp_id > 0 && $role == Globals::ROLE_FREELANCER){
                            $emp_info = array();
                            $emp_info['employee_name'] = "Freelancer - ". $info['person_first_name']." ".$info['person_last_name'];
                            $emp_info['employee_passport_number'] = $info['person_identity_card_number'];
                            $emp_info['employee_citizenship'] = 'my';
                            $emp_info['employee_house_phone'] = $info['person_mobile'];
                            $emp_info['employee_hp_phone'] = $info['person_mobile'];                            
                            $emp_info['employee_created_on'] = date('Y-m-d H:i:s', strtotime('now'));
                            $emp_info['employee_company_id'] = $comp_id;
                            $emp_info['employee_job_session_id'] = Globals::SESSION_FULL_DAY;
                            $this->model->insert_tb('mm_company_employees', $emp_info);
                        }
                        $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('mm_vendor_registration_successfull'));
                        
                        $sender = $this->ci->data['config']['sender_email'];
                        $recipient = $info['person_email'];
                        $subject = "Login Information";
                        $message = "<html><body>";
                        $message .= "<p>Dear Vendor/Freelancer,</p><br>";
                        $message .= "<p>You have registered in mymaidz as vendor - <b>pending for admin approval</b>.</p>";
                        $message .= "<p>Your Login Credentials:</p>";
                        $message .= "<p>Email: &nbsp; <b>".$info['person_email']."</b></p>";
                        $message .= "<p>Password: &nbsp; <b>".$this->ci->input->post('password', true)."</b></p>";                       
                        $message .= "<p><a href='". base_url()."vendor_login.html'>Click here</a> to login</p>";
                        $message .= "</body></html>";
                        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
                        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'alaken.adv@gmail.com',$subject,$message,array('mailtype'=>'html'));
                        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 's_thiba82@yahoo.com',$subject,$message,array('mailtype'=>'html'));
                        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'kkharish16@gmail.com',$subject,$message,array('mailtype'=>'html'));
                        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'praveen.dexter@gmail.com',$subject,$message,array('mailtype'=>'html'));
                        
                        //SMS
                                  $this->sendSMS('+60'.$user_info['vendor_mobile'], "Welcome to MyMaidz. Registration is successfull. Account is pending for admin approval.");                     
                        /*Admin*/ $this->sendSMS('+601124129717', "New request for vendor(".$user_info['vendor_first_name']." ".$user_info['vendor_last_name']."). Waiting for approval.");
                        /*Admin*/ $this->sendSMS('+60146771436', "New request for vendor(".$user_info['vendor_first_name']." ".$user_info['vendor_last_name']."). Waiting for approval.");
                        /*Admin*/ $this->sendSMS('+60125918491', "New request for vendor(".$user_info['vendor_first_name']." ".$user_info['vendor_last_name']."). Waiting for approval.");
                        /*Admin*/ $this->sendSMS('+60126570387', "New request for vendor(".$user_info['vendor_first_name']." ".$user_info['vendor_last_name']."). Waiting for approval.");
                        
                        redirect('vendor_register.html', 'refresh');
                        exit;
                    }
                } else {
                    
                }
            } else {
                $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('mm_email_available'));
                return FALSE;
            }
        }
    }

    /*
     * 
     *      
     */

    function _login_vendor() {

        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";

        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
            $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return false;
        } else {

            $user_data['email'] = $this->ci->input->post('email', true);
            $user_data['password'] = hash('sha512', $this->ci->input->post('password', true));

            $user = $this->model->getVendorDetails('person_id, person_email, person_first_name, person_last_name, person_id, person_type_name, person_lang_code, person_status, person_profile_image, person_country_code, person_type, person_type_name', array('person_email' => $user_data['email'], 'person_password' => $user_data['password'], 'person_status' => 1))->row();

            if (isset($user->person_id) && strlen($user->person_id) > 0) {

                $this->_set_last_ip_and_last_login($user->person_id);
                $this->_set_session($user->person_type_name, $user);

                $this->ci->data['success_message'] = $this->ci->lang->line('mm_user_login_welcome');
                $this->ci->session->set_flashdata('success_message', $this->ci->data['success_message']);
                $this->redirect_home();
                exit;
            } else {

                $this->ci->data['error_message'] = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
                $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
                return false;
            }
        }
    }

    function _login_admin() {

        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";

        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
            $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return false;
        } else {

            $user_data['email'] = $this->ci->input->post('email', true);
            $user_data['password'] = hash('sha512', $this->ci->input->post('password', true));

            $user = $this->model->getAdminDetails('person_id, person_email, person_first_name, person_last_name, person_id, person_type_name, person_lang_code, person_status, person_profile_image, person_country_code, person_type, person_type_name', array('person_email' => $user_data['email'], 'person_password' => $user_data['password'], 'person_status' => 1))->row();

            if (isset($user->person_id) && strlen($user->person_id) > 0) {

                $this->_set_last_ip_and_last_login($user->person_id);
                $this->_set_session($user->person_type_name, $user);

                $this->ci->data['success_message'] = $this->ci->lang->line('mm_user_login_welcome');
                $this->ci->session->set_flashdata('success_message', $this->ci->data['success_message']);
                $this->redirect_home();
                exit;
            } else {

                $this->ci->data['error_message'] = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
                $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
                return false;
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
    function create_person($person_data) {
        $person_id = $this->model->insert($person_data);
        return $person_id;
    }

    /**
     * Set last ip and last login function when user login
     *
     */
    function _set_last_ip_and_last_login($user_id) {

        $user_data['person_last_ip'] = $this->ci->input->ip_address();
        $user_data['person_last_login'] = date('Y-m-d H:i:s', strtotime('now'));

        $this->ci->backend_model->update_table('mm_person', $user_data, array('person_id' => $user_id));
    }

    /**
     * sets the session for active logged in user
     */
    function _set_session($type, $data, $googleUser=false, $token=false) {
        // Set session data array       
        $user = array(
            'user_id' => $data->person_id,
            'user_email' => $data->person_email,
            'user_type' => $type,
            'user_fullname' => ucfirst($data->person_first_name) . " " . ucfirst($data->person_last_name),
            'user_firstname' => ucfirst($data->person_first_name),
            'user_lastname' => ucfirst($data->person_last_name),
            'user_country_code' => $data->person_country_code,
            'user_profile_image' => $data->person_profile_image,
            'user_lang_code' => $data->person_lang_code,
            'user_status' => $data->person_status,
            'user_lang' => 'english',
        );
        if($googleUser===true){
            $user['google_login'] = true;
            $user['id_token'] = $token;
        }

        if( ($type == Globals::PERSON_TYPE_VENDOR_NAME) || ($type == Globals::PERSON_TYPE_FREELANCER_NAME) ){
            $company = $this->model->get_tb('mm_vendor_company', 'company_id, company_name', array('company_person_id'=>$data->person_id))->result();
            if($company){
                $user['company_id'] = $company[0]->company_id;
                $user['company_name'] = $company[0]->company_name;
            }
        }
        $this->ci->session->set_userdata($user);
        $user_role['role'] = $this->get_person_role($data->person_id);
        //$all_languages['languages'] = $this->get_all_language();
        $this->ci->session->set_userdata($user_role);
    }

    /**
     *
     * Redirects the controle to the correct home page based on user type 
     *
     */
    function redirect_home() {
        if ($this->ci->session->userdata('user_id') != NULL) {
            //echo $this->ci->session->userdata['user_type']; exit;
            switch ($this->ci->session->userdata['user_type']) {
                case Globals::PERSON_TYPE_ADMIN_NAME:
                    $redirect_url = "admin_home.html";
                    break;
                case Globals::PERSON_TYPE_USER_NAME:
                    $redirect_url = "user_home.html";
                    break;
                case Globals::PERSON_TYPE_VENDOR_NAME:
                    $redirect_url = "vendor_home.html";
                    break;
                case Globals::PERSON_TYPE_FREELANCER_NAME:
                    $redirect_url = "vendor_home.html";
                    break;
            }
            redirect($redirect_url, 'refresh');
        }else{
            redirect('home.html', 'refresh');
        }
    }

/**
     *
     * return the respective user home page url 
     *
     */
    function getUserHomeUrl(){
        if ($this->ci->session->userdata('user_id') != NULL) {
            //echo $this->ci->session->userdata['user_type']; exit;
            switch ($this->ci->session->userdata['user_type']) {
                case Globals::PERSON_TYPE_ADMIN_NAME:
                    $redirect_url = "admin_home.html";
                    break;
                case Globals::PERSON_TYPE_USER_NAME:
                    $redirect_url = "user_home.html";
                    break;
                case Globals::PERSON_TYPE_VENDOR_NAME:
                    $redirect_url = "vendor_home.html";
                    break;
                case Globals::PERSON_TYPE_FREELANCER_NAME:
                    $redirect_url = "vendor_home.html";
                    break;
            }
            
        }else{
            $redirect_url = '';
        }
        return $redirect_url;
    }

    /**
     * removes active(user) session.
     */
    function logout() {
        // Delete login		
        $type = $this->ci->session->userdata('user_type');
        if ($type == 'admin') {
            $redirect_url = 'admin_login.html';
        } else if ($type == 'vendor' || $type == 'freelancer') {

            $redirect_url = 'vendor_login.html';
        } else {
            $redirect_url = 'home.html';
        }
        if($this->ci->session->userdata('google_login')){
            $token = $this->ci->session->userdata('id_token');
            //$this->logoutGoogleuser($token);
        }

        $this->ci->session->sess_destroy();
        //$this->ci->session->sess_create();

        $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('np_frontend_message_logout_successfully'));
        redirect($redirect_url, 'refresh');
    }

    function logoutGoogleuser($token){
        $this->ci->load->library('curl'); 
            //Request using GET Method
            echo $get_url = "https://accounts.google.com/o/oauth2/revoke?token=".$token;  
            $response = $this->ci->curl->_simple_call('post', $get_url, false, array(CURLOPT_USERAGENT => true)); 
print_r($response); exit;
            $response = json_decode($response);
            
    }

    function _forgotpass() {
        $this->ci->load->library('form_validation');
        $this->data['error_message'] = '';

        $this->ci->form_validation->set_rules('id', 'required mail id', 'trim|required|xss_clean|encode_php_tags|valid_email');

        if ($this->ci->form_validation->run() != FALSE) {

            $user_data['user_email'] = $this->ci->input->post('id', true);
            $type = $this->ci->input->post('type', true);

            $user = $this->model->get('person_id, person_type, person_email,person_first_name,person_last_name,person_archived', array('person_email' => $user_data['user_email']))->row();
            //print_r($user);
            //exit;
            if (isset($user->person_id) && strlen($user->person_id) > 0 && $user->person_archived == Globals::UN_ARCHIVE) {
                $reset_data['pass_reset_person_id'] = $user->person_id;
                $reset_data['pass_reset_person_type'] = $user->person_type;
                $reset_data['pass_reset_token_key'] = md5(microtime() . rand());
                $reset_data['pass_reset_generated_at'] = date('Y-m-d H:i:s');
                $reset_data['pass_reset_expires_at'] = date('Y-m-d H:i:s', strtotime('+1 day'));
                $result = $this->model->get_tb('mm_password_reset', 'pass_reset_person_id', array('pass_reset_person_id' => $user->person_id))->row();
                if (!empty($result) && count($result) > 0) {
                    $this->model->delete_tb('mm_password_reset', array('pass_reset_person_id' => $user->person_id));
                }
                $this->model->insert_tb('mm_password_reset', $reset_data);
                $this->ci->load->library('page_load_lib');

                $sender = $this->ci->data['config']['sender_email'];
                $recipient = $user->person_email;
                $reset_token_key = $reset_data['pass_reset_token_key'];
                $subject = "Change your MyMaidz Password";
                $message = "<html><body>";
                $message .= "<p>Dear Member,</p><br>";
                $message .= "<p>You have requested to change your MyMaidz password. If you did not make this request, please just ignore this email. This link will be active for only 24 hours.</p>";
                $message .= "<p><a href='" . base_url() . "reset_password.html/" . $reset_token_key . "'>Click here to change your password.</a></p><br />";
                $message .= "<p>Otherwise, please copy the link below and paste it into your browser.</p>";
                $message .= "<p><span style='color:#295CC2;'>" . base_url() . "reset_password.html/" . $reset_token_key . "</span></p><br/>";
                $message .= "<p>If you have any questions, do not hesitate to contact us.</p><br/>";
                $message .= "<p>Sincerely,</p><br>";
                $message .= "<p>The MyMaidz Team</p><br>";
                //$message .= "<p><img src='".base_url()."/assets/img/Find_Out.png' alt='MyMaidz'/></p>";
                $message .= "<p><a href='" . base_url() . "'>" . base_url() . "</a></p><br>";
                $message .= "<p>Copyright &copy; 2017 MyMaidz. All Rights Reserved.</p><br>";
                $message .= "</body></html>";
                //$attachement = "assets/img/Find_Out.png";
                $this->ci->page_load_lib->send_np_email($sender, $recipient, $subject, $message, array('mailtype' => 'html'));
                
                $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('mm_forgotpass_resetlink_sent'));
                redirect('forgotPass.html', 'refresh');
                exit;
            } else {
                $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('mm_email_not_exists'));
            }
        } else {
            $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('Validation_error'));
        }
    }

    function _resetpass($token) {

        $this->ci->load->library('form_validation');
        $this->ci->data['error_message'] = '';

        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|encode_php_tags');
        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('Validation_error'));
            return;
        } else {
            $pass = trim($this->ci->input->post('password', true));
            $confirm_pass = trim($this->ci->input->post('confirm_password', true));
            if ($pass == $confirm_pass) {
                $new_pass = hash('sha512', $pass);
                $result = $this->model->get_tb('mm_password_reset', '*', array('pass_reset_token_key' => $token))->row();
                if($result) {

                    $person_id = $result->pass_reset_person_id;

                    if ($result->pass_reset_person_type == Globals::PERSON_TYPE_USER) {
                        $update = $this->model->update_tb('mm_user', array('user_person_id' => $person_id), array('user_password' => $new_pass));
                    }
                    
                    $p_update = $this->model->update_tb('mm_person', array('person_id' => $person_id), array('person_password' => $new_pass));

                    if ($p_update) {
                        $redirect_link = "";
                        $update = $this->model->update_tb('mm_password_reset', array('pass_reset_token_key' => $token), array('pass_reset_status' => 1));
                        $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('mm_password_changed_success'));
                        $user_data = $this->model->get_tb('mm_person', '*', array('person_id' => $person_id))->row();

                        $sender = $this->ci->data['config']['sender_email'];
                        $recipient = $user_data->person_email;
                        $subject = "Password has been successfully updated";
                        $message = "<html><body>";
                        $message .= "<p>Dear " . $user_data->person_first_name . ",</p><br>";
                        $message .= "<p>Password has been successfully updated:</p>";
                        $message .= "<p>Password: &nbsp; <b>" . $pass . "</b></p>";
                        if ($result->pass_reset_person_type == Globals::PERSON_TYPE_ADMIN ) {
                            $message .= "<p><a href='". base_url()."admin_login.html'>Click here</a> to login</p>";
                            $message .= "<p>Or copy the login link:<b> ". base_url()."admin_login.html </b></p>";
                            $redirect_link =  base_url()."admin_login.html";
                        } elseif ($result->pass_reset_person_type == Globals::PERSON_TYPE_VENDOR || $result->pass_reset_person_type == Globals::PERSON_TYPE_FREELANCER) {
                            $message .= "<p><a href='". base_url()."vendor_login.html'>Click here</a> to login</p>";
                            $message .= "<p>Or copy the login link:<b> ". base_url()."vendor_login.html </b></p>";
                            $redirect_link =  base_url()."vendor_login.html";
                        } elseif($result->pass_reset_person_type == Globals::PERSON_TYPE_USER){
                            $message .= "<p><a href='". base_url()."user_login.html'>Click here</a> to login</p>";
                            $message .= "<p>Or copy the login link:<b> ". base_url()."user_login.html </b></p>";
                            $redirect_link =  base_url()."user_login.html";
                        }

                        $message .= "</body></html>";
                        $this->ci->page_load_lib->send_np_email($sender, $recipient, $subject, $message, array('mailtype' => 'html'));

                        redirect($redirect_link, 'refresh');
                        exit;
                    } else {
                        $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('something_problem'));

                        return;
                    }
                } else {
                    $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('mm_invalid_token'));
                    return;
                }
            } else {
                $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('mm_passsword_mismatch'));
                return;
            }
        }
    }

    function check_person_email($email) {

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
     * @param	string	$table	tabel name
     * @param	array	$user_data	array of user data
     * @return	user id
     */
    function _create_user($table, $user_data) {

        return $user_id = $this->model->insert_tb($table, $user_data);
    }

    /**
     *
     * Create new company in the Db 
     *
     * @param	string	$table	tabel name
     * @param	array	$comp_data	array of company data
     * @return	company id
     */
    function _create_company($table, $comp_data) {
        return $comp_id = $this->model->insert_tb($table, $comp_data);
    }

    /**
     * Function to get the user role from database
     */
    function get_person_role($person_id) {

        $permissions = $this->model->get_permissions('permission_type_name', array('person_id' => $person_id))->result();

        $array = array();
        if (!empty($permissions)) {
            foreach ($permissions as $val) {
                $array[] = $val->permission_type_name;
            }
        }
        return $array;
    }
    
    
    function _getPersonWalletBalance(){
        
        $person_id = $this->ci->session->userdata('user_id');
        if($person_id != null){
            $result = $this->model->get('person_wallet_amount', array('person_id'=>$person_id))->result();
            if($result){
                $response = array(
                    'status' => true,
                    'message' => '',
                    'data' => $result
                );
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_data'),
                    'data' => array()
                );
            }
        }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_data'),
                    'data' => array()
                );
            }
            return $response;
    }
    
    
    function walletWithdrawalRequest(){
        $response = array();
        if($this->ci->session->userdata('user_id') != null){
            $person_id = $this->ci->session->userdata('user_id');
            $user_type = $this->ci->session->userdata('user_type');
            $now = date('Y-m-d H:i:s', strtotime('now'));
            if(isset($_POST['amount'])){
                $amount = $this->ci->input->post('amount', true);
                $v_amount = number_format((float) ($amount), 2, '.', ''); unset($amount);
                
                $person_info = $this->model->get('person_id, person_wallet_amount', array('person_id'=>$person_id))->result();
                if($person_info[0]->person_wallet_amount >= $v_amount){
                    if( $user_type == Globals::PERSON_TYPE_VENDOR_NAME || $user_type == Globals::PERSON_TYPE_FREELANCER_NAME){
                        $data = array(
                            'vendor_wallet_withdrawal_vendor_id' => $person_id,
                            'vendor_wallet_withdrawal_amount' =>$v_amount,
                            'vendor_wallet_withdrawal_request_on' => $now,                  
                        );
                        $this->model->insert_tb('mm_vendor_wallet_withdrawal', $data);

                        if($this->model->getAffectedRowCount() > 0) {
                            $response = array(
                                'status' => true,
                                'message' => $this->ci->lang->line('wallet_withdrawal_request_Sent'),
                                'data' => array()
                            );
                        }else{
                            $response = array(
                                'status' => false,
                                'message' => $this->ci->lang->line('no_changes_to_update'),
                                'data' => array()
                            );

                        }
                    }
                }else{
                   $response = array(
                        'status' => false,
                        'message' => $this->ci->lang->line('wallet_balance_low_than_requested'),
                        'data' => array()
                    ); 
                }
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_data'),
                    'data' => array()
                );
            }
            
        }else{
            $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_data'),
                    'data' => array()
            );
        }
        
        return $response;
    }
    
    
    function listWalletWithdrawalRequest(){
        $response = array();
        if($this->ci->session->userdata('user_id') != null){
            $person_id = $this->ci->session->userdata('user_id');
            $user_type = $this->ci->session->userdata('user_type');

            if( $user_type == Globals::PERSON_TYPE_VENDOR_NAME || $user_type == Globals::PERSON_TYPE_FREELANCER_NAME){
                
                $result = $this->model->get_tb('mm_vendor_wallet_withdrawal', '*', array('vendor_wallet_withdrawal_vendor_id'=>$person_id))->result();
                
                if($result) {
                    $response = array(
                        'status' => true,
                        'message' => '',
                        'data' => $result
                    );
                }else{
                    $response = array(
                        'status' => false,
                        'message' => $this->ci->lang->line('invalid_data'),
                        'data' => array()
                    );

                }
            }
            
        }else{
            $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_data'),
                    'data' => array()
            );
        }
        
        return $response;
    }
    
    
    function _getWidgetsUpdates(){
        $person_id = $this->ci->session->userdata('user_id');
        $dataArray = array();
        if($person_id != null){
            $respo_1 = $this->model->get('person_wallet_amount', array('person_id'=>$person_id))->result();
            $dataArray['wallet_balance'] = $respo_1[0]->person_wallet_amount;
            //Get New Orders Count
            $now = date('Y-m-d H:i:s', strtotime('now'));


            //Get Processing Orders and Completed Orders
            if( ($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME) || ($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME) ){
                $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_person_id' => $person_id))->result();
                
                $respo_3 = $this->model->getVendorServiceBookings($company[0]->company_id);
                $dataArray['processing_orders'] = count($respo_3);
                
                $respo_4 = $this->model->getVendorCompletedServiceBookings($company[0]->company_id);
                $dataArray['completed_orders'] = count($respo_4);

                $respo_5 = $this->model->getNewServiceBookingsForVendorFreelanc($now, $person_id);
                $dataArray['new_orders'] = count($respo_5);

            }else if($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME){
                
                $respo_3 = $this->model->getAllServiceBookingsUnderProcess();                 
                $dataArray['processing_orders'] = count($respo_3);
                
                $respo_4 = $this->model->getAllCompletedServiceOrders();
                $dataArray['completed_orders'] = count($respo_4);

                $respo_2 = $this->model->getServiceBookings($now);
                //echo $this->model->last_query();
                $dataArray['new_orders'] = count($respo_2);
                
            }else if($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_USER_NAME){
                // $respo_3 = $this->model->getAllUserServiceBookingsUnderProcess($person_id);
                // $dataArray['processing_orders'] = count($respo_3);
                
                // $respo_4 = $this->model->getUserCompletedBookings($person_id);
                // $dataArray['completed_orders'] = count($respo_4);
            }

            
            if(!empty($dataArray)){
                $response = array(
                    'status' => true,
                    'message' => '',
                    'data' => $dataArray
                );
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_data'),
                    'data' => array()
                );
            }
        }else{
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        return $response;
    }
    
    
    function _getEmployeeSessionsList(){
        
        if(isset($_POST['companyId'])){
            if($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME){
                $company_id = $this->ci->session->userdata('company_id');
            }else{
                $company_id = $this->ci->input->post('companyId', true);
            }
            
            $employeeSessions = $this->model->getEmployeeSessions($company_id)->result();
            $response = array(
                    'status' => true,
                    'message' => '',
                    'data' => $employeeSessions
                );
        }else{
            $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_data'),
                    'data' => array()
                ); 
        }
        return $response;
    }
    
    
    function _updateEmployeeSession(){
        
       $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $this->resetResponse(); 
        $this->ci->form_validation->set_rules('employeeId', 'Employee Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('sessions[]', 'Employee Sessions', 'required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        
        if ($this->ci->form_validation->run() == FALSE) {
            
            return $response = array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {
            $sessions = $this->ci->input->post('sessions[]', true);
            $employeeId = $this->ci->input->post('employeeId', true);
            
            $info = array();
            $info['employee_session_monday']    = $sessions[0];
            $info['employee_session_tuesday']   = $sessions[1];
            $info['employee_session_wednesday'] = $sessions[2];
            $info['employee_session_thursday']  = $sessions[3];
            $info['employee_session_friday']    = $sessions[4];
            $info['employee_session_saturday']  = $sessions[5];
            $info['employee_session_sunday']    = $sessions[6];
            $info['employee_session_updated_by'] = $person_id;
            
            $employee_data = $this->model->get_tb('mm_employee_session','*', array('employee_session_employee_id'=>$employeeId))->result();
            
            if($employee_data && !empty($employee_data)){
                $this->model->update_tb('mm_employee_session', array('employee_session_employee_id'=>$employeeId), $info);
                if ($this->model->getAffectedRowCount() > 0) {
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('employee_updated');
                } else {
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('no_changes_to_update');
                }
            }else{
                $info['employee_session_employee_id'] = $employeeId;
                $insert_id = $this->model->insert_tb('mm_employee_session',$info);  
                if($insert_id > 0){
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('employee_updated');
                }
            }
            unset($info);
            
            return $this->getResponse();
        }
    }
    
    function _getEmployeesOfCompany(){
        
        $this->ci->load->library('form_validation');

        $this->resetResponse(); 
        $this->ci->form_validation->set_rules('companyId', 'Company Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        
        if ($this->ci->form_validation->run() == FALSE) {
            
            return $response = array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $companyId = $this->ci->input->post('companyId', true);

            $employee_data = $this->model->get_tb('mm_company_employees','employee_id, employee_name', array('employee_company_id'=>$companyId))->result();
            
            if($employee_data && !empty($employee_data)){
                $this->_status = true;
                $this->_rdata = $employee_data;
            }else{
                $this->_status = false;
                $this->_message = $this->ci->lang->line('invalid_data'); 
            }
            
            
            return $this->getResponse();
        }
    }
    
    
    function _addEmployeeSplSession(){
       $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $this->resetResponse(); 
        $this->ci->form_validation->set_rules('employeeId', 'Employee Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('fromdate', 'From Date', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('toDate', 'To Date', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('session', 'Session Id', 'trim|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('dayOff', 'Day Off', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        
        if ($this->ci->form_validation->run() == FALSE) {
            
            return $response = array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {
            
            $fromDate   = date('Y-m-d',strtotime($this->ci->input->post('fromdate', true)));
            $toDate     = date('Y-m-d',strtotime($this->ci->input->post('toDate', true)));
            $session    = $this->ci->input->post('session', true);
            $dayOff     = $this->ci->input->post('dayOff', true);
            $employeeId = $this->ci->input->post('employeeId', true);
            
            if($dayOff == 0 && $session == ''){
                return $response = array('status' => false, 'message' => $this->ci->lang->line('select_session'));
            }
            
            $info = array();
            $info['employee_session_spl_employee_id']   = $employeeId;
            $info['employee_session_spl_date_from']     = $fromDate;
            $info['employee_session_spl_date_to']       = $toDate;
            if($session != ''){
                $info['employee_session_spl_session_id']    = $session;
            }
            $info['employee_session_spl_off_status']    = $dayOff;
            $info['employee_session_spl_updated_by']    = $person_id;
            
            $employee_data = $this->model->get_tb('mm_employee_session_spl','*', $info)->result();
            
            if($employee_data && !empty($employee_data)){
                $this->_status = false;
                $this->_message = $this->ci->lang->line('record_already_exists');
            }else{
                $insert_id = $this->model->insert_tb('mm_employee_session_spl',$info);  
                if($insert_id > 0){
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('employee_updated');
                }
            }
            unset($info);
            
            return $this->getResponse();
        } 
    }
    
    
    function _getEmployeeSplSessionsList(){
        if(isset($_POST['company_spl'])){
            if($this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->ci->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME){
                $company_id = $this->ci->session->userdata('company_id');
            }else{
                $company_id = $this->ci->input->post('company_spl', true);
            }
            
            $employeeSplSessions = $this->model->getEmployeeSplSessions($company_id)->result();
            $response = array(
                    'status' => true,
                    'message' => '',
                    'data' => $employeeSplSessions
                );
        }else{
            $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_data'),
                    'data' => array()
                ); 
        }
        return $response;
    }


    function _googlePlusLogin(){
$this->resetResponse();
        if(isset($_POST['id_token']) && $_POST['id_token'] !=''){
            $token = $_POST['id_token'];
            //$this->ci->load->library('googleplus_lib');           
            //$response = $this->ci->googleplus_lib->verifyToken($token);
            
            //load the Curl library
            $this->ci->load->library('curl'); 
            //Request using GET Method
            $get_url = "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=".$token;  
            $response = $this->ci->curl->_simple_call('get', $get_url, false, array(CURLOPT_USERAGENT => true)); 

            $response = json_decode($response);
            $email = $response->email;
            $email_verified = $response->email_verified;
            if($email != '' && $email_verified == true){
//print_r($response); 
                    $res = $this->_loginGoogleUser($email, $token);
                    //print_r($res); exit;
                    if($res['status']){
                            $this->_status = true;
                            $this->_message = $this->ci->lang->line('mm_user_login_welcome');
                            $this->_rdata  = array('url' => $res['home_url']);
                            $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('mm_user_login_welcome'));
                    }else{
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
                        $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('mm_frontend_login_error_login_incorrect'));
                    }
               
            }else{
                $this->_status = false;
                $this->_message = "Please provide access to email-id in google plus account to verify your email id for login.";
                $this->ci->session->set_flashdata('error_message', "Please provide access to email-id in google plus account to verify your email id for login.");
                }
        }else{
                $this->_status = false;
                $this->_message = $this->lang->line('invalid_data');  
                $this->ci->session->set_flashdata('error_message', $this->ci->lang->line('invalid_data'));             
        }
        return $this->getResponse();    

    }

    function _loginGoogleUser($email, $token){

        $user = $this->model->getPersonDetails('person_id, person_email, person_first_name, person_last_name, person_id, person_type_name, person_lang_code, person_status, person_profile_image, person_country_code, person_type, person_type_name', array('person_email' => $email, 'person_status' => 1))->row();

            if (isset($user->person_id) && strlen($user->person_id) > 0) {

                $this->_set_last_ip_and_last_login($user->person_id);
                $this->_set_session($user->person_type_name, $user, true, $token);

                
                return array('status' => true,'home_url' => $this->getUserHomeUrl());
                

            } else {

                return array('status' => false, 'home_url' => '');
            }

    }

    function _getEmployeeBookedDates(){
        $this->ci->load->library('form_validation');

        $this->ci->form_validation->set_rules('employeeId', 'Employee Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        if ($this->ci->form_validation->run() == FALSE) {
            
            return $response = array();
        } else {

            $employeeId = $this->ci->input->post('employeeId', true);
            $startDate  = $this->ci->input->post('start', true);
            $endDate    = $this->ci->input->post('end', true); 
            $result = $this->model->getEmployeeBookedDates($employeeId, $startDate, $endDate);
            //echo $this->model->last_query();
            $events = array();
            if(!empty($result))
            {
                $i=0;
                foreach($result as $date){
                  $events[$i]['class'] = 'show_model';  
                  $events[$i]['title'] = 'Booking Id - '.$date->booking_id;
                  $events[$i]['start'] = $date->booking_sessions_service_date;
                  $events[$i]['allDay']= true;
                  $events[$i]['url']   = '';
                  $i++;
                }
            }
            return $events;
        }

    }


    function _getEmployeeOffDates(){

        $this->ci->load->library('form_validation');

        $this->ci->form_validation->set_rules('employeeId', 'Employee Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        if ($this->ci->form_validation->run() == FALSE) {
            
            return $response = array();
        } else {

            $employeeId = $this->ci->input->post('employeeId', true);
            $startDate  = $this->ci->input->post('start', true);
            $endDate    = $this->ci->input->post('end', true); 
            $result = $this->model->getEmployeeOffDates($employeeId, $startDate, $endDate);
            //echo $this->model->last_query();
            $events = array();
            if(!empty($result))
                    {
                        $i=0;
                        foreach($result as $date){
                          $events[$i]['class'] = 'show_model';  
                          $events[$i]['title'] = 'Holiday';
                          $events[$i]['start'] = $date->employee_session_spl_date_from;
                          $events[$i]['end'] = $date->employee_session_spl_date_to;
                          $events[$i]['allDay']= true;
                          $events[$i]['url']   = '';
                          $i++;
                        }
                    }
            return $events;
        }
    }

}
