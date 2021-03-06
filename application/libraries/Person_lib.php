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
        $this->ci->form_validation->set_rules('repassword', 'Password Confirmation', 'trim|required|xss_clean|encode_php_tags|matches[password]');
        $this->ci->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('address', 'address', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('address1', 'address 1', 'trim|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('pincode', 'Postal Code', 'trim|xss_clean|encode_php_tags|min_length[4]|numeric');
        $this->ci->form_validation->set_rules('state', 'State', 'trim|required|xss_clean|encode_php_tags');
        $this->ci->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|encode_php_tags|min_length[10]|numeric');
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

                    if ($this->ci->input->post('type', true) == 1) {
                        $comp_info = array();
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

                        $this->_create_company('mm_vendor_company', $comp_info);
                    }

                    if ($user_id != '') {
                        $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('mm_vendor_registration_successfull'));
                        
                        $sender = $this->ci->data['config']['sender_email'];
                        $recipient = $info['person_email'];
                        $subject = "Login Information";
                        $message = "<html><body>";
                        $message .= "<p>Dear User,</p><br>";
                        $message .= "<p>Your Login Credentials:</p>";
                        $message .= "<p>Email: &nbsp; <b>".$info['person_email']."</b></p>";
                        $message .= "<p>Password: &nbsp; <b>".$this->ci->input->post('password', true)."</b></p>";
                        $message .= "<p><a href='". base_url()."vendor_login.html'>Click here</a> to login</p>";
                        $message .= "</body></html>";
                        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));

                        
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
    function _set_session($type, $data) {
        // Set session data array

        $user = array(
            'user_id' => $data->person_id,
            'user_email' => $data->person_email,
            'user_type' => $type,
            'user_fullname' => ucfirst($data->person_first_name) . " " . ucfirst($data->person_last_name),
            'user_firstname' => ucfirst($data->person_first_name),
            'user_country_code' => $data->person_country_code,
            'user_profile_image' => $data->person_profile_image,
            'user_lang_code' => $data->person_lang_code,
            'user_status' => $data->person_status,
            'user_lang' => 'english'
        );
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
                    $redirect_url = "home.html";
                    break;
                case Globals::PERSON_TYPE_VENDOR_NAME:
                    $redirect_url = "vendor_home.html";
                    break;
                case Globals::PERSON_TYPE_FREELANCER_NAME:
                    $redirect_url = "freelance_home.html";
                    break;
            }
            redirect($redirect_url, 'refresh');
        }
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
        $this->ci->session->sess_destroy();
        //$this->ci->session->sess_create();

        $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('np_frontend_message_logout_successfully'));
        redirect($redirect_url, 'refresh');
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
            if (isset($user->person_id) && strlen($user->person_id) > 0 && $user->person_archived != 0) {
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

}
