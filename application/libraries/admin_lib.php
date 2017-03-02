<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin_lib{
    
    var $model;
	function __construct() {
		$this -> ci = &get_instance();
		$this -> getModel();
	}

        
	function getModel() {
		$this -> ci -> load -> model('admin_model');
		$this -> model = $this -> ci -> admin_model;
	}
        
        
}