<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'libraries/Base_lib.php';

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

    /** Function to get the Bank details
     * @param null
     * @return JSON Bank details in JSON format
     */
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

    /** Function to Update the Bank details
     * @param null
     * @return JSON Bank details in JSON format
     */
    function _updateBankDetails() {

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
            $info['bank_person_id'] = $person_id;
            $info['bank_name'] = $this->ci->input->post('bnkname', true);
            $info['bank_holder_name'] = $this->ci->input->post('holdername', true);
            $info['bank_account_number'] = intval($this->ci->input->post('accnumber', true));
            $info['bank_ifsc_code'] = $this->ci->input->post('ifsc', true);
            $info['bank_address'] = $this->ci->input->post('bnkaddress', true);

            $result = $this->model->get_tb('mm_bank_details', '*', array('bank_person_id' => $person_id))->result();

            if (empty($result)) {

                $insert_id = $this->model->insert_tb('mm_bank_details', $info);
                if ($insert_id > 0) {
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('bank_detail_added');
                } else {
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('something_problem');
                }
            } else {
                $this->model->update_tb('mm_bank_details', array('bank_person_id' => $person_id), $info);

                if ($this->model->getAffectedRowCount() > 0) {
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

    /** Function to get the Company details
     * @param null
     * @return JSON Bank details in JSON format
     */
    function _getCompanyDetail() {
        $this->resetResponse();
        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');
            $result = $this->model->get_tb('mm_vendor_company', '*', array('company_person_id' => $person_id))->result();

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

    /** Function to upload the company documents
     * @param null 
     * @return Array Return Array response with company doc upload status 
     */
    function _uploadCompanyDoc($inputField) {

        if (strlen($_FILES[$inputField]["name"]) > 0) {

            $response = array();

            $file = $_FILES[$inputField]["name"];
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $folder_name = 'temp';
            $newfilename = time() . "_" . mt_rand(1, 10000) . "";
            $upload_data = array();

            $this->ci->load->library('image_resize_lib');

            if (file_exists("assets/uploads/" . $folder_name . "/" . $newfilename . "." . $ext)) {
                unlink("assets/uploads/" . $folder_name . "/" . $newfilename . "." . $ext);
            }
            if (!$this->ci->image_resize_lib->upload_file($inputField, $ext, $folder_name, '10240', $newfilename)) {
                $response['error'] = $this->ci->image_resize_lib->get_upload_error();
                $response['success'] = 0;

                return $response;
            } else {
                $upload_data['upload_data'] = $this->ci->image_resize_lib->get_upload_data();
                $this->ci->session->set_tempdata($inputField, $newfilename . "." . $ext, 300);
                //$this->ci->session->set_userdata($inputField, $newfilename . "." . $ext);
                $response['error'] = "";
                $response['file'] = $newfilename . "." . $ext;
                $response['success'] = 1;

                return $response;
            }
        }
    }

    /** Function to update the company details
     * @param null 
     * @return Array Return Array response with company detail update status 
     */
    function _updateCompanyDetail() {

        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();

        $this->ci->form_validation->set_rules('cpname', 'Contact Person Name', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('icnumber', 'IC Number', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('ofcnumber', 'Office Phone Number', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('hpphone', 'HP Phone Number', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('addr', 'Address', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('postalcode', 'Postal code', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('state', 'State', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|encode_php_tags|valid_email', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $info = array();
            //$info['company_person_id'] = $person_id;
            $info['company_email_id'] = $this->ci->input->post('email', true);
            $info['company_contact_person_name'] = $this->ci->input->post('cpname', true);
            $info['company_ic_number'] = $this->ci->input->post('icnumber', true);
            $info['company_landphone'] = $this->ci->input->post('ofcnumber', true);
            $info['company_hp_phone'] = $this->ci->input->post('hpphone', true);
            $info['company_address'] = $this->ci->input->post('addr', true);
            $info['company_address1'] = $this->ci->input->post('addr2', true);
            $info['company_city'] = $this->ci->input->post('city', true);
            $info['company_pincode'] = $this->ci->input->post('postalcode', true);
            $info['company_state'] = $this->ci->input->post('state', true);
            $info['company_email_id'] = $this->ci->input->post('email', true);
            if (isset($_POST['ssmFileUpData']) && !empty($_POST['ssmFileUpData'])) {
                $ssmFile = $this->ci->input->post('ssmFileUpData', true);
                if ($this->ci->session->tempdata('ssmFile') == $ssmFile) {

                    $result = $this->model->get_tb('mm_vendor_company', 'company_ssm_file_path', array('company_person_id' => $person_id))->result();
                    if ($result[0]->company_ssm_file_path != '') {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('ssmfileExists');
                        return $this->getResponse();
                    } else {
                        $company_path = "assets/uploads/vendor/" . $person_id . "/company/";
                        $temp_path = "assets/uploads/temp/";
                        if ($this->moveFile($ssmFile, $temp_path, $company_path)) {
                            $this->model->update_tb('mm_vendor_company', array('company_person_id' => $person_id), array('company_ssm_file_path' => $ssmFile));
                        }
                    }
                }
            }

            if (isset($_POST['idFileUpData']) && !empty($_POST['idFileUpData'])) {
                $idFile = $this->ci->input->post('idFileUpData', true);
                if ($this->ci->session->tempdata('idFile') == $idFile) {

                    $result = $this->model->get_tb('mm_vendor_company', 'company_idcard_file_path', array('company_person_id' => $person_id))->result();
                    if ($result[0]->company_idcard_file_path != '') {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('idfileExists');
                        return $this->getResponse();
                    } else {
                        $company_path = "assets/uploads/vendor/" . $person_id . "/company/";
                        $temp_path = "assets/uploads/temp/";
                        if ($this->moveFile($idFile, $temp_path, $company_path)) {
                            $this->model->update_tb('mm_vendor_company', array('company_person_id' => $person_id), array('company_idcard_file_path' => $idFile));
                        }
                    }
                }
            }

            $this->model->update_tb('mm_vendor_company', array('company_person_id' => $person_id), $info);

            $this->_status = true;
            $this->_message = $this->ci->lang->line('company_detail_updated');

            return $this->getResponse();
        }
    }

    public function moveFile($file, $oldPath, $newPath) {
        try {
            if (!file_exists($newPath) && !is_dir($newPath)) {
                mkdir($newPath, 0777, true);
            }
            $this->move_file($oldPath, $newPath, $file);
        } catch (Exception $e) {
            return FALSE;
        }
        return true;
    }

    /** Function to upload the Employee Id Doc
     * @param null 
     * @return Array Return Array response with Employee Id doc upload status 
     */
    public function _uploadEmployeeDoc($inputField) {
        if (strlen($_FILES[$inputField]["name"]) > 0) {

            $response = array();

            $file = $_FILES[$inputField]["name"];
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $folder_name = 'temp';
            $newfilename = time() . "_" . mt_rand(1, 10000) . "";
            $upload_data = array();

            $this->ci->load->library('image_resize_lib');

            if (file_exists("assets/uploads/" . $folder_name . "/" . $newfilename . "." . $ext)) {
                unlink("assets/uploads/" . $folder_name . "/" . $newfilename . "." . $ext);
            }
            if (!$this->ci->image_resize_lib->upload_file($inputField, $ext, $folder_name, '10240', $newfilename)) {
                $response['error'] = $this->ci->image_resize_lib->get_upload_error();
                $response['success'] = 0;

                return $response;
            } else {
                $upload_data['upload_data'] = $this->ci->image_resize_lib->get_upload_data();
                $this->ci->session->set_tempdata($inputField, $newfilename . "." . $ext, 300);
                $response['error'] = "";
                $response['file'] = $newfilename . "." . $ext;
                $response['success'] = 1;

                return $response;
            }
        }
    }

    /** Function to Create Employee
     * @param null 
     * @return Array Return Array response with Employee creation status 
     */
    function _createEmployee() {

        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();

        $this->ci->form_validation->set_rules('employee_name', 'Employee Name', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employee_passport', 'Employee Passport', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employee_citizenship', 'Employee citizenship', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employee_housephone', 'Employee Housephone', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employee_hp_phone', 'Employee HP Phone', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employee_jobtype', 'Employee Job Type', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employeeIdFileUpData', 'Employee Id Card file', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_person_id' => $person_id))->result();
            //print_r($company);
            if (!empty($company)) {
                $info = array();
                $info['employee_name'] = $this->ci->input->post('employee_name', true);
                $info['employee_passport_number'] = $this->ci->input->post('employee_passport', true);
                $info['employee_citizenship'] = $this->ci->input->post('employee_citizenship', true);
                $info['employee_house_phone'] = $this->ci->input->post('employee_housephone', true);
                $info['employee_hp_phone'] = $this->ci->input->post('employee_hp_phone', true);
                $info['employee_job_type'] = (Globals::EMPLOYEE_FULLTIME == $this->ci->input->post('employee_jobtype', true)) ? Globals::EMPLOYEE_FULLTIME : Globals::EMPLOYEE_PARTTIME;
                $info['employee_company_id'] = $company[0]->company_id;
                $empIdFile = $this->ci->input->post('employeeIdFileUpData', true);

                $insertId = 0;

                if (isset($_POST['employeeIdFileUpData']) && !empty($_POST['employeeIdFileUpData'])) {

                    if ($this->ci->session->tempdata('empIdFile') == $empIdFile) {

                        $employee_path = "assets/uploads/vendor/" . $person_id . "/company/Employee/";
                        $temp_path = "assets/uploads/temp/";
                        if ($this->moveFile($empIdFile, $temp_path, $employee_path)) {
                            $info['employee_idcard_path'] = $empIdFile;
                            $insertId = $this->model->insert_tb('mm_company_employees', $info);
                        }
                    }
                }

                if ($insertId > 0) {

                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('employee_created');
                } else {
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('something_problem');
                }
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('something_problem');
            }
            return $this->getResponse();
        }
    }

    /** Function to List Employees
     * @param null 
     * @return Array Return Array response with Employee list 
     */
    function _listEmployees() {
        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            $person_id = $this->ci->session->userdata('user_id');
            
            $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_person_id' => $person_id))->result();

            if (!empty($company)) {
                $result = $this->model->get_tb('mm_company_employees', '*', array("employee_company_id" => $company[0]->company_id, "employee_archived" => $archived))->result();

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
        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('invalid_user');
        }

        return $this->getResponse();
    }

}
