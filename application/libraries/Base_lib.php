<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Base_lib {

    public $_status = false;
    public $_message = "";
    public $_rdata = array();
    public $model;

    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->model('mm_model');
        $this->model = $this->ci->mm_model;
        
    }


    public function getResponse() {
        return array(
            'status' => $this->_status,
            'message' => $this->_message,
            'data' => $this->_rdata
        );
    }
    
    public function resetResponse(){
        $this->_message = "";
        $this->_status  = FALSE;
        $this->_rdata   = array();
    }
    
    function move_file($source,$destination,$file)
        {
            if(file_exists($source.$file)) { 
                if (copy($source.$file, $destination.$file)) {
                        unlink($source.$file);
                        return TRUE;
                  }else{
                      return FALSE;
                  }
            }
        }
        
        function copy_file($source,$destination,$file)
        {
            if(file_exists($source.$file)) { 
                if (copy($source.$file, $destination.$file)) {
                        return TRUE;
                  }else{
                      return FALSE;
                  }
            }
        }
        
        function sendSMS($mobile, $message, $createdDate= false, $updatedDate = false, $from='MyMaidz', $updatedBy="MyMaidz"){
            if($createdDate === false){ $createdDate = date('Y-m-d H:i:s');}
            if($updatedDate == false){ $updatedDate = $createdDate;}

            $this->model->sendMessage($mobile, $message, $from, $createdDate, $updatedBy, $updatedDate);
        }
}