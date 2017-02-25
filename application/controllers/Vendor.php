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
            $this->data['active']        = "myjob||newjob"; 
            $this -> load -> view('template', $this->data);
        }
        
        public function activeJobList(){
            
            $this->data['content']  = "vendor/activeJob.php";
            $this->data['newVendor']     = 1;
            $this->data['active']        = "myjob||newjob"; 
            $this -> load -> view('template', $this->data);
            
        }

        public function canceledJobList(){
            
            $this->data['content']  = "vendor/canceledJob.php";
            $this->data['newVendor']     = 1;
            $this->data['active']        = "myjob||canceljob"; 
            $this -> load -> view('template', $this->data);
            
        }
        
        public function completedJobList(){
            
            $this->data['content']  = "vendor/completedJob.php";
            $this->data['newVendor']     = 1;
            $this->data['active']        = "myjob||completejob"; 
            $this -> load -> view('template', $this->data);
            
        }
        
        public function rescheduleJobList(){
            
            $this->data['content']  = "vendor/rescheduleJob.php";
            $this->data['newVendor']     = 1;
            $this->data['active']        = "myjob||reschedulejob"; 
            $this -> load -> view('template', $this->data);
            
        }
}

