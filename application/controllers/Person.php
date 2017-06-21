<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Person extends CI_Controller{

    public $data = array();
    private $_bLang = 'english';
    private $_bLang_code = 'en';
    public $uLang = '';

    public function __construct() {
        parent::__construct();
        $this->load->library(array('person_lib', 'page_load_lib'));
        $this->load->helper(array('form', 'language'));
        $this->uLang = $this->session->userdata('user_lang'); 
        //$lang = $this -> session -> userdata('browser_lang');
//        if($lang!=''){
//            $this->_bLang = $lang;
//            $this->_bLang_code = $this -> session -> userdata('browser_lang_code');
//        }
//	$this->lang->load("np",$this->_bLang);
    }
    
    public function pageNotFound(){
        $this->data['content']  = "page_not_found.php";
        $this->data['vendor']     = 1;       
        $this->load->view('template', $this->data);
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(404)
            ->set_output(json_encode(array('status'=>false, 'message'=>'invalid url.')));
            
    }

    function userLogin() {
        if($this->session->userdata('user_id') != NULL) { $this->person_lib->redirect_home();}
        if (isset($_POST['email'])) {           
            if ($this->person_lib->_login_user()) {
                redirect('home.html', 'refresh');
                exit;
            }
        }
        
        $this->data['content']  = "user/login.php";
        $this->data['user']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }
    
    function bookingUserLogin(){
        if (isset($_POST['email'])) {           
            $response = $this->person_lib->_booking_login_user();

        }else{
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
    
        echo json_encode($response);
        
    }
    
    function userRegister() {
        if($this->session->userdata('user_id') != NULL) { $this->person_lib->redirect_home();}
        if (isset($_POST['email'])) {
            if ($this->person_lib->_register_user()) {    
                //redirect('user_register.html', 'refresh');
                exit;
            }
        }

        $this->load->model('mm_model');
        $states = $this->mm_model->get_tb('mm_state', '*')->result();
        $this->data['state'] = $states;


        $this->data['content']    = "user/register.php";
        $this->data['user']       = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }

    public function vendorLogin() {
        if($this->session->userdata('user_id') != NULL) { $this->person_lib->redirect_home();}
        if (isset($_POST['email'])) {           
            if ($this->person_lib->_login_vendor()) {                
                exit;
            }
        }
        
        $this->data['content']      = "vendor/login.php";
        $this->data['oldvendor']    = 1;
        $this->data['home']         = 1;
        $this->load->view('template', $this->data);
    }

    public function vendorRegister() {
        if($this->session->userdata('user_id') != NULL) { $this->person_lib->redirect_home();}
        if (isset($_POST['email'])) {

            if ($this->person_lib->_register_vendor()) {
                //redirect('vendor_register.html', 'refresh');
                exit;
            }
        } 
        $this->load->model('mm_model');
        $states = $this->mm_model->get_tb('mm_state', '*')->result();
        $data['state'] = $states;
        $data['content'] = "vendor/register.php";
        $data['oldvendor']      = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $data);
        
    }
    
    public function adminLogin() {
        if($this->session->userdata('user_id') != NULL) { $this->person_lib->redirect_home();}
        
        if (isset($_POST['email'])) {         
            if ($this->person_lib->_login_admin()) {                
                exit;
            }
        }
        
        $this->data['content'] = "admin/login.php";
        $this->data['admin'] = 1;
        $this->data['login'] = 1;
        $this->load->view('template', $this->data);
    }
    
    function logout()
    {
	$this->person_lib->logout();
    }
    
    function forgotPassword(){
        if($this->session->userdata('user_id') != NULL) { $this->person_lib->redirect_home();}        
        
        if (isset($_POST['id'])) { 
            $this->person_lib->_forgotpass();
        }
        
        $this->data['content'] = "forgotPassword.php";
         $this->data['login'] = 1;
        $this->load->view('template', $this->data);
    }
    
    /**
     * Reset Password
      * @param	string	$token	unique token key
     */
    function resetpassword($token)
    {
        $db = get_instance()->db->conn_id;
        $token  = mysqli_real_escape_string($db,trim($token));
        
            $now  = date('Y-m-d H:i:s');
            $this->load->model('person_model');
            $result = $this->person_model->get_tb('mm_password_reset','*',array('pass_reset_token_key'=>$token))->row();
            //echo "<pre>";   print_r($result); exit;
            if(!empty($result) && count($result)>0)
            {
                if( ($now <= $result->pass_reset_expires_at) && ($result->pass_reset_status==0) )
                {
                    if(isset($_POST['password']))
                    {
                        $this->person_lib->_resetpass($token);
                    }    
                }else{
                    $this -> session -> set_flashdata('error_message', "URL has expired!!");
                    redirect('', 'refresh');
                    exit;
                }
            }else{
                $this -> session -> set_flashdata('error_message', "Wrong url request!!");
                redirect('', 'refresh');
                    exit;
            }  

        $this->data['content']  = "resetPassword.php";
        $this->data['token']    = $token;
        $this->data['login']    = 1;
        $this->load->view('template',$this->data);
        
    }
    
    public function termsAndConditionPage(){
        $this->data['content']  = "user/terms_and_condition.php";
        $this->data['user']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }
    
    public function pricingPage(){
        $this->data['content']  = "user/pricing.php";
        $this->data['user']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }
    
    public function privacyPolicyPage(){
        $this->data['content']  = "user/privacy_policy.php";
        $this->data['user']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }
    
    public function refundPolicyPage(){
        $this->data['content']  = "user/refund_policy.php";
        $this->data['user']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }

}

?>