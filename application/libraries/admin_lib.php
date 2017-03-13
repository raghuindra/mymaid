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
        
        function _addService(){
            $this->ci->load->library('form_validation');
            $this->ci->data['success_message'] = "";
            $this->ci->data['error_message'] = "";     
            $person_id  = $this->ci->session->userdata('user_id');
            
            $response = array();
            
            $this->ci->form_validation->set_rules('serviceName', 'Service Name', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
            
            if ($this->ci->form_validation->run() == FALSE) {
                $this->ci->data['error_message'] = $this->ci->lang->line('service_name_missing');
                $this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
                return $response = array('status' => false,'message' =>$this->ci->data['error_message']);
            } else {
               
                $service_name = $this->ci->input->post('serviceName', true);
                
                $insert_id = $this->model ->insert_tb('mm_services', array('service_name' => $service_name, 'service_created_by' => $person_id, 'service_created_on' => date('Y-m-d H:i:s')));
                if($insert_id > 0){
                    $response = array(
                        'status' => true,
                        'message' => $this->ci->lang->line('service_name_inserted'),
                    );
                    $this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
                    
                }
                
                return $response;
                
            }
            
        }
        
        
}