<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once  APPPATH . 'libraries/Base_lib.php';

class Vendor_lib extends Base_lib {

    public $model;

    function __construct() {
        parent::__construct();
        $this->getModel();
    }

    function getModel() {
        $this->ci->load->model('vendor_model');
        $this->model = $this->ci->vendor_model;
    }

    function getProfileDetails() {
        $this->resetResponse();
        
        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');
            $result = $this->model->get_tb('mm_person', '*', array('person_id' => $person_id))->result();
            if ($result) {
                $this->_status = true;
                $this->_rdata = $result;
            } else {
                $this->_status = FALSE;
                $this->_message = $this->ci->lang->line('no_records_found');

            }
        } else {

            $this->_status = FALSE;
            $this->_message = $this->ci->lang->line('invalid_request');

        }

        return $this->getResponse();
    }

    function getBankDetails() {
        $this->resetResponse();
        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');
            $result = $this->model->get_tb('mm_bank_details', '*', array('bank_person_id' => $person_id))->result();
            
            if ($result) {
                $this->_status = true;
                $this->_rdata = $result;
            } else {
                $this->_status = FALSE;
                $this->_message = $this->ci->lang->line('no_records_found');

            }
        } else {
            $this->_status = FALSE;
            $this->_message = $this->ci->lang->line('invalid_request');

        }

        return $this->getResponse();
    }
    
    
    /** Function to Upadte the Bank details
     * @param null
     * @return JSON Bank details in JSON format
     */
    function _updateBankDetails(){
        
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('bnkname', 'Bank Name', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('holdername', 'Account Holder Name', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('accnumber', 'Account Number', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('ifsc', 'IFSC/SWIFT Code', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('bnkaddress', 'Bank Address', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        
        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {
            $info = array();
            $info['bank_person_id']         = $person_id;
            $info['bank_name']              = $this->ci->input->post('bnkname', true);
            $info['bank_holder_name']       = $this->ci->input->post('holdername', true);
            $info['bank_account_number']    = intval($this->ci->input->post('accnumber', true));
            $info['bank_ifsc_code']         = $this->ci->input->post('ifsc', true);
            $info['bank_address']           = $this->ci->input->post('bnkaddress', true);
 
            $result = $this->model->get_tb('mm_bank_details', '*', array('bank_person_id' => $person_id))->result();
            
            if (empty($result)) {
                               
                $insert_id = $this->model->insert_tb('mm_bank_details', $info);
                if($insert_id >0){
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('bank_detail_added');
                }else{
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('something_problem');
                }
            } else {
                $this->model->update_tb('mm_bank_details', array('bank_person_id' => $person_id), $info);

                if($this->model->getAffectedRowCount() > 0) {
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('bank_detail_updated');
                    
                } else {
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('no_changes_to_update');                  
                }
            }

            return $this->getResponse();
        }
        
    }
    
}
