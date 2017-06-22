<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'controllers/Base.php';
class Booking extends Base {
   
        public $data = array();
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('booking_lib'));
            //$this->uLang = $this->session->userdata('user_lang');  
            $this->booking_lib->getMyAccountUrl();
            $this -> lang -> load("mm", $this->uLang);
        }
        
	public function index(){

            $this->data['content']  = "booking/home.php";
            $this->data['booking']     = 1;
            $this->data['home']     = 1;
            $this -> load -> view('template', $this->data);
	}
        
        public function booking(){
            if(isset($_POST['pincode']) || $this->session->userdata('service_location_search') !== null){           
                $serviceAvailable = $this->booking_lib->_checkServiceAvailable();
                
                if(($serviceAvailable['status'])){
                    $this->data['postcode'] = $serviceAvailable['data'][0]->vendor_service_location_postcode;
                    $this->data['content']  = "booking/booking.php";
                    $this->data['booking']     = 1;
                    $this->data['state']    = $this->mm_model->get_tb('mm_state', '*')->result();
                    $this -> load -> view('template', $this->data);
                }else{
                    $this->session->set_flashdata('error_message', $this->lang->line('mm_no_service_coverage'));
                    redirect('home.html', 'refresh');
                }
            }else{
                redirect('home.html', 'refresh');
            }
        }
        
        public function getServices(){
            $data = $this->readJsonRequest()->getData(); 
          
            if(isset($data->postcode)){   
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
        
        public function getServicePackages(){
            $data = $this->readJsonRequest()->getData();
            if(isset($data->postcode) && !empty($data->serviceId)){   
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
        
        
        public function getServiceFrequencies(){
            $data = $this->readJsonRequest()->getData();
            if(isset($data->postcode) && !empty($data->serviceId)){   
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
                
        
        public function getServiceAddons(){
            $data = $this->readJsonRequest()->getData();
            if(isset($data->postcode) && !empty($data->serviceId)){   
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
        
        
        public function getServiceSplRequests(){
            $data = $this->readJsonRequest()->getData();
            if(isset($data->postcode) && !empty($data->serviceId)){   
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
        
        
        public function payTest(){
            
            $this->data['content']  = "booking/pay_test.php";
            $this->data['booking']     = 0;
            $this->data['home']     = 0;
            $this -> load -> view('template', $this->data);
            
        }
        
        /*
         * Function to store/process the user booking request
         */
        public function bookingInfo(){
            
            $data = $this->readJsonRequest()->getData();
            if(isset($data->service) && isset($data->package) && isset($data->servicePostcode)){
                $response = $this->booking_lib->_saveServiceBooking($data);
            }else {
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_data'),
                    'data' => array()
                );
            }
            echo json_encode($response); 
            //print_r($data);
            
            
            
        }
        
        /*
         * Function to get the User details if logged in
         */
        public function getUserDetails(){
            $response = $this->booking_lib->_getUserDeatils();
            echo json_encode($response); 
        }
        
        
}
