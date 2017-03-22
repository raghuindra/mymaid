<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
   
        public $data = array();
        public $uLang = '';
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('user_lib', 'page_load_lib'));
            $this -> load -> helper(array('form', 'language'));
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
