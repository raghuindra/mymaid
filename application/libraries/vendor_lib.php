<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Vendor_lib{
    
    var $model;
	function __construct() {
		$this -> ci = &get_instance();
		$this -> getModel();
	}

        
	function getModel() {
		$this -> ci -> load -> model('vendor_model');
		$this -> model = $this -> ci -> vendor_model;
	}
        
        
}