<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'libraries/Base_lib.php';

class Admin_vendor_lib extends Base_lib{

    public $model;

    function __construct() {
        parent::__construct();
        $this->getModel();
    }

    function getModel() {
        $this->ci->load->model('admin_model');
        $this->model = $this->ci->admin_model;
    }

    /** Function to get the Newly registered vendors list
     * @param null
     * @return Array returns Array with new vendors list and status value
     */
    function _getNewVendors() {

        $this->resetResponse();

        $newVendors = $this->model->getNewVendors()->result();
        
        if ($newVendors) {
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $newVendors;

        } else {
            $this->_status = FALSE;
            $this->_message = $this->ci->lang->line('no_records_found');
        }
        

        return $this->getResponse();
    }
    
    /** Function to get the Newly registered vendors list
     * @param null
     * @return Array returns Array with new vendors list and status value
     */
    function _getActiveVendors() {

        $archived = 0;

        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);

            $result = $this->model->getActiveVendors('*', array("person_type" => Globals::PERSON_TYPE_VENDOR, "person_archived" => $archived))->result();

            if ($result) {
                $this->_status = true;
                $this->_message = '';
                $this->_rdata = $result;

            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('no_records_found');
            }
            
        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('invalid_user');
                            
        }

        return $this->getResponse();
    }
    
    /** Function to approve New Vendor
     * @param null
     * @return Array returns Array with status of approval
     */
    function _approveNewVendor(){
        
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        
        $this->resetResponse();

        $this->ci->form_validation->set_rules('personId', 'Vendor Person Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {           
            $this->_status = false;
            $this->_message = $this->ci->lang->line('person_id_missing');
            return $this->getResponse();
        } else {

            $personId = $this->ci->input->post('personId', true);
            $result = $this->model->get_tb('mm_person', 'person_id', array('person_id' => $personId))->result();
            if (count($result) > 0) {
                $this->model->update_tb('mm_person', array('person_id' => $personId), array('person_status'=>1));
                
                if( $this->model->getAffectedRowCount() > 0 ) {
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('vendor_approved');                   
                }
            } else {
                $this->_status = FALSE;
                $this->_message = $this->ci->lang->line('invalid_data');   
                
            }

            return $this->getResponse();
        }
        
    }
    
    /** Function to Archive/Un Archive Vendor
     * @param null
     * @return Array returns Array with status of Archive/UnArchive
     */
    function _archiveVendor(){

        $this->ci->load->library('form_validation');

        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('personId', 'Person Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        
        if ($this->ci->form_validation->run() == FALSE) {           
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $person_id = $this->ci->input->post('personId', true);
            $archive = intval($this->ci->input->post('archive', true));


            $result = $this->model->get_tb('mm_person', 'person_id', array('person_id' => $person_id, 'person_type' => Globals::PERSON_TYPE_VENDOR))->result();
            if (!empty($result)) {

                $info = array();
                $info['person_archived'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;;

                $this->model->update_tb('mm_person', array('person_id' => $person_id, 'person_type' => Globals::PERSON_TYPE_VENDOR), $info);
                $this->_message  = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('vendor_archived') : $this->ci->lang->line('vendor_unarchived'); 
                $this->_status   = true;
                
            } else {
                $this->_message  = $this->ci->lang->line('invalid_data'); 
                $this->_status   = false;
            }

            return $this->getResponse();
        }
    }

}
