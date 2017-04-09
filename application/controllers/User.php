<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'controllers/Base.php';
class User extends Base {
   
        public $data = array();
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('user_lib'));
            //$this->uLang = $this->session->userdata('user_lang');               
            //$this -> lang -> load("np", $this->uLang);
        }
        
	public function index(){

            $this->data['content']  = "user/home.php";
            $this->data['user']     = 1;
            $this->data['home']     = 1;
            $this -> load -> view('template', $this->data);
	}
        
        public function booking(){
            $this->data['content']  = "user/booking.php";
            $this->data['user']     = 1;
            $this -> load -> view('template', $this->data);
        }
        
        
}
