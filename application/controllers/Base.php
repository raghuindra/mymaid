<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
   
        public $uLang = 'en';
        private $request;
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('page_load_lib'));
            $this -> load -> helper(array('form', 'language'));
            $this->uLang = $this->session->userdata('user_lang');               
            $this -> lang -> load("mm", $this->uLang);
        }
        
        public function readJsonRequest(){ 
            $this->request =  json_decode(file_get_contents('php://input')); 
           // print_r($this->request); exit;
            return $this;
            
        }
        
        public function getData(){
            return $this->request->data;
        }
        
        public function getHeader(){
            return $this->request->header;
        }
}