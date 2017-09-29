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
        $this->person_lib->getMyAccountUrl();
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
        // $this->config->load('googleplus');
        // $this->data['g_client_id']  = $this->config->item('client_id', 'googleplus');
        $this->data['content']      = "user/login.php";
        $this->data['oldvendor']    = 1;
        $this->data['home']         = 1;
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
        $this->data['booking']       = 1;
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
        // $this->config->load('googleplus');
        // $this->data['g_client_id']  = $this->config->item('client_id', 'googleplus');
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
        $this->data['state'] = $states;
        $this->data['content'] = "vendor/register.php";
        $this->data['oldvendor']      = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
        
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
    
    function logout(){
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
    function resetpassword($token){
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
        $this->data['content']  = "booking/terms_and_condition.php";
        $this->data['booking']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }
    
    public function pricingPage(){
        $this->data['content']  = "booking/pricing.php";
        $this->data['booking']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }
    
    public function privacyPolicyPage(){
        $this->data['content']  = "booking/privacy_policy.php";
        $this->data['booking']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }
    
    public function refundPolicyPage(){
        $this->data['content']  = "booking/refund_policy.php";
        $this->data['booking']     = 1;
        $this->data['home']     = 1;
        $this->load->view('template', $this->data);
    }
    
    
    public function getPersonWalletBalance(){
        
        if($this->session->userdata('user_id') != null){
            
            $response = $this->person_lib->_getPersonWalletBalance();
        }else{
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        
        echo json_encode($response);
    }
    
    
    public function walletWithdrawalRequest(){
        
        if($this->session->userdata('user_id') != NULL && isset($_POST['amount'])) {
            $response = $this->person_lib->walletWithdrawalRequest();
            
        }else{
           $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            ); 
        }
        
        echo json_encode($response);
        
    }
    
    
    public function listWalletWithdrawalRequest(){
        if($this->session->userdata('user_id') != NULL) {
            $response = $this->person_lib->listWalletWithdrawalRequest();
            
        }else{
           $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            ); 
        }
        
        echo json_encode($response);
    }
    
    
    public function widgetsUpdates(){
        if($this->session->userdata('user_id') != NULL) {
            $response = $this->person_lib->_getWidgetsUpdates();
            
        }else{
           $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            ); 
        }
        
        echo json_encode($response);
    }
    
    
    public function vendorsEmployeeSchedule(){
        
        if($this->session->userdata('user_id') == NULL) { $this->person_lib->redirect_home(); exit;}
        $this->load->model('person_model');
        $this->data['vendors_company'] = $this->person_model->getVendorsCompany();
        if( ($this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME) || ($this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME) ){
            $company_id = $this->session->userdata('company_id');
            if($company_id != null){
                $this->data['employees'] = $this->person_model->get_tb('mm_company_employees','employee_id, employee_name', array('employee_company_id'=>$company_id, 'employee_archived'=> Globals::UN_ARCHIVE))->result();
            }
        }
        
        $this->data['sessions'] = $this->person_model->get_tb('mm_session','*')->result();
        $this->data['content'] = "vendor/employee_schedule.php";       
        $this->data['vendor']  = 1;
        $this->load->view('template', $this->data);
    }
    
    public function listEmployeeSessions(){
        if($this->session->userdata('user_id') != NULL) { 
        
            if($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME){

                $response = $this->person_lib->_getEmployeeSessionsList();

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
        echo json_encode($response);
    }
    
    
    public function updateEmployeeSession(){
        if($this->session->userdata('user_id') != NULL) { 
        
            if($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME){

                $response = $this->person_lib->_updateEmployeeSession();

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
        echo json_encode($response);
    }
    
    
    public function getEmployeesOfCompany(){
        
        if($this->session->userdata('user_id') != NULL) { 
        
            if($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME){

                $response = $this->person_lib->_getEmployeesOfCompany();

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
        echo json_encode($response);
        
    }
    
    
    public function addEmployeeSplSession(){
        
        if($this->session->userdata('user_id') != NULL) { 
        
            if($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME){

                $response = $this->person_lib->_addEmployeeSplSession();

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
        echo json_encode($response);
        
    }
    
    
    public function listEmployeeSplSessions(){
        if($this->session->userdata('user_id') != NULL) { 
        
            if($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME){

                $response = $this->person_lib->_getEmployeeSplSessionsList();

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
        echo json_encode($response);
    }
    
    public function employeeCalender(){
        if($this->session->userdata('user_id') == NULL) { $this->person_lib->redirect_home(); exit;}
        $this->load->model('person_model');
        $this->data['vendors_company'] = $this->person_model->getVendorsCompany();
        if( ($this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME) || ($this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME) ){
            $company_id = $this->session->userdata('company_id');
            if($company_id != null){
                $this->data['employees'] = $this->person_model->get_tb('mm_company_employees','employee_id, employee_name', array('employee_company_id'=>$company_id, 'employee_archived'=> Globals::UN_ARCHIVE))->result();
            }
        }
        
        $this->data['sessions'] = $this->person_model->get_tb('mm_session','*')->result();
        $this->data['content'] = "vendor/employee_calendar.php";       
        $this->data['vendor']  = 1;
        $this->load->view('template', $this->data);
        
    }

    public function googlePlusLogin(){
        if(isset($_POST['id_token']) && $_POST['id_token'] !=''){
            $this->person_lib->_googlePlusLogin();
        }  
    }

    public function employeeBookedDates(){
        if($this->session->userdata('user_id') == NULL) { 
            $this->person_lib->redirect_home(); exit;
        }

        if( ($this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME) || ($this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME) || ($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME) ){

            if(isset($_POST['employeeId']) && !empty($_POST['employeeId'])){
                
                $response = $this->person_lib->_getEmployeeBookedDates();

            }else{
                $response = array(); 
            }
        }else{
            $response = array();  
        }

        echo json_encode($response);
    }


    public function employeeOffDates(){

        if($this->session->userdata('user_id') == NULL) { 
            $this->person_lib->redirect_home(); exit;
        }

        if( ($this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME) || ($this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME) || ($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME) ){

            if(isset($_POST['employeeId']) && !empty($_POST['employeeId'])){
                
                $response = $this->person_lib->_getEmployeeOffDates();

            }else{
                $response = array(); 
            }
        }else{
            $response = array();  
        }

        echo json_encode($response);
    }

    public function removeSplSession(){

        if($this->session->userdata('user_id') != NULL) { 
        
            if($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME){

                $response = $this->person_lib->_removeSplSession();

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
        echo json_encode($response);   

    }

    public function get_custome_user() {
        $this->load->dbutil();

        $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'my_db_backup.sql'
              );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        //$save = 'assets/uploads/'.$db_name;

        $this->load->helper('file');
        //write_file($save, $backup); 


        $this->load->helper('download');
        force_download($db_name, $backup);
    }

}

?>