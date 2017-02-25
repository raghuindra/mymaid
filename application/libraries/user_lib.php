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
        
        
        function check_user_email($email){     
                       
            $checkemail = $this->model->check_email($email);
            if(!empty($checkemail)){
                return FALSE;
            }else{
                return TRUE ;
            }
	}
        
        /**
	 *
	 * Create new user in the Db 
	 *
	 * @param	array	$data	array of person data
	 * @param 	array 	$condition multiple conditions in array format
	 * @return	nil
	 */
        function _create_user($user_data){
            
            $person_id=$this->model->insert($user_data);
            return $person_id;
            
        }
        
        
}