<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
    
    
    public $data = array();
    
	public function index(){

            $this->data['content']  = "vendor/home.php";
            $this->data['newVendor']     = 1;
            $this -> load -> view('template', $this->data);
	}
        
        public function login(){
            $this->data['content']  = "vendor/login.php";
            $this->data['vendor']     = 1;
            $this -> load -> view('template', $this->data);
            
        }
        
        public function register(){
            
            $data = array();
            if(isset($_POST['userName'])){
                if($this -> user_lib -> _update_member($person_id)){                          
                        redirect('vendor_profile.html','refresh');
                        exit;
                }
                
            }else{
                $data['content']    = "vendor/register.php";
                $data['vendor']       = 1;
                $this->load->view('template',$data);
            }
            
        }
        
        public function newJobList(){
            $this->data['content']  = "vendor/newJob.php";
            $this->data['newVendor']     = 1;
            $this->data['active']        = "myjob||new"; 
            $this -> load -> view('template', $this->data);
        }
        
        public function activeJobList(){
            
            $this->data['content']  = "vendor/activeJob.php";
            $this->data['newVendor']     = 1;
            $this->data['active']        = "myjob||active"; 
            $this -> load -> view('template', $this->data);
            
        }

        public function canceledJobList(){
            
            $this->data['content']  = "vendor/canceledJob.php";
            $this->data['newVendor']     = 1;
            $this->data['active']        = "myjob||cancel"; 
            $this -> load -> view('template', $this->data);
            
        }
        
        public function completedJobList(){
            
            $this->data['content']  = "vendor/completedJob.php";
            $this->data['newVendor']     = 1;
            $this->data['active']        = "myjob||completed"; 
            $this -> load -> view('template', $this->data);
            
        }
        
        public function rescheduleJobList(){
            
            $this->data['content']          = "vendor/rescheduleJob.php";
            $this->data['newVendor']        = 1;
            $this->data['active']           = "myjob||reschedule"; 
            $this -> load -> view('template', $this->data);
            
        }
        
        
        public function walletPendingPay(){
            
            $this->data['content']          = "vendor/walletPendingPay.php";
            $this->data['newVendor']        = 1;
            $this->data['active']           = "wallet||pending"; 
            $this -> load -> view('template', $this->data);
            
        }
        
        public function walletRequestPay(){
            
            $this->data['content']          = "vendor/walletRequestPay.php";
            $this->data['newVendor']        = 1;
            $this->data['active']           = "wallet||request"; 
            $this -> load -> view('template', $this->data);
            
        }
        
        public function walletReport(){
            
            $this->data['content']          = "vendor/walletReport.php";
            $this->data['newVendor']        = 1;
            $this->data['active']           = "wallet||report"; 
            $this -> load -> view('template', $this->data);
            
        }
        
        public function myAccount(){
            $this->data['content']          = "vendor/myaccount.php";
            $this->data['newVendor']        = 1;
            $this->data['active']           = "myaccount||vendor"; 
            $this -> load -> view('template', $this->data);
        }

        public function myAccountFreelance(){
            $this->data['content']          = "vendor/myaccount_freelance.php";
            $this->data['newVendor']        = 1;
            $this->data['active']           = "myaccount||freelance"; 
            $this -> load -> view('template', $this->data); 
        }
}

