<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Person extends CI_Controller {

    public  $data = array();
    private $_bLang = 'english';
    private $_bLang_code = 'en';
    public  $uLang = '';
    
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library(array('person_lib', 'page_load_lib'));
        $this->load->helper(array('form','language'));
        //$this->uLang = $this->session->userdata('user_lang'); 
        //$lang = $this -> session -> userdata('browser_lang');
//        if($lang!=''){
//            $this->_bLang = $lang;
//            $this->_bLang_code = $this -> session -> userdata('browser_lang_code');
//        }
//	$this->lang->load("np",$this->_bLang);
    }
    
    function userLogin(){
        $this->data['content']  = "user/login.php";
        $this->data['user']     = 1;
        $this -> load -> view('template', $this->data);
    }
       
    
    function userRegister(){
       $data = array();
            
        if(isset($_POST['email'])){
            if($this -> person_lib -> _register_user()){                          
                    redirect('home.html','refresh');
                    exit;
            }
        }
       
            $this->load->model('mm_model');
            $states = $this->mm_model->get_tb('mm_state','*')->result();
            $data['state'] = $states;


            $data['content']    = "user/register.php";
            $data['user']       = 1;
            $this->load->view('template',$data);
         
    }
    
    
}

?>