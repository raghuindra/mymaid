<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_lib{
    
    var $model;
	function __construct() {
		$this -> ci = &get_instance();
		$this -> getModel();
	}

	function getModel() {
		$this -> ci -> load -> model('user_model');
		$this -> model = $this -> ci -> user_model;
	}
        
        function get_user(){
            $user_id = $this->ci->session->userdata('user_id');
            return $this->model->get_user_data($user_id);
        }
        
        
}