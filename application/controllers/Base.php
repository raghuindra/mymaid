<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
   
        public $uLang = 'en';
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('page_load_lib'));
            $this -> load -> helper(array('form', 'language'));
            $this->uLang = $this->session->userdata('user_lang');               
            $this -> lang -> load("mm", $this->uLang);
        }
}