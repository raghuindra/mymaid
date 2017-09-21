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
        $this->ci->form_validation->set_rules('ofcnumber', 'Office Phone Number', 'trim|required|xss_clean|encode_php_tags|min_length[8]|max_length[10]|numeric', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('hpphone', 'HP Phone Number', 'trim|required|xss_clean|encode_php_tags|min_length[8]|max_length[10]|numeric', array('required' => 'You must provide a %s.'));
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
        $this->ci->form_validation->set_rules('employee_housephone', 'Employee Housephone', 'trim|required|xss_clean|encode_php_tags|min_length[8]|max_length[10]|numeric', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employee_hp_phone', 'Employee HP Phone', 'trim|required|xss_clean|encode_php_tags|min_length[8]|max_length[10]|numeric', array('required' => 'You must provide a %s.'));
        //$this->ci->form_validation->set_rules('employee_jobtype', 'Employee Job Type', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employeeIdFileUpData', 'Employee Id Card file', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employee_session', 'Employee Job Session', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

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
                //$info['employee_job_type'] = (Globals::EMPLOYEE_FULLTIME == $this->ci->input->post('employee_jobtype', true)) ? Globals::EMPLOYEE_FULLTIME : Globals::EMPLOYEE_PARTTIME;
                $info['employee_created_on'] = date('Y-m-d H:i:s', strtotime('now'));
                $info['employee_company_id'] = $company[0]->company_id;
                $info['employee_job_session_id'] = $this->ci->input->post('employee_session', true);
                $empIdFile = $this->ci->input->post('employeeIdFileUpData', true);

                $insertId = 0;

                if (isset($_POST['employeeIdFileUpData']) && !empty($_POST['employeeIdFileUpData'])) {

                    if ($this->ci->session->tempdata('empIdFile') == $empIdFile) {

                        $employee_path = "assets/uploads/vendor/" . $person_id . "/company/employee/";
                        $temp_path = "assets/uploads/temp/";
                        if ($this->moveFile($empIdFile, $temp_path, $employee_path)) {
                            $info['employee_idcard_path'] = $empIdFile;
                            $insertId = $this->model->insert_tb('mm_company_employees', $info);
                        }
                    }
                }

                if ($insertId > 0) {

                    $session_info = array();
                    $session_info['employee_session_employee_id'] = $insertId;
                    $session_info['employee_session_monday'] = $this->ci->input->post('employee_session', true);
                    $session_info['employee_session_tuesday'] = $this->ci->input->post('employee_session', true);
                    $session_info['employee_session_wednesday'] = $this->ci->input->post('employee_session', true);
                    $session_info['employee_session_thursday'] = $this->ci->input->post('employee_session', true);
                    $session_info['employee_session_friday'] = $this->ci->input->post('employee_session', true);
                    $session_info['employee_session_saturday'] = $this->ci->input->post('employee_session', true);
                    $session_info['employee_session_sunday'] = $this->ci->input->post('employee_session', true);
                    $session_info['employee_session_updated_by'] = $person_id;
                    // Insert the employee session in session table
                    $insertId = $this->model->insert_tb('mm_employee_session
', $session_info);

                    $sender = $this->ci->data['config']['sender_email'];
                    //$recipient = $result[0]->person_email;
                    $subject = "New Employee Addition";
                    $message = "<html><body>";
                    $message .= "<p>Hi,</p><br>";
                    $message .= "<p>Vendor " . $this->ci->session->userdata('user_fullname') . " has added new Employee.</p>";
                    $message .= "</body></html>";
                    $this->ci->load->library('page_load_lib');
                    /* Admin */$this->ci->page_load_lib->send_np_email($sender, 'alaken.adv@gmail.com', $subject, $message, array('mailtype' => 'html'));
                    /* Admin */$this->ci->page_load_lib->send_np_email($sender, 's_thiba82@yahoo.com', $subject, $message, array('mailtype' => 'html'));
                    /* Admin */$this->ci->page_load_lib->send_np_email($sender, 'kkharish16@gmail.com', $subject, $message, array('mailtype' => 'html'));
                    /* Admin */$this->ci->page_load_lib->send_np_email($sender, 'praveen.dexter@gmail.com', $subject, $message, array('mailtype' => 'html'));

                    //SMS                       
                    /* Admin */ $this->sendSMS('+601124129717', "Vendor " . $this->ci->session->userdata('user_fullname') . " has added new Employee.");
                    /* Admin */ $this->sendSMS('+60146771436', "Vendor " . $this->ci->session->userdata('user_fullname') . " has added new Employee.");
                    /* Admin */ $this->sendSMS('+60125918491', "Vendor " . $this->ci->session->userdata('user_fullname') . " has added new Employee.");
                    /* Admin */ $this->sendSMS('+60126570387', "Vendor " . $this->ci->session->userdata('user_fullname') . " has added new Employee.");

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
                //$result = $this->model->get_tb('mm_company_employees', '*', array("employee_company_id" => $company[0]->company_id, "employee_archived" => $archived))->result();
                $result = $this->model->getCompanyEmployees($company[0]->company_id, $archived);
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

    /** Function to Get Employee Detail
     * @param null 
     * @return Array Return Array response with Employee Detail 
     */
    function _getEmployeeDetail() {
        $this->resetResponse();
        $employee_id = $this->ci->input->post('employeeId', true);

        $result = $this->model->get_tb('mm_company_employees', '*', array("employee_id" => $employee_id))->result();
        if (!empty($result)) {
            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $result;
        } else {
            $this->_status = true;
            $this->_message = $this->ci->lang->line('no_records_found');
        }

        return $this->getResponse();
    }

    /** Function to Update Employee Detail
     * @param null 
     * @return Array Return Array response with Employee update status 
     */
    function _updateEmployee() {
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $this->resetResponse();

        $this->ci->form_validation->set_rules('edit_employee_name', 'Employee Name', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employeeId', 'Employee Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_employee_citizenship', 'Employee citizenship', 'trim|required|xss_clean|encode_php_tags|alpha_numeric_spaces', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_employee_housephone', 'Employee Housephone', 'trim|required|xss_clean|encode_php_tags|min_length[8]|max_length[10]|numeric', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_employee_hp_phone', 'Employee HP Phone', 'trim|required|xss_clean|encode_php_tags|min_length[8]|max_length[10]|numeric', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('employee_session', 'Employee Session', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('Validation_error');
            return $this->getResponse();
        } else {

            $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_person_id' => $person_id))->result();

            if (!empty($company)) {
                $info = array();
                $info['employee_name'] = $this->ci->input->post('edit_employee_name', true);
                $info['employee_citizenship'] = $this->ci->input->post('edit_employee_citizenship', true);
                $info['employee_house_phone'] = $this->ci->input->post('edit_employee_housephone', true);
                $info['employee_hp_phone'] = $this->ci->input->post('edit_employee_hp_phone', true);
                $info['employee_job_session_id'] = $this->ci->input->post('employee_session', true);
                $company_id = $company[0]->company_id;
                $employeeId = $this->ci->input->post('employeeId', true);

                $this->model->update_tb('mm_company_employees', array('employee_id' => $employeeId, 'employee_company_id' => $company_id), $info);

                if ($this->model->getAffectedRowCount() > 0) {
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('employee_updated');
                } else {
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('no_changes_to_update');
                }
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('something_problem');
            }
            return $this->getResponse();
        }
    }

    /** Function to Archive/Un Archive Employee
     * @param null
     * @return Array returns Array with status of Archive/UnArchive
     */
    function _archiveEmployee() {
        $this->ci->load->library('form_validation');

        $this->resetResponse();

        $this->ci->form_validation->set_rules('employeeId', 'Employee Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('companyId', 'Company Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $employee_id = $this->ci->input->post('employeeId', true);
            $company_id = $this->ci->input->post('companyId', true);
            $archive = intval($this->ci->input->post('archive', true));


            $result = $this->model->get_tb('mm_company_employees', 'employee_id', array('employee_id' => $employee_id, 'employee_company_id' => $company_id))->result();
            if (!empty($result)) {

                $info = array();
                $info['employee_archived'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;
                ;

                $this->model->update_tb('mm_company_employees', array('employee_id' => $employee_id, 'employee_company_id' => $company_id), $info);
                $this->_message = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('employee_archived') : $this->ci->lang->line('employee_unarchived');
                $this->_status = true;
            } else {
                $this->_message = $this->ci->lang->line('invalid_data');
                $this->_status = false;
            }

            return $this->getResponse();
        }
    }

    /* get the state names of a postal code */

    function _getPostalStates() {

        return $this->model->getStates('DISTINCT(`pt`.state_code), `st`.state_name')->result();
    }

    /* Get get City list belongs to state */

    function _getPostOffices() {
        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";

        $response = array();

        $this->ci->form_validation->set_rules('stateCode', 'State Code', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');

            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {
            $stateCode = $this->ci->input->post('stateCode', true);

            $result = $this->model->get_tb('mm_postcode', 'DISTINCT(post_office)', array('state_code' => $stateCode))->result();

            return $response = array(
                'status' => true,
                'message' => '',
                'data' => $result
            );
        }
    }

    /* get the Postcodes based on AreaCodes And which not available in Postcode Price list already. */

    function _getpostcodes() {
        $this->ci->load->library('form_validation');

        $this->resetResponse();

        $this->ci->form_validation->set_rules('areaCode[]', 'Area Code', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {

            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {
            $areaCodes = implode(',', array_map(function($str) {
                        return sprintf("'%s'", $str);
                    }, $this->ci->input->post('areaCode', true)));
            $person_id = $this->ci->session->userdata('user_id');
            $result = $this->model->get_postcodes($areaCodes, $person_id)->result();

            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $result;

            return $this->getResponse();
        }
    }

    /** Function to add vendor service location
     * @param null
     * @return Array returns Array with status of addition
     */
    function _addServiceLocation() {

        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('stateSelect', 'State', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('areaSelect[]', 'Area', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('postcodeSelect[]', 'Postcodes', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $info = array();

            $postcodes = $this->ci->input->post('postcodeSelect[]', true);
            $data = array();
            foreach ($postcodes as $code) {
                $info = array();
                $info['vendor_service_location_vendor_id'] = $person_id;
                $info['vendor_service_location_postcode'] = $code;
                $info['vendor_service_location_added_on'] = date('Y-m-d H:i:s', strtotime('now'));
                $info['vendor_service_location_updated_on'] = date('Y-m-d H:i:s', strtotime('now'));
                array_push($data, $info);
            }
            if (!empty($data)) {
                $this->model->insert_batch_tb('mm_vendor_service_location', $data);

                $this->_status = true;
                $this->_message = $this->ci->lang->line('vendor_service_location_added');
                $this->_rdata = array();
            } else {
                $this->_message = $this->ci->lang->line('invalid_data');
                $this->_status = false;
            }
        }
        return $this->getResponse();
    }

    /** Function to List Service Location
     * @param null 
     * @return Array Return Array response with Service location list 
     */
    function _listServiceLocation() {
        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            $person_id = $this->ci->session->userdata('user_id');

            $service_location = $this->model->get_tb('mm_vendor_service_location', 'vendor_service_location_id', array('vendor_service_location_vendor_id' => $person_id))->result();

            if (!empty($service_location)) {
                $result = $this->model->get_tb('mm_vendor_service_location', '*', array("vendor_service_location_vendor_id" => $person_id, "vendor_service_location_archived" => $archived))->result();

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

    /** Function to Archive/Un Archive Service Location
     * @param null
     * @return Array returns Array with status of Archive/UnArchive
     */
    function _archiveServiceLocation() {
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('locationId', 'Location Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $location_id = $this->ci->input->post('locationId', true);
            $archive = intval($this->ci->input->post('archive', true));


            $result = $this->model->get_tb('mm_vendor_service_location', 'vendor_service_location_id', array('vendor_service_location_id' => $location_id, 'vendor_service_location_vendor_id' => $person_id))->result();
            if (!empty($result)) {

                $info = array();
                $info['vendor_service_location_archived'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;
                ;

                $this->model->update_tb('mm_vendor_service_location', array('vendor_service_location_id' => $location_id, 'vendor_service_location_vendor_id' => $person_id), $info);
                $this->_message = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('service_location_archived') : $this->ci->lang->line('service_location_unarchived');
                $this->_status = true;
            } else {
                $this->_message = $this->ci->lang->line('invalid_data');
                $this->_status = false;
            }

            return $this->getResponse();
        }
    }

    /** Function to List the New Service Bookings.
     * @param null
     * @return JSON returns the JSON with New Service Bookings    
     */
    function _newServiceBooking() {

        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $now = date('Y-m-d', strtotime('now'));
            $person_id = $this->ci->session->userdata('user_id');
            $newServices = $this->model->getServiceBookings($now, $person_id);
            //print_r($this->model->last_query()); exit;

            if (!empty($newServices)) {
                $result = array();
                $i = 0;
                foreach ($newServices as $service) {
                    $result[$i]['booking_id'] = $service->booking_id;
                    $result[$i]['booking_pincode'] = $service->booking_pincode;
                    $result[$i]['service_name'] = $service->service_name;
                    $result[$i]['customer_name'] = $service->person_first_name . " " . $service->person_last_name;
                    
                    $dateObj = date_create($service->booking_service_date);
                    $date = date_format($dateObj, 'd-m-Y');                    
                    $result[$i]['booking_service_date'] = $date;
                    
                    $dateObj = date_create($service->booking_booked_on);
                    $date = date_format($dateObj, 'd-m-Y H:i:s');  
                    $result[$i]['booking_booked_on'] = $date;

                    $person_type = $this->ci->session->userdata('user_type');
                    $amount_share = $this->calculateCutoffAmount($service->booking_amount, $person_type); 
                    //print_r($amount_share);
                    $result[$i]['booking_amount'] = $amount_share['vendor_share'];
                    if($service->service_frequency_name == null || $service->service_frequency_name == ''){
                        $result[$i]['frequency_name'] = "Once";
                    }else{
                        $result[$i]['frequency_name'] = $service->service_frequency_name;
                    }
                    $i++;
                }

                if (!empty($result)) {
                    $this->_status = true;
                    $this->_message = '';
                    $this->_rdata = $result;
                } else {
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('no_records_found');
                }
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

    /** Function to get Employees for New Job(Bookings).
     * @param null
     * @return JSON returns the JSON with Employees for New Job    
     */
    function _getEmployeesForJob() {
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('booking_id', 'Booking Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $booking_id = $this->ci->input->post('booking_id', true);

            $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_person_id' => $person_id))->result();

            if (!empty($company)) {

                $booking_detail = $this->model->get_tb('mm_booking', 'booking_service_date, booking_pincode, booking_package_id', array('booking_id' => $booking_id))->result();
                $session_detail = $this->model->_getBookingSessionDetail($booking_id);
                           
                
                if (!empty($booking_detail)) {
                    
                    $crews = $this->model->get_tb('mm_service_package','service_package_min_crew_member', array('service_package_id'=>$booking_detail[0]->booking_package_id))->result();
                    
                    if($crews && count($crews)>0){
                        $employees = array();

                        foreach($session_detail as $sessions){
                            $employees[$sessions->booking_sessions_id] = $this->_checkEmployeeAvailabilityForDate($sessions->booking_sessions_service_date, $sessions->booking_sessions_session_id, $booking_detail[0]->booking_pincode, $company[0]->company_id);
                        }
                        $this->_message = $crews[0]->service_package_min_crew_member;
                        $this->_status = true;
                        $this->_rdata = $employees;
                        $this->_extra = $session_detail;
                    
                    }else{
                        $this->_status = false;
                        $this->_message = "Invalid service package selected.";
                    }
                    
                } else {
                    $this->_message = $this->ci->lang->line('no_records_found');
                    $this->_status = false;
                }
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('invalid_user');
            }

            return $this->getResponse();
        }
    }
    
     /** Function to get Employees for New Job who are free for the new service.
     * @param null
     * @return JSON returns the JSON with Employees for New Job    
     */
    function _checkEmployeeAvailabilityForDate($service_date, $session_id, $postcode, $company_id){
        
        $dayofweek = strtolower(date('l', strtotime($service_date)));
        $employee_ids = array();
        $employees = array();
        $response_1 = $this->model->getEmployeeSessionAndDayAvailability($dayofweek, $session_id, $company_id);
        //echo $this->model->last_query(); echo "<br>";
        $response_2 = $this->model->getEmployeeSplSessionAvailability($service_date, $session_id, $company_id);
        //echo $this->model->last_query(); echo "<br>";
        $response_3 = $this->model->getEmployeeAssignedJob($service_date, $company_id);
        //echo $this->model->last_query(); echo "<br>";
        
        $response_5 = $this->model->getEmployeeWhoGotSplSession($service_date, $company_id);
        //echo $this->model->last_query(); echo "<br>";
        
        $response_6 = $this->model->getEmployeeWhoGotSplSessionHoliday($service_date, $company_id);
        //echo $this->model->last_query(); exit;
        
        if(!empty($response_1)){
            foreach($response_1 as $id){
                $employee_ids[] = $id->employee_id;
                $employees[$id->employee_id]['employee_id'] = $id->employee_id;
                $employees[$id->employee_id]['employee_name'] = $id->employee_name;
            }
        }
        
        if(!empty($response_5)){
            $new_array = array();
            foreach($response_5 as $id){
                $new_array[] = $id->employee_id;
            }
            //Filter out(remove) the same employee of a spl session from default session
            $employee_ids = array_diff($employee_ids, $new_array);
        }
        
        if(!empty($response_2)){
            foreach($response_2 as $id){
                $employee_ids[] = $id->employee_id;
                $employees[$id->employee_id]['employee_id'] = $id->employee_id;
                $employees[$id->employee_id]['employee_name'] = $id->employee_name;
            }
        }
        
        if(!empty($response_6)){
            $new_array = array();
            foreach($response_6 as $id){
                $new_array[] = $id->employee_id;
            }
            //Filter out(remove) the same employee Who took holiday on service date
            $employee_ids = array_diff($employee_ids, $new_array);
        }
        
        if(!empty($response_3)){
            $new_array = array();          
            foreach($response_3 as $id){
                $new_array[] = $id->employee_id;
                $employees[$id->employee_id]['employee_id'] = $id->employee_id;
                $employees[$id->employee_id]['employee_name'] = $id->employee_name;
            }
            //Filter out(remove) the employees who assigned job oon selected date
            $employee_ids = array_diff($employee_ids, $new_array);
        }
        
        $employee_ids = array_unique($employee_ids);  
        if(!empty($employee_ids)){
            
            $employeesStr = implode(',', $employee_ids);
            $response_4 = $this->model->getEmployeeServingForLocation($employeesStr, $postcode, $company_id);        
            $employee_ids = array();
            if(!empty($response_4)){
                foreach($response_4 as $id){
                    $employee_ids[] = $employees[$id->employee_id];
                }
            }            
        }
        unset($employees);
            
        return $employee_ids;
        
    }
    

    /** Function to assign Employee/s for New Job(Bookings).
     * @param null
     * @return JSON returns the JSON with Employee/s Job assign status
     */
    function _assignEmployeesToJob() {

        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('ser_employee[]', 'Employee Id', 'required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('ser_booking_id', 'Booking Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));   
        $this->ci->form_validation->set_rules('ser_session_id[]', 'Session Id', 'required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('ser_crew_count', 'Crew Count', 'required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $booking_id     = $this->ci->input->post('ser_booking_id', true);
            $employee_ids    = $this->ci->input->post('ser_employee[]', true); //array
            $booking_sessions_ids = $this->ci->input->post('ser_session_id[]', true); //array
            $ser_crew_count  = $this->ci->input->post('ser_crew_count', true);

            $company = $this->model->get_tb('mm_vendor_company', '*', array('company_person_id' => $person_id))->result();

            if (!empty($company)) {

                $service_not_assigned = $this->model->check_booking_job_is_assigned($booking_id);

                if (!empty($service_not_assigned)) {
                    $this->model->update_tb('mm_booking', array('booking_id' => $booking_id), array('booking_vendor_company_id' => $company[0]->company_id, 'booking_status' => Globals::BOOKING_CONFIRMED));
                    
                    $job = array();
                    $k=0;
                    for($i=0; $i< count($booking_sessions_ids); $i++){
                                         
                        for($j=$k; $j<count($employee_ids); $j++){
                            $job[$j]['employee_job_booking_id'] = $booking_id;
                            $job[$j]['employee_job_employee_id'] = $employee_ids[$j];
                            $job[$j]['employee_job_booking_sessions_id'] = $booking_sessions_ids[$i];
                            $job[$j]['employee_job_assigned_on'] = date('Y-m-d H:i:s', strtotime('now'));
                            $k++;
                            if($k % $ser_crew_count == 0){ break;}
                        }
                    }

                    $this->model->insert_batch_tb('mm_employee_job', $job);
                    
                    $booking_detail = $this->model->getServiceBookingDetail($booking_id);
                    $sender = $this->ci->data['config']['sender_email'];
                    $recipient = $booking_detail[0]->person_email;
                    $subject = "Booking Information";
                    $message = "<html><body>";
                    $message .= "<p>Dear User,</p><br>";
                    $message .= "<p>Your Service has been accepted by Company: " . $company[0]->company_name . "</p>";
                    $message .= "<p>Contact On: +60" . $company[0]->company_mobile . " / +60" . $company[0]->company_landphone . "</p>";
                    $message .= "</body></html>";
                    $this->ci->page_load_lib->send_np_email($sender, $recipient, $subject, $message, array('mailtype' => 'html'));

                    // SMS
                    $this->sendSMS("+60" . $booking_detail[0]->person_mobile, "Your Service request has been accepted by company: " . $company[0]->company_name);
                    /* Admin */ $this->sendSMS('+601124129717', "New Service request has been accepted by vendor: " . $company[0]->company_name . " of User: " . $booking_detail[0]->person_email);
                    /* Admin */ $this->sendSMS('+60146771436', "New Service request has been accepted by vendor: " . $company[0]->company_name . " of User: " . $booking_detail[0]->person_email);
                    /* Admin */ $this->sendSMS('+60125918491', "New Service request has been accepted by vendor: " . $company[0]->company_name . " of User: " . $booking_detail[0]->person_email);
                    /* Admin */ $this->sendSMS('+60126570387', "New Service request has been accepted by vendor: " . $company[0]->company_name . " of User: " . $booking_detail[0]->person_email);


                    $this->_message = $this->ci->lang->line('job_assigned_successfully');
                    $this->_status = true;
                    
                } else {
                    $this->_message = $this->ci->lang->line('job_already_assigned');
                    $this->_status = false;
                }
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('invalid_user');
            }

            return $this->getResponse();
        }
    }

    /** Function to List Active Service Bookings.
     * @param null
     * @return JSON returns the JSON with Active Service Bookings    
     */
    function _listActiveServiceBookings() {

        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');
            $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_person_id' => $person_id))->result();

            if (!empty($company)) {

                $activeServices = $this->model->getVendorServiceBookings($company[0]->company_id);
                //print_r($newServices); exit;

                if (!empty($activeServices)) {
                    $result = array();
                    $i = 0;
                    foreach ($activeServices as $service) {
                        $result[$i]['booking_id'] = $service->booking_id;
                        $result[$i]['booking_pincode'] = $service->booking_pincode;
                        $result[$i]['service_name'] = $service->service_name;
                        $result[$i]['customer_name'] = $service->person_first_name . " " . $service->person_last_name;
                        $result[$i]['person_mobile'] = $service->person_mobile;
                        
                        $dateObj = date_create($service->booking_service_date);
                        $date = date_format($dateObj, 'd-m-Y');                    
                        $result[$i]['booking_service_date'] = $date;

                        $person_type = $this->ci->session->userdata('user_type');
                        $amount_share = $this->calculateCutoffAmount($service->booking_amount, $person_type); 
                        //print_r($amount_share);
                        $result[$i]['booking_amount'] = $amount_share['vendor_share'];
                        $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                        $result[$i]['booking_status'] = $service->booking_status;
                        $result[$i]['booking_cancelled_by'] = $service->booking_cancelled_by;
                        $result[$i]['booking_completion_user_comfirmed'] = $service->booking_completion_user_comfirmed;
                        
                        if($service->service_frequency_name == null || $service->service_frequency_name == ''){
                            $result[$i]['frequency_name'] = "Once";
                        }else{
                            $result[$i]['frequency_name'] = $service->service_frequency_name;
                        }
                        
                        $now = date('Y-m-d H:i:s');
                        $service_date = date('Y-m-d H:i:s', strtotime($service->booking_service_date));
                        if (strtotime($now) >= strtotime($service_date) && $service->booking_vendor_company_id != null && ( $service->booking_status == Globals::BOOKING_CONFIRMED || $service->booking_status == Globals::BOOKING_COMPLETED)) {
                            $result[$i]['confirm_completed'] = true;
                        } else {
                            $result[$i]['confirm_completed'] = false;
                        }

                        $i++;
                    }

                    if (!empty($result)) {
                        $this->_status = true;
                        $this->_message = '';
                        $this->_rdata = $result;
                    } else {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('no_records_found');
                    }
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

    /** Function to List the Completed Service Bookings.
     * @param null
     * @return JSON returns the JSON with status of Completed Service Bookings    
     */
    function _listCompletedServiceBookings() {
        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');
            $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_person_id' => $person_id))->result();

            if (!empty($company)) {

                $completedServices = $this->model->getVendorCompletedServiceBookings($company[0]->company_id);
                //print_r($newServices); exit;

                if (!empty($completedServices)) {
                    $result = array();
                    $i = 0;
                    foreach ($completedServices as $service) {
                        $result[$i]['booking_id'] = $service->booking_id;
                        $result[$i]['booking_pincode'] = $service->booking_pincode;
                        $result[$i]['service_name'] = $service->service_name;
                        $result[$i]['customer_name'] = $service->person_first_name . " " . $service->person_last_name;
                        $result[$i]['person_mobile'] = $service->person_mobile;
                        
                        if($service->service_frequency_name == null || $service->service_frequency_name == ''){
                            $result[$i]['frequency_name'] = "Once";
                        }else{
                            $result[$i]['frequency_name'] = $service->service_frequency_name;
                        }
                        $dateObj = date_create($service->booking_service_date);
                        $date = date_format($dateObj, 'd-m-Y');                    
                        $result[$i]['booking_service_date'] = $date;
                        
                        $person_type = $this->ci->session->userdata('user_type');
                        $amount_share = $this->calculateCutoffAmount($service->booking_amount, $person_type); 
                        //print_r($amount_share);
                        $result[$i]['booking_amount'] = $amount_share['vendor_share'];
                        
                        $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                        $result[$i]['booking_completion_company_confirmed'] = $service->booking_completion_company_confirmed;
                        $result[$i]['booking_completion_admin_confirmed'] = $service->booking_completion_admin_confirmed;
                        $result[$i]['booking_completion_user_comfirmed'] = $service->booking_completion_user_comfirmed;

                        $i++;
                    }

                    if (!empty($result)) {
                        $this->_status = true;
                        $this->_message = '';
                        $this->_rdata = $result;
                    } else {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('no_records_found');
                    }
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

    /** Function to Confirm the order Completion.
     * @param null
     * @return JSON returns the JSON with order Completion status.    
     */
    function _confirmOrderCompletion() {
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('bookingId', 'Booking Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $booking_id = $this->ci->input->post('bookingId', true);


            $booking_detail = $this->model->get_tb('mm_booking', 'booking_service_date, booking_booked_on, booking_vendor_company_id, booking_status', array('booking_id' => $booking_id))->result();

            if (!empty($booking_detail)) {
                $now = date('Y-m-d H:i:s');
                $service_date = date('Y-m-d H:i:s', strtotime($booking_detail[0]->booking_service_date));
                $lastServiceDate = $this->model->getLastDateofServiceDate($booking_id);
                
                if (strtotime($now) >= strtotime($lastServiceDate[0]->service_date) && $booking_detail[0]->booking_vendor_company_id != null && ( $booking_detail[0]->booking_status == Globals::BOOKING_CONFIRMED || $booking_detail[0]->booking_status == Globals::BOOKING_COMPLETED)) {

                    $this->model->update_tb('mm_booking', array('booking_id' => $booking_id), array('booking_status' => Globals::BOOKING_COMPLETED, 'booking_completion_company_confirmed' => 1));
                    if ($this->model->getAffectedRowCount() > 0) {
                        $this->_status = true;
                        $this->_message = $this->ci->lang->line('order_completion_confirmed');
                    } else {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('no_changes_to_update');
                    }
                } else {
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('unable_to_process_order_completion_update');
                }
            } else {
                $this->_message = $this->ci->lang->line('no_records_found');
                $this->_status = false;
            }


            return $this->getResponse();
        }
    }

    /** Function to List the Cancelled Orders.
     * @param null
     * @return JSON returns the JSON with Cancelled Orders list.    
     */
    function _listCanceledOrders() {

        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');

            $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_person_id' => $person_id))->result();

            if (!empty($company)) {
                $canceledServices = $this->model->getVendorCanceledServiceBookings($company[0]->company_id);
                //print_r($newServices); exit;

                if (!empty($canceledServices)) {
                    $result = array();
                    $i = 0;
                    foreach($canceledServices as $service) {
                        $result[$i]['booking_id'] = $service->booking_id;
                        $result[$i]['booking_pincode'] = $service->booking_pincode;
                        $result[$i]['customer_name'] = $service->person_first_name . " " . $service->person_last_name;
                        $result[$i]['person_mobile'] = $service->person_mobile;
                        $result[$i]['service_name'] = $service->service_name;
                        
                        if($service->service_frequency_name == null || $service->service_frequency_name == ''){
                            $result[$i]['frequency_name'] = "Once";
                        }else{
                            $result[$i]['frequency_name'] = $service->service_frequency_name;
                        }
                        $dateObj = date_create($service->booking_service_date);
                        $date = date_format($dateObj, 'd-m-Y');                    
                        $result[$i]['booking_service_date'] = $date;
                        
                        $person_type = $this->ci->session->userdata('user_type');
                        $amount_share = $this->calculateCutoffAmount($service->booking_amount, $person_type); 
                        //print_r($amount_share);
                        $result[$i]['booking_amount'] = $amount_share['vendor_share'];
                        
                        $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                        $result[$i]['booking_status'] = $service->booking_status;
                        $result[$i]['booking_amount'] = $service->booking_amount;
                        $result[$i]['booking_cancelled_on'] = $service->booking_cancelled_on;
                        $result[$i]['booking_cancelled_by'] = $service->booking_cancelled_by;
                        
                        if ($service->booking_cancelled_by == $this->ci->session->userdata('user_id')) {
                            $result[$i]['booking_cancelation_request_sent_from'] = 'Self';
                        } else {
                            $result[$i]['booking_cancelation_request_sent_from'] = 'Admin/User';
                        }
                        $result[$i]['booking_cancelled_approved_by_admin'] = $service->booking_cancelled_approved_by_admin;
                        $result[$i]['booking_cancelled_approved_by_admin_on'] = $service->booking_cancelled_approved_by_admin_on;

                        $i++;
                    }

                    if (!empty($result)) {
                        $this->_status = true;
                        $this->_message = '';
                        $this->_rdata = $result;
                    } else {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('no_records_found');
                    }
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

    /*
     * Fucntion to get the Vendor amount credited for the service completion
     */

    function getVendorAmountCreditForService($booking_id, $person_id) {
        $this->model->getVendorServiceAmountCredited($booking_id, $person_id);
    }

}
