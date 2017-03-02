<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
   
        public $data = array();
        public $uLang = '';
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('admin_lib', 'page_load_lib'));
            $this -> load -> helper(array('form', 'language'));
            //$this->uLang = $this->session->userdata('user_lang');               
            //$this -> lang -> load("np", $this->uLang);
        }
        
	public function index(){

            $this->data['content']  = "admin/home.php";
            $this->data['admin']     = 1;
            $this -> load -> view('template', $this->data);
	}
        
        
}