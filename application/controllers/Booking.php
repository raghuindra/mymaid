<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'controllers/Base.php';

class Booking extends Base {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('booking_lib', 'page_load_lib'));
        //$this->uLang = $this->session->userdata('user_lang');  
        $this->booking_lib->getMyAccountUrl();
        $this->lang->load("mm", $this->uLang);
    }

    public function index() {

        $this->data['content'] = "booking/home.php";
        $this->data['booking'] = 1;
        $this->data['home'] = 1;
        $this->load->view('template', $this->data);
    }

    public function booking() {
        if (isset($_POST['pincode']) || $this->session->userdata('service_location_search') !== null) {
            $serviceAvailable = $this->booking_lib->_checkServiceAvailable();

            if (($serviceAvailable['status'])) {
                $this->data['postcode'] = $serviceAvailable['data'][0]->vendor_service_location_postcode;
                $this->data['content'] = "booking/booking.php";
                $this->data['booking'] = 1;
                $this->data['state'] = $this->mm_model->get_tb('mm_state', '*')->result();
                $this->data['sessions'] = $this->mm_model->get_tb('mm_session', '*', array('session_status'=>'1'))->result();
                $this->load->view('template', $this->data);
            } else {
                $this->session->set_flashdata('error_message', $this->lang->line('mm_no_service_coverage'));
                $this->session->set_flashdata('service_availability', true);
                redirect('home.html', 'refresh');
            }
        } else {
            redirect('home.html', 'refresh');
        }
    }

    public function serviceRequest(){
        if (isset($_POST['requester_email'])) {
            $response = $this->booking_lib->_service_request_submission();
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }

    public function getServices() {
        $data = $this->readJsonRequest()->getData();

        if (isset($data->postcode)) {
            $response = $this->booking_lib->_getServices($data);
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }

    public function getServicePackages() {
        $data = $this->readJsonRequest()->getData();
        if (isset($data->postcode) && !empty($data->serviceId)) {
            $response = $this->booking_lib->_getServicePackages($data);
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }

    public function getServiceFrequencies() {
        $data = $this->readJsonRequest()->getData();
        if (isset($data->postcode) && !empty($data->serviceId)) {
            $response = $this->booking_lib->_getServiceFrequencies($data);
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }

    public function getServiceAddons() {
        $data = $this->readJsonRequest()->getData();
        if (isset($data->postcode) && !empty($data->serviceId)) {
            $response = $this->booking_lib->_getServiceAddons($data);
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }

    public function getServiceSplRequests() {
        $data = $this->readJsonRequest()->getData();
        if (isset($data->postcode) && !empty($data->serviceId)) {
            $response = $this->booking_lib->_getServiceSplRequests($data);
        } else {
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }

    public function payTest() {

        $this->data['content'] = "booking/pay_test.php";
        $this->data['booking'] = 0;
        $this->data['home'] = 0;
        $this->load->view('template', $this->data);
    }

    /*
     * Function to store/process the user booking request
     */

    public function bookingInfo() {

        $data = $this->readJsonRequest()->getData(); 
        if (isset($data->service) && isset($data->package) && isset($data->servicePostcode)) {
            $response = $this->booking_lib->_saveServiceBooking($data);
        } else {
            $response = array(
                'status' => false,
                'message' => "Please ensure, Service/Package/Postcode is selected.",
                'data' => array()
            );
        }
        echo json_encode($response);
        //print_r($data);
    }

    /*
     * Function to get the User details if logged in
     */

    public function getUserDetails() {
        $response = $this->booking_lib->_getUserDeatils();
        echo json_encode($response);
    }
    
    
    public function payResponseHandler(){
        if (isset($_POST['HashValue']) && isset($_POST['PaymentID'])) {
            $response = $this->booking_lib->_checkPayResponse();

            $this->data['pay_data'] = $response;
            $this->data['content'] = "booking/pay_response.php";
            $this->data['booking'] = 1;
            $this->load->view('template', $this->data);

        } else {
            redirect('home.html', 'refresh');
        }
    }
    
    
    public function getServiceOrderDetails(){
        if($this->session->userdata('user_id') == NULL) { $this->person_lib->redirect_home(); exit;}
        if(isset($_POST['booking_id']) && 
                ($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME || 
                $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || 
                $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME ||
                $this->session->userdata('user_type') == Globals::PERSON_TYPE_USER_NAME ) ){

            $this->data['response'] = $this->booking_lib->_getServiceOrderDetails();

        }else{
            $this->data['response'] = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            ); 
        }
        
        $this->load->view('booking/popup/order_details.php', $this->data);
        
    }
    
    /*
     * 
     */
    public function employeeDetails(){
       if($this->session->userdata('user_id') == NULL) { $this->person_lib->redirect_home(); exit;}
       if(isset($_POST['bookingId']) && 
                ($this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME || 
                $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || 
                $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME ||
                $this->session->userdata('user_type') == Globals::PERSON_TYPE_USER_NAME ) ){

            $this->data['response'] = $this->booking_lib->_getEmployeeDetails();

        }else{
            $this->data['response'] = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            ); 
        }
        
        $this->load->view('booking/popup/employee_details.php', $this->data);
        
    }

    public function contactUsMessage(){
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject'])){
            $response = $this->booking_lib->_contactUsMessage();
        }else{
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_data'),
                'data' => array()
            );
        }
        redirect('home.html', 'refresh');
    }

    public function getOrderInvoice(){

        $this->load->model('booking_model');
        $person_id = $this->session->userdata('user_id');
        $booking_id = $this->input->get('booking_id', true);
        if($booking_id != '' && $booking_id !=0 && $booking_id != null){
            $result = $this->booking_model->get_tb('mm_booking', 'booking_user_id', array('booking_user_id'=>$person_id, 'booking_id'=>$booking_id))->result();
            if(!empty($result)){
                $info = array();
                $info['other'] = $this->booking_model->getServiceOrderDetails($booking_id);
                $info['session'] = $this->booking_model->getBookingSessionDateDetails($booking_id);
                $info['addons'] = $this->booking_model->getBookingAddonDetails($booking_id);
                $info['spl_request'] = $this->booking_model->getBookingSplRequestDetails($booking_id);
                $info['status']  = true;
                $this->data['content'] = "booking/user_invoice";
                $this->data['response'] = $info;
                $this -> load -> view('template', $this->data);
            }else{
                redirect('home.html', 'refresh');
            }
        }else{
             redirect('home.html', 'refresh');
        }
    }
    
    public function checkEmployeeAvailabilityForDate(){
        $data = $this->readJsonRequest()->getData(); 
        if(isset($data->serviceDate) && $data->serviceDate != '' && isset($data->sessionId) && isset($data->postcode) ){
            
            if(isset($data->package) && $data->package != ''){
                $response = $this->booking_lib->_checkEmployeeAvailabilityForDate($data);
              
            }else{
                $response = array(
                    'status' => false,
                    'message' => "Please select service package before service date.",
                    'data' => array()
                );
            }
        }else{
            $response = array(
                'status' => false,
                'message' => "Invalid request",
                'data' => array()
            );
        }
        echo json_encode($response);
    }

}
