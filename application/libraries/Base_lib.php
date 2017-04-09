<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Base_lib {

    public $_status = false;
    public $_message = "";
    public $_rdata = array();

    public function __construct() {
        $this->ci = &get_instance();
        
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
}