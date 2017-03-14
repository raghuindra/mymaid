<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
   
        public $data = array();
        public $uLang = 'en';
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('admin_lib', 'page_load_lib'));
            $this -> load -> helper(array('form', 'language'));
            $this->uLang = $this->session->userdata('user_lang');               
            $this -> lang -> load("admin", $this->uLang);
            $this->page_load_lib->validate_user('admin');
        }
        
	public function index(){

            $this->data['content']  = "admin/home.php";
            $this->data['admin']     = 1;
            $this -> load -> view('template', $this->data);
	}
        
        public function services(){
            $this->data['content']  = "admin/serviceList.php";
            $this->data['admin']     = 1;
            $this -> load -> view('template', $this->data);
        }
        
        public function postAddService(){
            
            if(isset($_POST['serviceName'])){
                $response = $this->admin_lib->_addService();
                echo json_encode($response);
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('inavlid_data')
                );
                //$this->session->set_flashdata('error_message', $this->lang->line('inavlid_data'));
                echo json_encode($response);
            }
        }
        
        public function postServiceList(){
            $response = $this->admin_lib->_getServiceList();
            
            echo json_encode($response);
        }
        
        public function postEditService(){
            if(isset($_POST['serviceName'])){
                $response = $this->admin_lib->_editService();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('inavlid_data')
                );
            }
            echo json_encode($response);
        }
        
        
}