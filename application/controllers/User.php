<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    
        public $data = array();
    
	public function index(){

            $this->data['content']  = "user/home.php";
            $this->data['user']     = 1;
            $this -> load -> view('template', $this->data);
	}
        
        public function login(){
            $this->data['content']  = "user/login.php";
            $this->data['user']     = 1;
            $this -> load -> view('template', $this->data);
            
        }
        
        public function register(){
            
            $data = array();
            
            if(isset($_POST['userName'])){
                if($this -> user_lib -> _register_user()){                          
                        redirect('home.html','refresh');
                        exit;
                }
                
            }else{
                $data['content']    = "user/register.php";
                $data['user']       = 1;
                $this->load->view('template',$data);
            }
            
        }
}
