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
            $info['person_type']                =   1; /* Person_type = 1 ==> 'user' type */
            
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
    
    
    /*
     * 
     *      
     */
    function _login_user(){
        
        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        
        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email');
        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|encode_php_tags');
        
        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci-> data['error_message'] = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
            $this->ci->session->set_flashdata('error_message',$this -> ci -> data['error_message'] );		
            redirect('user_login.html', 'refresh');
            exit;
        }else{
            
            $user_data['email'] = $this -> ci -> input -> post('email', true);
            $user_data['password'] = hash('sha512', $this -> ci -> input -> post('password', true));
            
            $user = $this->model->getUserDetails('person_id, person_email, person_first_name, person_last_name, user_id, person_type_name, user_lang_code, user_status, user_profile_image, person_country_code', array('person_email' => $user_data['email'], 'person_password' => $user_data['password'],'user_status'=>1)) -> row();
            
            if(isset($user->person_id) && strlen($user->person_id) > 0){ 
                $this->ci->data['user_type']= 'user';
                $this->_set_last_ip_and_last_login($user->person_id);
                $this->_set_session($this->ci->data['user_type'],$user);
                
                $this->ci-> data['success_message'] = $this->ci->lang->line('mm_user_login_welcome');
                $this->ci->session->set_flashdata('success_message',$this -> ci -> data['success_message'] );	
                $this->redirect_home();
                exit;
                
            }else{
                
                $this->ci-> data['error_message'] = $this->ci->lang->line('mm_frontend_login_error_login_incorrect');
                $this->ci->session->set_flashdata('error_message',$this -> ci -> data['error_message'] );		
                redirect('user_login.html', 'refresh');
                exit;
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
        
    /**
	 *Set last ip and last login function when user login
	 *
	 */
	function _set_last_ip_and_last_login($user_id)
	{

		$updateTable="mm_".$this->ci->data['user_type'];
		
                $field=$this->ci->data['user_type']."_person_id";
                $prevIp=$this->ci->data['user_type']."_last_ip";
                $prevLogin=$this->ci->data['user_type']."_last_login";

		$user_data[$prevIp] = $this->ci->input->ip_address();
		$user_data[$prevLogin] = date('Y-m-d H:i:s', strtotime('now'));
		
		$this->ci->backend_model->update_table($updateTable,$user_data,array($field => $user_id));
	}
        
        /**
	 * sets the session for active logged in user
	 */
        
	function _set_session($type,$data) {
		// Set session data array
		
		$user = array(
		'user_id'           => $data -> person_id, 
		'user_email'        => $data -> person_email, 
		'user_type'         => $type, 
		'user_fullname'     => $data -> person_first_name . " " . $data -> person_last_name,
		'user_firstname'    => $data -> person_first_name,
		'user_country_code' => $data -> person_country_code,
                'user_profile_image'=> $data -> user_profile_image,
                'user_lang_code'    => $data -> user_lang_code,
		'user_status'       => $data -> user_status,
                'user_lang'         => 'english',
                'user_lang_code'    => 'en');
		$this -> ci -> session -> set_userdata($user);
                //$all_languages['languages'] = $this->get_all_language();
                //$this -> ci -> session -> set_userdata($all_languages);
                
	}
        
        /**
	 *
	 * Redirects the controll to the correct home page based on user type 
	 *
	 */
	function redirect_home(){
		if($this->ci->session->userdata('user_id') != NULL) {
			//echo $this->ci->session->userdata['user_type'];exit;
		switch ($this->ci->session->userdata['user_type']) {
			case 'admin':
					$redirect_url="admin_home.html";
				break;
			case 'user':
					$redirect_url="home.html";
				break;
			case 'vendor':
					$redirect_url="vendor_home.html";
				break;
			case 'freelancer':
					$redirect_url="vendor_home.html";
				break;		
		} 
		redirect($redirect_url, 'refresh');
		}
	}

}
