<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'controllers/Base.php';
class Vendor extends Base {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('vendor_lib'));
        $this->uLang = $this->session->userdata('user_lang');
        $this->lang->load("vendor", $this->uLang);
        //$this->lang->load("vendor_msg", $this->uLang);
        //$this->lang->load("vendor_leftbar", $this->uLang);
        $this->page_load_lib->validate_user('vendor');
    }

    public function index() {

        $this->data['content'] = "vendor/home.php";
        $this->data['vendor'] = 1;
        $this->load->view('template', $this->data);
    }

    public function newJobList() {
        $this->data['content'] = "vendor/newJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||new";
        $this->load->view('template', $this->data);
    }

    public function activeJobList() {

        $this->data['content'] = "vendor/activeJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||active";
        $this->load->view('template', $this->data);
    }

    public function canceledJobList() {

        $this->data['content'] = "vendor/canceledJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||cancel";
        $this->load->view('template', $this->data);
    }

    public function completedJobList() {

        $this->data['content'] = "vendor/completedJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||completed";
        $this->load->view('template', $this->data);
    }

    public function rescheduleJobList() {

        $this->data['content'] = "vendor/rescheduleJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||reschedule";
        $this->load->view('template', $this->data);
    }

    public function walletPendingPay() {

        $this->data['content'] = "vendor/walletPendingPay.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||pending";
        $this->load->view('template', $this->data);
    }

    public function walletRequestPay() {

        $this->data['content'] = "vendor/walletRequestPay.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||request";
        $this->load->view('template', $this->data);
    }

    public function walletReport() {

        $this->data['content'] = "vendor/walletReport.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||report";
        $this->load->view('template', $this->data);
    }

    public function myAccountCompany() {
        $this->load->model('mm_model');
        
        $this->data['company_info'] = $this->vendor_lib->_getCompanyDetail();        
        $this->data['states']        = $this->mm_model->get_tb('mm_state', '*')->result();
        $this->data['content']      = "vendor/myaccount_company.php";
        $this->data['vendor']       = 1;
        $this->data['active']       = "myaccount||company";
        $this->load->view('template', $this->data);
    }

    /** Function to render the Company Detail View
     * @param null 
     * @return null render the view 
    */
    public function myAccountBank() {
        $this->data['content'] = "vendor/myaccount_bank.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myaccount||bank";
        $this->load->view('template', $this->data);
    }

    public function profile() {

        $this->data['profile'] = $this->vendor_lib->getProfileDetails();
        $this->data['bank'] = $this->vendor_lib->getBankDetails();
        $this->data['content'] = "vendor/profile.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "";
        $this->load->view('template', $this->data);
    }

    /** Function to update the Bank Details
     * @param null 
     * @return JSON Return JSON response with Bank Details Addition/Update 
     */
    public function updateBankDetails() {

        if (isset($_POST['bnkname'])) {
            $response = $this->vendor_lib->_updateBankDetails();
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }
    
    /** Function to upload the company documents
     * @param null 
     * @return JSON Return JSON response with company doc upload status 
     */
    public function uploadCompanySsmDoc(){
        //print_r($_FILES); exit;
        if(isset($_FILES['ssmFile'])){                 
            $response = $this->vendor_lib->_uploadCompanyDoc('ssmFile');                   
        }else{
            $response = array(
                'success' => 0,
                'message' => $this->lang->line('something_problem'),
                'data' => array()
            );           
        }
        echo json_encode($response);
        
    }
    
    /** Function to upload the company Id card Document
     * @param null 
     * @return JSON Return JSON response with company doc upload status 
    */
    public function uploadCompanyIdDoc(){
        if(isset($_FILES['idFile'])){                 
            $response = $this->vendor_lib->_uploadCompanyDoc('idFile');                 
        }else{
            $response = array(
                'success' => 0,
                'message' => $this->lang->line('something_problem'),
                'data' => array()
            );           
        }
        echo json_encode($response);
    }
    
    /** Function to update the company details
     * @param null 
     * @return JSON Return JSON response with company detail update status 
    */
    public function updateCompanyDetail(){
        if (isset($_POST['cpname'])) {
            $response = $this->vendor_lib->_updateCompanyDetail();
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }
    
    /** Function to Upload Employee Id Doc
     * @param null 
     * @return JSON Return JSON response with employee id card upload status 
    */
    public function uploadEmployeeIdDoc(){
        if(isset($_FILES['empIdFile'])){                 
            $response = $this->vendor_lib->_uploadEmployeeDoc('empIdFile');                 
        }else{
            $response = array(
                'success' => 0,
                'message' => $this->lang->line('something_problem'),
                'data' => array()
            );           
        }
        echo json_encode($response);
    }
    
    /** Function to Create Employee
     * @param null 
     * @return JSON Return JSON response with employee creation status 
    */
    public function createEmployee(){
        
        if (isset($_POST['employee_name'])) {
            $response = $this->vendor_lib->_createEmployee();
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
        
    }
    
    /** Function to List Employees
     * @param null 
     * @return JSON Return JSON response with employee list 
    */
    public function listEmployees(){
        
        if(isset($_POST['archived'])){
            $response = $this->vendor_lib->_listEmployees();
        }else{
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_request'),
                'data' => array()
            );
        }
        echo json_encode($response);
        
    }

}
