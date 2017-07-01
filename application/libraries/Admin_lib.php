<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'libraries/Base_lib.php';

class Admin_lib extends Base_lib{

    public $model;

    public function __construct() {
        parent::__construct();
        $this->getModel();
    }

    public function getModel() {
        $this->ci->load->model('admin_model');
        $this->model = $this->ci->admin_model;
    }

    /* Function to add the service name */
    function _addService() {
        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $response = array();

        $this->ci->form_validation->set_rules('serviceName', 'Service Name', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('service_name_missing');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $service_name = $this->ci->input->post('serviceName', true);
            $result = $this->model->get_tb('mm_services', 'service_id', array('service_name' => $service_name))->result();
            if (count($result) == 0) {
                $insert_id = $this->model->insert_tb('mm_services', array('service_name' => $service_name, 'service_created_by' => $person_id, 'service_created_on' => date('Y-m-d H:i:s')));
                if ($insert_id > 0) {
                    $response = array(
                        'status' => true,
                        'message' => $this->ci->lang->line('service_name_inserted'),
                    );
                    //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
                }
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('service_name_already_available'),
                );
                //$this->ci->session->set_flashdata('error_message', $this->ci->lang->line('service_name_already_available'));                    
            }

            return $response;
        }
    }

    /* Function to edit the service name. */
    function _editService() {
        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $response = array();

        $this->ci->form_validation->set_rules('serviceName', 'Service Name', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('invalid_data');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $service_name = $this->ci->input->post('serviceName', true);
            $service_id = $this->ci->input->post('serviceId', true);

            $result = $this->model->get_tb('mm_services', 'service_id', array('service_name' => $service_name))->result();
            if (count($result) == 0) {
                $this->model->update_tb('mm_services', array('service_id' => $service_id), array('service_name' => $service_name));

                if ($this->model->getAffectedRowCount() > 0) {
                    $response = array(
                        'status' => true,
                        'message' => $this->ci->lang->line('service_name_updated'),
                    );
                    //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
                } else {
                    $response = array(
                        'status' => false,
                        'message' => $this->ci->lang->line('invalid_data'),
                    );
                }
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('service_name_already_available'),
                );
                //$this->ci->session->set_flashdata('error_message', $this->ci->lang->line('service_name_already_available'));                    
            }

            return $response;
        }
    }

    function _getServiceList() {

        $response = array();
        $archived = 0;
        
        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            
            $result = $this->model->get_tb('mm_services', 'service_id,service_name,service_created_on,service_updated_on,service_archived', array('service_archived' => $archived))->result();
            if ($result) {
                $response = array(
                    'status' => true,
                    'message' => '',
                    'data' => $result
                );
                
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('no_records_found'),
                    'data' => array()
                );
            }
        } else {
            $response = array(
                'status' => false,
                'message' => $this->ci->lang->line('invalid_request'),
                'data' => array()
            );
           
        }

        return $response;
    }

    function _archiveService() {
        $this->resetResponse();
        
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('Validation_error');
            return $this->getResponse();
            
        } else {

            $info = array();
            $service_id = $this->ci->input->post('serviceId', true);
            $archive = intval($this->ci->input->post('archive', true));
            
            $result = $this->model->get_tb('mm_services', 'service_id', array('service_id' => $service_id))->result();
            if (!empty($result)) {
                $info['service_archived'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;
                $info['service_updated_by'] = $person_id;

                $this->model->update_tb('mm_services', array('service_id' => $service_id), $info);
                $msg = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('service_archived') : $this->ci->lang->line('service_unarchived');
                $this->_status = true;
                $this->_message = $msg;
                      
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('invalid_data');
            }

            return $this->getResponse();
        }
    }

    /* Library function to create the package for the service. */
    function _createServicePackage() {
        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $response = array();

        $this->ci->form_validation->set_rules('package_service_id', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_building_type', 'Building Type', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_building_area', 'Building Area', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_bathrooms', 'Number of Bathrooms', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_bedrooms', 'Number of Bedrooms', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_crews', 'Number of Crews', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_hours', 'Number of hours', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_price', 'Package Price', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_price_cal', 'Calculate Package price by ', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('package_description', 'Package description', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));



        if ($this->ci->form_validation->run() == FALSE) {

            return $response = array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $service_id = $this->ci->input->post('package_service_id', true);
            $result = $this->model->get_tb('mm_services', 'service_id', array('service_id' => $service_id))->result();
            if (!empty($result)) {
                $info = array();
                $info['service_package_service_id'] = $service_id;
                $info['service_package_description'] = $this->ci->input->post('package_description', true);
                $info['service_package_bedroom'] = $this->ci->input->post('package_bedrooms', true);
                $info['service_package_bathroom'] = $this->ci->input->post('package_bathrooms', true);
                $info['service_package_building_id'] = $this->ci->input->post('package_building_type', true);
                $info['service_package_building_area_id'] = $this->ci->input->post('package_building_area', true);
                $info['service_package_min_hours'] = $this->ci->input->post('package_hours', true);
                $info['service_package_onetime_price'] = $this->ci->input->post('package_price', true);
                $info['service_package_price_cal_by'] = $this->ci->input->post('package_price_cal', true);
                $info['service_package_min_crew_member'] = $this->ci->input->post('package_crews', true);
                $info['service_package_created_on'] = date('Y-m-d H:i:s', strtotime('now'));
                $info['service_package_created_by'] = $person_id;


                $insert_id = $this->model->insert_tb('mm_service_package', $info);
                if ($insert_id > 0) {
                    $response = array(
                        'status' => true,
                        'message' => $this->ci->lang->line('service_package_created'),
                    );
                    //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
                }
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('service_id_missing'),
                );
                //$this->ci->session->set_flashdata('error_message', $this->ci->lang->line('service_name_already_available'));                    
            }

            return $response;
        }
    }

    function _getServicePackageList($serviceId) {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $archived = 0;
        $response = array();

        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            $service_detail = $this->model->get_tb('mm_services', 'service_id', array('service_archived' => 0, 'service_id' => $serviceId))->result();
            if (!empty($service_detail)) {
                $result = $this->model->getServicePackages('*', array("service_package_service_id" => $serviceId, "service_package_archive" => $archived))->result();

                if ($result) {
                    $response = array(
                        'status' => true,
                        'message' => '',
                        'data' => $result
                    );
                    //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
                } else {
                    $response = array(
                        'status' => false,
                        'message' => $this->ci->lang->line('no_records_found'),
                        'data' => array()
                    );
                }
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_request'),
                    'data' => array()
                );
            }
        } else {
            $response = array(
                'status' => false,
                'message' => $this->ci->lang->line('invalid_user'),
                'data' => array()
            );
            //$this->ci->session->set_flashdata('error_message', $this->ci->lang->line('invalid_request'));                    
        }

        return $response;
    }

    function _getServicePackageDetail($packageId) {
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $result = array();
        if ($this->ci->session->userdata('user_id') != null) {
            $result = $this->model->get_tb('mm_service_package', '*', array("service_package_id" => $packageId))->result();
        } else {

            $this->ci->data['error_message'] = $this->ci->lang->line('no_records_found');
        }

        $this->ci->data['package_detail'] = $result;
        return;
    }

    function _updateServicePackage($packageId) {
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->ci->form_validation->set_rules('edit_package_id', 'Service Package Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_service_id', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_building_type', 'Building Type', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_building_area', 'Building Area', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_bathrooms', 'Number of Bathrooms', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_bedrooms', 'Number of Bedrooms', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_crews', 'Number of Crews', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_hours', 'Number of hours', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_price', 'Package Price', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_price_cal', 'Calculate Package price by ', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('edit_package_description', 'Package description', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $info = array();
            $package_id = $this->ci->input->post('edit_package_id', true);
            $service_id = $this->ci->input->post('edit_package_service_id', true);

            $result = $this->model->get_tb('mm_service_package', 'service_package_id', array('service_package_id' => $package_id, 'service_package_service_id' => $service_id))->result();
            if (!empty($result)) {
                $info['service_package_description'] = $this->ci->input->post('edit_package_description', true);
                $info['service_package_bedroom'] = $this->ci->input->post('edit_package_bedrooms', true);
                $info['service_package_bathroom'] = $this->ci->input->post('edit_package_bathrooms', true);
                $info['service_package_building_id'] = $this->ci->input->post('edit_package_building_type', true);
                $info['service_package_building_area_id'] = $this->ci->input->post('edit_package_building_area', true);
                $info['service_package_min_hours'] = $this->ci->input->post('edit_package_hours', true);
                $info['service_package_onetime_price'] = $this->ci->input->post('edit_package_price', true);
                $info['service_package_price_cal_by'] = $this->ci->input->post('edit_package_price_cal', true);
                $info['service_package_min_crew_member'] = $this->ci->input->post('edit_package_crews', true);
                $info['service_package_updated_by'] = $person_id;

                $val = $this->model->update_tb('mm_service_package', array('service_package_id' => $package_id, 'service_package_service_id' => $service_id), $info);

                $response = array(
                    'status' => true,
                    'message' => $this->ci->lang->line('service_package_updated'),
                );
                //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_data'),
                );
            }

            return $response;
        }
    }

    function _archiveServicePackage() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->ci->form_validation->set_rules('servicePackageId', 'Service Package Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $info = array();
            $package_id = $this->ci->input->post('servicePackageId', true);
            $service_id = $this->ci->input->post('serviceId', true);
            $archive = intval($this->ci->input->post('archive', true));

            $result = $this->model->get_tb('mm_service_package', 'service_package_id', array('service_package_id' => $package_id, 'service_package_service_id' => $service_id))->result();
            if (!empty($result)) {
                $info['service_package_archive'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;
                $info['service_package_updated_by'] = $person_id;

                $val = $this->model->update_tb('mm_service_package', array('service_package_id' => $package_id, 'service_package_service_id' => $service_id), $info);
                $msg = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('service_package_archived') : $this->ci->lang->line('service_package_unarchived');
                $response = array(
                    'status' => true,
                    'message' => $msg,
                );
                //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_data'),
                );
            }

            return $response;
        }
    }

    function _createServiceFrequencyOfferPrice() {
        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $response = array();
        $this->resetResponse();

        $this->ci->form_validation->set_rules('add_frequency_service_id', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('add_service_frequency', 'Service Frequency', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('add_frequency_discount', 'Service Frequency Discount', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));


        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $service_freq = $this->ci->input->post('add_service_frequency', true);
            $service_id = $this->ci->input->post('add_frequency_service_id', true);

            $result = $this->model->get_tb('mm_service_frequency', 'service_frequency_id', array('service_frequency_id' => $service_freq))->result();

            if (!empty($result)) {

                $result = $this->model->get_tb('mm_services', 'service_id', array('service_id' => $service_id))->result();

                if (!empty($result)) {

                    if ($this->checkFrequencyOfferAdded($service_freq, $service_id)) {                        
                        $this->_status  = FALSE;
                        $this->_message = $this->ci->lang->line('service_frequency_offer_already_created');
                        return $this->getResponse();
                    }

                    $offerVal = $this->ci->input->post('add_frequency_discount', true);
                    $insert_id = $this->createFrequencyOffer($service_freq, $service_id, $offerVal, $person_id);

                    if ($insert_id > 0) {
                        $this->_status  = true;
                        $this->_message = $this->ci->lang->line('service_frequency_offer_created');
                    } else {
                        $this->_status  = FALSE;
                        $this->_message = $this->ci->lang->line('something_problem');
                    }
                } else {
                    $this->_status  = FALSE;
                    $this->_message = $this->ci->lang->line('invalid_data');
                }
            } else {

                $this->_status  = FALSE;
                $this->_message = $this->ci->lang->line('invalid_data');
                
            }

            return $this->getResponse();
        }
    }

    function checkFrequencyOfferAdded($frequencyId, $serviceId) {

        $result = $this->model->get_tb('mm_service_frequency_offer', 'service_frequency_offer_id', array('service_frequency_offer_frequency_id' => $frequencyId, 'service_frequency_offer_service_id' => $serviceId, 'service_frequency_offer_archived' => 0))->result();
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    function createFrequencyOffer($freqId, $serviceId, $offerVal, $person_id, $offerIn = Globals::FREQUENCY_OFFER_IN_PERCENTAGE) {
        $info = array();
        $info['service_frequency_offer_frequency_id'] = $freqId;
        $info['service_frequency_offer_service_id'] = $serviceId;
        $info['service_frequency_offer_value'] = $offerVal;
        $info['service_frequency_offer_in'] = $offerIn;
        $info['service_frequency_offer_created_on'] = date('Y-m-d H:i:s', strtotime('now'));
        $info['service_frequency_offer_created_by'] = $person_id;

        return $insert_id = $this->model->insert_tb('mm_service_frequency_offer', $info);
    }

    /* Function to check the Offer history available in User service booking */

    function checkFrequencyOfferHistoryAvailable() {
        return false;
    }

    function _getFrequencyOfferList($serviceId) {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $archived = Globals::UN_ARCHIVE;

        $this->resetResponse();
        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            $result = $this->model->getFrequencyOfferPriceList('*', array('service_frequency_offer_service_id' => $serviceId, 'service_frequency_offer_archived' => $archived))->result();
            if ($result) {
                $this->_status   = true;
                $this->_rdata    = $result;
                             
            } else {
                $this->_message  = $this->ci->lang->line('no_records_found'); 
                $this->_status   = false;

            }
        } else {

            $this->_message  = $this->ci->lang->line('invalid_request'); 
            $this->_status   = false;
                     
        }

        return $this->getResponse();
    }

    function _archiveServiceFrequencyOffer() {
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('freqOfferId', 'Service Frequency Offer Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('frequencyId', 'Service Frequency Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $info = array();
            $freqOffer_id = $this->ci->input->post('freqOfferId', true);
            $freqId = $this->ci->input->post('frequencyId', true);
            $service_id = $this->ci->input->post('serviceId', true);
            $archive = intval($this->ci->input->post('archive', true));

            $result = $this->model->get_tb('mm_service_frequency_offer', 'service_frequency_offer_id', array('service_frequency_offer_id' => $freqOffer_id, 'service_frequency_offer_frequency_id' => $freqId, 'service_frequency_offer_service_id' => $service_id))->result();
            if (!empty($result)) {
                
                $this->archiveFrequencyOffer($freqOffer_id, $freqId, $service_id, $archive, $person_id);
             
            } else {
                $this->_message  = $this->ci->lang->line('invalid_data'); 
                $this->_status   = false;

            }

            return $this->getResponse();
        }
    }

    /*  Archive / Unarchive the Frequency Offers */
    function archiveFrequencyOffer($freqOffer_id, $freqId, $service_id, $archive, $person_id) {
        if($archive == Globals::UN_ARCHIVE){
            if( $this->hasUnArchivedFrequencyOffer($freqId, $service_id) ){               
               $this->_message  = $this->ci->lang->line('service_frequency_offer_already_exists'); 
               $this->_status   = false;
               return;
            }
        }
        $info = array();
        $info['service_frequency_offer_archived'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;
        $info['service_frequency_offer_updated_by'] = $person_id;

        $this->model->update_tb('mm_service_frequency_offer', array('service_frequency_offer_id' => $freqOffer_id, 'service_frequency_offer_frequency_id' => $freqId, 'service_frequency_offer_service_id' => $service_id), $info);
        $this->_message  = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('service_frequency_offer_archived') : $this->ci->lang->line('service_frequency_offer_unarchived'); 
        $this->_status   = true;
        return;
        
    }
    
    /* Function to check same frequency in UnArchive status to block the duplicacy. */
    function hasUnArchivedFrequencyOffer($freqId, $service_id){
        
        $result = $this->model->get_tb('mm_service_frequency_offer', 'service_frequency_offer_id', array('service_frequency_offer_frequency_id'=>$freqId, 'service_frequency_offer_service_id'=>$service_id, 'service_frequency_offer_archived'=>Globals::UN_ARCHIVE))->result();       
        if(!empty($result)){ return true; }else{ return false; }
    }

    /*   */
    function _updateServiceFrequencyOffer() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('freqOfferId', 'Service Frequency Offer Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('frequencyId', 'Service Frequency Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('offerVal', 'Offer Discount Value', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $info = array();
            $freqOffer_id = $this->ci->input->post('freqOfferId', true);
            $freqId = $this->ci->input->post('frequencyId', true);
            $service_id = $this->ci->input->post('serviceId', true);
            $offerVal = $this->ci->input->post('offerVal', true);

            $result = $this->model->get_tb('mm_service_frequency_offer', 'service_frequency_offer_id', array('service_frequency_offer_id' => $freqOffer_id, 'service_frequency_offer_frequency_id' => $freqId, 'service_frequency_offer_service_id' => $service_id))->result();
            if (!empty($result)) {

                if (!$this->checkFrequencyOfferHistoryAvailable()) {
                    $info['service_frequency_offer_value'] = $offerVal;
                    $info['service_frequency_offer_updated_by'] = $person_id;

                    $this->model->update_tb('mm_service_frequency_offer', array('service_frequency_offer_id' => $freqOffer_id, 'service_frequency_offer_frequency_id' => $freqId, 'service_frequency_offer_service_id' => $service_id), $info);

                    $this->_message  = $this->ci->lang->line('service_frequency_offer_updated'); 
                    $this->_status   = true;
                    
                } else {

                    $this->archiveFrequencyOffer($freqOffer_id, $freqId, $service_id, Globals::ARCHIVE, $person_id);
                    $insert_id = $this->createFrequencyOffer($freqId, $service_id, $offerVal, $person_id);

                }

                         
            } else {
                $this->_message  = $this->ci->lang->line('invalid_data'); 
                $this->_status   = false;
                
            }

            return $this->getResponse();
        }
    }

    function _getServiceAddonsPriceList() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $archived = Globals::UN_ARCHIVE;
        $this->resetResponse();
        
        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            $serviceId = $this->ci->input->post('serviceId', true);
            $result = $this->model->getServiceAddonsPriceList('*', array('service_addon_price_service_id' => $serviceId, 'service_addon_price_archived' => $archived))->result();
            if ($result) {
                $this->_message  = ''; 
                $this->_status   = true;
                $this->_rdata    = $result;
            } else {
                $this->_message  = $this->ci->lang->line('no_records_found'); 
                $this->_status   = FALSE;
            }
        } else {
            $this->_message  = $this->ci->lang->line('invalid_request'); 
            $this->_status   = FALSE;
        }

        return $this->getResponse();
    }

    function _createServiceAddonsPrice() {

        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('add_addons_price_service_id', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('add_addons_price_addon_id', 'Service Addon Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('add_addon_price', 'Service Addon Price', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));


        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');

            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $addon_id = $this->ci->input->post('add_addons_price_addon_id', true);
            $service_id = $this->ci->input->post('add_addons_price_service_id', true);

            $result = $this->model->get_tb('mm_service_addon', 'service_addon_id', array('service_addon_id' => $addon_id))->result();

            if (!empty($result)) {

                $result = $this->model->get_tb('mm_services', 'service_id', array('service_id' => $service_id))->result();

                if (!empty($result)) {

                    if ($this->checkServiceAddonPriceAdded($addon_id, $service_id)) {
                        $this->_message  = $this->ci->lang->line('service_addon_price_already_created'); 
                        $this->_status   = false;
                        return $this->getResponse();
                    }

                    $priceVal = $this->ci->input->post('add_addon_price', true);
                    $insert_id = $this->createServiceAddonPrice($addon_id, $service_id, $priceVal, $person_id);

                    if ($insert_id > 0) {
                        $this->_message  = $this->ci->lang->line('service_addon_price_created'); 
                        $this->_status   = true;
                    } else {
                        $this->_message  = $this->ci->lang->line('something_problem'); 
                        $this->_status   = false;
                    }
                } else {
                    $this->_message  = $this->ci->lang->line('invalid_data'); 
                    $this->_status   = false;
                }
            } else {
                $this->_message  = $this->ci->lang->line('invalid_data'); 
                $this->_status   = false;
            }

            return $this->getResponse();
        }
    }

    function checkServiceAddonPriceAdded($addonId, $serviceId) {

        $result = $this->model->get_tb('mm_service_addon_price', 'service_addon_price_id', array('service_addon_price_addon_id' => $addonId, 'service_addon_price_service_id' => $serviceId, 'service_addon_price_archived' => Globals::UN_ARCHIVE))->result();
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    function createServiceAddonPrice($addonId, $serviceId, $priceVal, $person_id) {
        $info = array();
        $info['service_addon_price_addon_id'] = $addonId;
        $info['service_addon_price_service_id'] = $serviceId;
        $info['service_addon_price_price'] = $priceVal;
        $info['service_addon_price_created_on'] = date('Y-m-d H:i:s', strtotime('now'));
        
        $info['service_addon_price_created_by'] = $person_id;

        return $insert_id = $this->model->insert_tb('mm_service_addon_price', $info);
    }

    function _archiveServiceAddonPrice() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('addonPriceId', 'Service Addon Price Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('addonId', 'Service Addon Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $addon_price_id = $this->ci->input->post('addonPriceId', true);
            $addon_id = $this->ci->input->post('addonId', true);
            $service_id = $this->ci->input->post('serviceId', true);
            $archive = intval($this->ci->input->post('archive', true));

            $result = $this->model->get_tb('mm_service_addon_price', 'service_addon_price_id', array('service_addon_price_id' => $addon_price_id, 'service_addon_price_addon_id' => $addon_id, 'service_addon_price_service_id' => $service_id))->result();
            if (!empty($result)) {

                $this->archiveServiceAddonPrice($addon_price_id, $addon_id, $service_id, $archive, $person_id);

            } else {
                $this->_message  = $this->ci->lang->line('invalid_data'); 
                $this->_status   = false;
            }

            return $this->getResponse();
        }
    }

    /* Archive / UnArchive Addon Price */
    function archiveServiceAddonPrice($addon_price_id, $addon_id, $service_id, $archive, $person_id) {
        if($archive == Globals::UN_ARCHIVE){
            if( $this->hasUnArchivedServiceAddon($addon_id, $service_id) ){               
               $this->_message  = $this->ci->lang->line('service_addon_price_already_exists'); 
               $this->_status   = false;
               return;
            }
        }
        $info = array();
        $info['service_addon_price_archived'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;
        $info['service_addon_price_updated_by'] = $person_id;

        $this->model->update_tb('mm_service_addon_price', array('service_addon_price_id' => $addon_price_id, 'service_addon_price_addon_id' => $addon_id, 'service_addon_price_service_id' => $service_id), $info);
        $this->_message  = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('service_addon_price_archived') : $this->ci->lang->line('service_addon_price_unarchived'); 
        $this->_status   = true;
        return;
    }
    
    /* Function to check same Addon in UnArchive status to block the duplicacy. */
    function hasUnArchivedServiceAddon($addon_id, $service_id){
        
        $result = $this->model->get_tb('mm_service_addon_price', 'service_addon_price_id', array('service_addon_price_addon_id'=>$addon_id, 'service_addon_price_service_id'=>$service_id, 'service_addon_price_archived'=>Globals::UN_ARCHIVE))->result();       
        if(!empty($result)){ return true; }else{ return false; }
    }

    function _updateServiceAddonPrice() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('addonPriceId', 'Service Addon Price Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('addonId', 'Service Addon Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('priceVal', 'Service Addon Price', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $addon_price_id = $this->ci->input->post('addonPriceId', true);
            $addon_id = $this->ci->input->post('addonId', true);
            $service_id = $this->ci->input->post('serviceId', true);
            $priceVal = $this->ci->input->post('priceVal', true);

            $result = $this->model->get_tb('mm_service_addon_price', 'service_addon_price_id', array('service_addon_price_id' => $addon_price_id, 'service_addon_price_addon_id' => $addon_id, 'service_addon_price_service_id' => $service_id))->result();
            if (!empty($result)) {

                if (!$this->checkServiceAddonPriceHistoryAvailable()) {
                    $info = array();
                    $info['service_addon_price_price'] = $priceVal;
                    $info['service_addon_price_updated_by'] = $person_id;

                    $this->model->update_tb('mm_service_addon_price', array('service_addon_price_id' => $addon_price_id, 'service_addon_price_addon_id' => $addon_id, 'service_addon_price_service_id' => $service_id), $info);

                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('service_addon_price_updated');
                } else {

                    $this->archiveServiceAddonPrice($addon_price_id, $addon_id, $service_id, Globals::ARCHIVE, $person_id);

                    $insert_id = $this->createServiceAddonPrice($addon_id, $service_id, $priceVal, $person_id);
                }
            } else {

                $this->_status = false;
                $this->_message = $this->ci->lang->line('invalid_data');
            }

            return $this->getResponse();
        }
    }

    function checkServiceAddonPriceHistoryAvailable() {
        return FALSE;
    }

     /* Service Special Request List */
    function _getServiceSplRequestList() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $archived = Globals::UN_ARCHIVE;
        $this->resetResponse();
        
        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            $serviceId = $this->ci->input->post('serviceId', true);
            $result = $this->model->getServiceSplRequestList('*', array('service_spl_request_service_id' => $serviceId, 'service_spl_request_archived' => $archived))->result();
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
            $this->_message = $this->ci->lang->line('invalid_request');
        }

        return $this->getResponse();
    }

    function _createServiceSplRequest() {

        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('add_service_spl_service_id', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('add_spl_request_id', 'Service Spl Request Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('add_spl_request_price', 'Service Spl Request Price', 'trim|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));


        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');

            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $splReqId = $this->ci->input->post('add_spl_request_id', true);
            $service_id = $this->ci->input->post('add_service_spl_service_id', true);
            $price      = $this->ci->input->post('add_spl_request_price', true);

            $result = $this->model->get_tb('mm_spl_request', 'spl_request_id', array('spl_request_id' => $splReqId))->result();

            if (!empty($result)) {

                $result = $this->model->get_tb('mm_services', 'service_id', array('service_id' => $service_id))->result();

                if (!empty($result)) {

                    if ($this->checkServiceSplRequestAdded($splReqId, $service_id)) {
                        $this->_status = FALSE;
                        $this->_message = $this->ci->lang->line('service_spl_request_already_created');
                        return $this->getResponse();
                    }

                    $insert_id = $this->createServiceSplRequest($splReqId, $service_id, $person_id, $price);

                    if ($insert_id > 0) {
                        $this->_status = true;
                        $this->_message = $this->ci->lang->line('service_spl_request_created');
                        
                    } else {
                        $this->_status = FALSE;
                        $this->_message = $this->ci->lang->line('something_problem');                     
                    }
                } else {
                    $this->_status = FALSE;
                    $this->_message = $this->ci->lang->line('invalid_data');
                }
            } else {
                $this->_status = FALSE;
                $this->_message = $this->ci->lang->line('invalid_data');
            }

            return $this->getResponse();
        }
    }

    function checkServiceSplRequestAdded($splReqId, $serviceId) {

        $result = $this->model->get_tb('mm_service_spl_request', 'service_spl_request_id', array('service_spl_request_spl_request_id' => $splReqId, 'service_spl_request_service_id' => $serviceId, 'service_spl_request_archived' => Globals::UN_ARCHIVE))->result();
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    function createServiceSplRequest($splReqId, $serviceId, $person_id, $price = null) {
        $info = array();
        $info['service_spl_request_spl_request_id'] = $splReqId;
        $info['service_spl_request_service_id'] = $serviceId;
        $info['service_spl_request_price'] = $price;
        $info['service_spl_request_created_on'] = date('Y-m-d H:i:s', strtotime('now'));
        $info['service_spl_request_created_by'] = $person_id;

        return $insert_id = $this->model->insert_tb('mm_service_spl_request', $info);
    }

    /* Upadte the service spl request price. */
    function _updateServiceSplRequestPrice(){
        
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('serviceSplReqId', 'Service Package Postcode Price Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Package Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('splReqId', 'Service Package Postcode', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('priceVal', 'Postcode Price', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $service_spl_req_id = $this->ci->input->post('serviceSplReqId', true);
            $service_id         = $this->ci->input->post('serviceId', true);
            $priceVal           = $this->ci->input->post('priceVal', true);
            $spl_req_id         = $this->ci->input->post('splReqId', true);

            $result = $this->model->get_tb('mm_service_spl_request', 'service_spl_request_id', array('service_spl_request_id' => $service_spl_req_id, 'service_spl_request_spl_request_id' => $spl_req_id, 'service_spl_request_service_id'=>$service_id))->result();
            if (!empty($result)) {

                if (!$this->checkServiceSplRequestHistoryAvailable()) {
                    $info = array();
                    $info['service_spl_request_price'] = $priceVal;
                    $info['service_spl_request_updated_by'] = $person_id;

                    $this->model->update_tb('mm_service_spl_request', array('service_spl_request_id' => $service_spl_req_id, 'service_spl_request_spl_request_id' => $spl_req_id, 'service_spl_request_service_id'=>$service_id), $info);
                    
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('service_spl_request_updated');
                    
                } else {

                    $this->archiveServiceSplRequest($service_spl_req_id, $spl_req_id, $service_id, Globals::ARCHIVE, $person_id);

                    $this->createServiceSplRequest($spl_req_id, $service_id, $person_id, $priceVal);

                }
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('invalid_data');
            }

            return $this->getResponse();
        }
        
    }
    
    /* Check the Service Spl request history available with user service booking. */
    function checkServiceSplRequestHistoryAvailable(){
        
        return false;
    }
    
    /* Archive / UnArchive Service Special request */
    function _archiveServiceSplRequest(){
        
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('serviceSplReqId', 'Service Special Request', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('splReqId', 'Special Request Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        
        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');           
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $service_spl_req_id = $this->ci->input->post('serviceSplReqId', true);
            $spl_req_id = $this->ci->input->post('splReqId', true);
            $service_id = $this->ci->input->post('serviceId', true);
            $archive = intval($this->ci->input->post('archive', true));

            $result = $this->model->get_tb('mm_service_spl_request', 'service_spl_request_id', array('service_spl_request_id' => $service_spl_req_id, 'service_spl_request_spl_request_id' => $spl_req_id, 'service_spl_request_service_id' => $service_id))->result();
            if (!empty($result)) {

                $this->archiveServiceSplRequest($service_spl_req_id, $spl_req_id, $service_id, $archive, $person_id);

            } else {
                $this->_message  = $this->ci->lang->line('invalid_data'); 
                $this->_status   = false;
            }

            return $this->getResponse();
        }
    }
    
    /* Archive / UnArchive Service Spl Request */
    function archiveServiceSplRequest($service_spl_req_id, $spl_req_id, $service_id, $archive, $person_id) {
        if($archive == Globals::UN_ARCHIVE){
            if( $this->hasUnArchivedServiceSplRequest($spl_req_id, $service_id) ){               
               $this->_message  = $this->ci->lang->line('service_Spl_request_already_exists'); 
               $this->_status   = false;
               return;
            }
        }
        $info = array();
        $info['service_spl_request_archived'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;
        $info['service_spl_request_updated_by'] = $person_id;

        $this->model->update_tb('mm_service_spl_request', array('service_spl_request_id' => $service_spl_req_id, 'service_spl_request_spl_request_id' => $spl_req_id, 'service_spl_request_service_id' => $service_id), $info);
        $this->_message  = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('service_spl_request_archived') : $this->ci->lang->line('service_spl_request_unarchived'); 
        $this->_status   = true;
        return;
    }
    
    /* Function to check same Service SPl request in UnArchive status to block the duplicacy. */
    function hasUnArchivedServiceSplRequest($spl_req_id, $service_id){
        
        $result = $this->model->get_tb('mm_service_spl_request', 'service_spl_request_id', array('service_spl_request_spl_request_id'=>$spl_req_id, 'service_spl_request_service_id'=>$service_id, 'service_spl_request_archived'=>Globals::UN_ARCHIVE))->result();       
        if(!empty($result)){ return true; }else{ return false; }
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
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";

        $response = array();
        $this->resetResponse();

        $this->ci->form_validation->set_rules('areaCode[]', 'Area Code', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('packageId', 'Package Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');

            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {
            $areaCodes = implode(',', array_map(function($str) {
                        return sprintf("'%s'", $str);
                    }, $this->ci->input->post('areaCode', true)));

            $packageId = $this->ci->input->post('packageId', true);

            $result = $this->model->get_postcodes($areaCodes, $packageId)->result();

            $this->_status = true;
            $this->_message = '';
            $this->_rdata = $result;
            return $this->getResponse();
        }
    }

     /* Set the ditinct price for a Service package of a service based on Postcode  */
    function _setServicePackagePostalPrice() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('stateSelect', 'State', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('areaSelect[]', 'Area', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('postcodeSelect[]', 'Postcodes', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('postcodePrice', 'Postcode Price', 'trim|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('packageId', 'Service Package Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $info = array();
            $package_id = $this->ci->input->post('packageId', true);
            $service_id = $this->ci->input->post('serviceId', true);
            $price = $this->ci->input->post('postcodePrice', true);

            $result = $this->model->get_tb('mm_service_package', 'service_package_id', array('service_package_id' => $package_id, 'service_package_service_id' => $service_id))->result();
            if (!empty($result)) {

                $postcodes = $this->ci->input->post('postcodeSelect[]', true);
                $data = array();
                foreach ($postcodes as $code) {
                    $info = array();
                    $info['postcode_service_price_package_id'] = $package_id;
                    $info['postcode_service_price_postcode'] = $code;
                    $info['postcode_service_price_price'] = $price;
                    $info['postcode_service_price_created_on'] = date('Y-m-d H:i:s', strtotime('now'));
                    $info['postcode_service_price_updated_on'] = date('Y-m-d H:i:s', strtotime('now'));
                    $info['postcode_service_price_created_by'] = $person_id;
                    $info['postcode_service_price_updated_by'] = $person_id;
                    array_push($data, $info);
                }
                if (!empty($data)) {
                    $this->model->insert_batch_tb('mm_postcode_service_price', $data);

                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('service_package_postcode_price_added');
                    $this->_rdata = array();
                }
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('invalid_request');
                $this->_rdata = array();
            }
        }
        return $this->getResponse();
    }

     /* Get the distinct price for a Service package of a service based on Postcode  */
    function _getServicePackagePostalPriceList() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $archived = Globals::UN_ARCHIVE;
        $this->resetResponse();
        
        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            $packageId = $this->ci->input->post('package_id', true);
            $result = $this->model->getServicePackagePincodePriceList('*', array('postcode_service_price_package_id' => $packageId, 'postcode_service_archived' => $archived))->result();
            if ($result) {
                $this->_status = true;
                $this->_message = '';
                $this->_rdata = $result;
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('no_records_found');
                $this->_rdata = array();
            }
        } else {
            $this->_status = false;
            $this->_message = $this->ci->lang->line('invalid_request');
            $this->_rdata = array();
        }

        return $this->getResponse();
    }

    /* Postcpde Price Archive/UnArchive */
    function _archiveServicePackagePostcodePrice() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('postcodePriceId', 'Service Package Postcode Price Id', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('packageId', 'Service Package Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('archive', 'Archive Status', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('postcode', 'Postcode', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        
        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $postcode_price_id = $this->ci->input->post('postcodePriceId', true);
            $package_id = $this->ci->input->post('packageId', true);
            $archive = intval($this->ci->input->post('archive', true));
            $postcode = $this->ci->input->post('postcode', true);

            $result = $this->model->get_tb('mm_postcode_service_price', 'postcode_service_price_id', array('postcode_service_price_id' => $postcode_price_id, 'postcode_service_price_package_id' => $package_id))->result();
            if (!empty($result)) {

                $this->archiveServicePackagePostcodePrice($postcode_price_id, $package_id, $postcode, $archive, $person_id);
                
            } else {
                $this->_message  = $this->ci->lang->line('invalid_data'); 
                $this->_status   = false;
            }

            return $this->getResponse();
        }
    }

    /* Postcpde Price Archive/UnArchive */
    function archiveServicePackagePostcodePrice($postcode_price_id, $package_id, $postcode, $archive, $person_id) {
        if($archive == Globals::UN_ARCHIVE){
            if( $this->hasUnArchivedServicePackagePostcodePrice($postcode_price_id, $package_id, $postcode) ){               
               $this->_message  = $this->ci->lang->line('package_postcode_price_already_exists'); 
               $this->_status   = false;
               return;
            }
        }
        $info = array();
        $info['postcode_service_archived'] = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE;
        $info['postcode_service_price_updated_by'] = $person_id;

        $this->model->update_tb('mm_postcode_service_price', array('postcode_service_price_id' => $postcode_price_id, 'postcode_service_price_package_id' => $package_id), $info);
        $this->_message  = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('package_postcode_price_archived') : $this->ci->lang->line('package_postcode_price_unarchived'); 
        $this->_status   = true;
        return;
    }
    
    /* Function to check same Service SPl request in UnArchive status to block the duplicacy. */
    function hasUnArchivedServicePackagePostcodePrice($postcode_price_id, $package_id, $postcode){
        
        $result = $this->model->get_tb('mm_postcode_service_price', 'postcode_service_price_id', array('postcode_service_price_id'=>$postcode_price_id, 'postcode_service_price_package_id'=>$package_id,'postcode_service_price_postcode'=>$postcode, 'postcode_service_archived'=>Globals::UN_ARCHIVE))->result();       
        if(!empty($result)){ return true; }else{ return false; }
    }

    /* Postcpde Price Updating */
    function _updateServicePackagePostcodePrice() {

        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->resetResponse();
        
        $this->ci->form_validation->set_rules('postcodePriceId', 'Service Package Postcode Price Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('packageId', 'Service Package Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('postcode', 'Service Package Postcode', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('priceVal', 'Postcode Price', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $postcode_price_id  = $this->ci->input->post('postcodePriceId', true);
            $package_id         = $this->ci->input->post('packageId', true);
            $priceVal           = $this->ci->input->post('priceVal', true);
            $postcode           = $this->ci->input->post('postcode', true);

            $result = $this->model->get_tb('mm_postcode_service_price', 'postcode_service_price_id', array('postcode_service_price_id' => $postcode_price_id, 'postcode_service_price_package_id' => $package_id))->result();
            if (!empty($result)) {

                if (!$this->checkServicePackagePincodePriceHistoryAvailable()) {
                    $info = array();
                    $info['postcode_service_price_price'] = $priceVal;
                    $info['postcode_service_price_updated_by'] = $person_id;

                    $this->model->update_tb('mm_postcode_service_price', array('postcode_service_price_id' => $postcode_price_id, 'postcode_service_price_package_id' => $package_id), $info);
                    
                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('package_postcode_price_updated');
                    
                } else {

                    $this->archiveServicePackagePostcodePrice($postcode_price_id, $package_id, $postcode, Globals::ARCHIVE, $person_id);

                    $this->createServicePackagePostcodePrice($package_id, $priceVal, $postcode, $person_id);

                }
            } else {

                $this->_status = FALSE;
                $this->_message = $this->ci->lang->line('invalid_data');
            }

            return $this->getResponse();
        }
    }

    /* Check any history attcahed with the Pincode price in the User orders. */
    function checkServicePackagePincodePriceHistoryAvailable() {
        return FALSE;
    }
    
    /* Create the Service Package Postcode Price. */
    function createServicePackagePostcodePrice($package_id, $priceVal, $postcode, $person_id){        
        $info = array();
        $info['postcode_service_price_package_id']  = $package_id;
        $info['postcode_service_price_postcode']    = $postcode;
        $info['postcode_service_price_price']       = $priceVal;
        $info['postcode_service_price_created_on']  = date('Y-m-d H:i:s', strtotime('now'));
        $info['postcode_service_price_created_by']  = $person_id;

        return $insert_id = $this->model->insert_tb('mm_postcode_service_price', $info);
        
    }
    
    /*
     * Fnunction to update the Configuration Values
     */
    function _updateConfig(){
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        
        $this->resetResponse();

        $this->ci->form_validation->set_rules('senderEmail', 'Sender Email', 'trim|required|xss_clean|encode_php_tags|valid_email', array('required' => 'You must provide a valid %s.'));
        $this->ci->form_validation->set_rules('gst', 'GST', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('gstStatus', 'GST Status', 'trim|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('profit_cutoff', 'Commission', 'trim|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        
        if ($this->ci->form_validation->run() == FALSE) {
                $this->_status = FALSE;
                $this->_message = $this->ci->lang->line('invalid_data');
                return $this->getResponse();
        } else {

            $senderEmail = $this->ci->input->post('senderEmail', true);
            $gst         = $this->ci->input->post('gst', true);
            $profitCutoff         = $this->ci->input->post('profit_cutoff', true);
            $config      = array();
            
            if(isset($_POST['gstStatus']) && ($_POST['gstStatus'] == 'on') ){
                $config[] = array('config_name'=>'gst', 'config_value'=>$gst, 'config_status'=>1);
            }else{
                $config[] = array('config_name'=>'gst', 'config_value'=>$gst, 'config_status'=>0);
            }
            
            $config[] = array('config_name'=>'sender_email', 'config_value'=>$senderEmail);
            $config[] = array('config_name'=>'profit_cutoff', 'config_value'=>$profitCutoff);
            
            $this->model->update_batch_tb('mm_config', $config, 'config_name');
            
            if ($this->model->getAffectedRowCount() > 0) {
                $response = array(
                    'status' => true,
                    'message' => $this->ci->lang->line('config_settings_updated'),
                );
                //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('no_changes_to_update'),
                );
            }
            

            return $response;
        }
    }
    
    /** Function to List the New Service Orders.
     * @param null
     * @return JSON returns the JSON with New Service Orders    
     */
    function _newServiceOrders(){
        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $now = date('Y-m-d H:i:s', strtotime('now'));

            $newServices = $this->model->getNewServiceOrders($now);
            //print_r($newServices); exit;

            if (!empty($newServices)) {
                $result = array();
                $i = 0;
                foreach ($newServices as $service) {
                    $result[$i]['booking_id'] = $service->booking_id;
                    $result[$i]['booking_pincode'] = $service->booking_pincode;
                    $result[$i]['service_name'] = $service->service_name;
                    $result[$i]['customer_name'] = $service->person_first_name . " " . $service->person_last_name;
                    $result[$i]['person_mobile'] = $service->person_mobile;
                    $result[$i]['booking_service_date'] = $service->booking_service_date;
                    $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                    $result[$i]['booking_status'] = $service->booking_status;
                    $result[$i]['booking_amount'] = $service->booking_amount;
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
    
    /** Function to List the Active Service Orders.
     * @param null
     * @return JSON returns the JSON with Active Service Orders    
     */
    function _activeServiceOrders(){
        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {

                $activeServices = $this->model->getActiveServiceOrders();
                //print_r($newServices); exit;

                if (!empty($activeServices)) {
                    $result = array();
                    $i = 0;
                    foreach ($activeServices as $service) {
                        $result[$i]['booking_id'] = $service->booking_id;
                        $result[$i]['booking_pincode'] = $service->booking_pincode;
                        $result[$i]['service_name'] = $service->service_name;
                        $result[$i]['person_mobile'] = $service->person_mobile;
                        $result[$i]['customer_name'] = $service->person_first_name . " " . $service->person_last_name;
                        $result[$i]['booking_service_date'] = $service->booking_service_date;
                        $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                        $result[$i]['booking_status'] = $service->booking_status;
                        $result[$i]['booking_amount'] = $service->booking_amount;
                        $result[$i]['company_name'] = $service->company_name;
                        $result[$i]['company_landphone'] = $service->company_landphone;
                        $result[$i]['booking_cancelable'] = true;
                        $result[$i]['booking_cancelled_by'] = $service->booking_cancelled_by;
                        $result[$i]['booking_completion_user_confirmed'] = $service->booking_completion_user_comfirmed;
                        $result[$i]['booking_completion_company_confirmed'] = $service->booking_completion_company_confirmed;
                        
                        $now = date('Y-m-d H:i:s');                       
                        $service_date = date('Y-m-d H:i:s', strtotime($service->booking_service_date));
                    
                        if(strtotime($now) >= strtotime($service_date) && $service->booking_vendor_company_id != null && ( $service->booking_status == Globals::BOOKING_CONFIRMED || $service->booking_status == Globals::BOOKING_COMPLETED) ){
                            $result[$i]['confirm_completed'] = true;
                        }else{
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

        return $this->getResponse();
    }

    /** Function to cancel the order.
     * @param null
     * @return JSON returns order cancellation status
    */
    function _cancelOrder(){
        
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('bookingId', 'Booking Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $booking_id = $this->ci->input->post('bookingId', true);
            $cancellation_request_from_client = true;

            $booking_detail = $this->model->get_tb('mm_booking', 'booking_user_id, booking_amount, booking_service_date, booking_booked_on, booking_vendor_company_id, booking_payment_status, booking_cancelled_by', array('booking_id' => $booking_id))->result();

            if(!empty($booking_detail)) {
                $now = date('Y-m-d H:i:s');
                if($booking_detail[0]->booking_cancelled_by != null){
                    $this->model->update_tb('mm_booking', array('booking_id' => $booking_id), array('booking_status' => Globals::BOOKING_CANCELLED, 'booking_cancelled_approved_by_admin'=>1, 'booking_cancelled_approved_by_admin_on'=>$now));
                    $cancellation_request_from_client = true;
                }else{
                    $this->model->update_tb('mm_booking', array('booking_id' => $booking_id), array('booking_status' => Globals::BOOKING_CANCELLED, 'booking_cancelled_by' => $person_id, 'booking_cancelled_on' => $now, 'booking_cancelled_approved_by_admin'=>1, 'booking_cancelled_approved_by_admin_on'=>$now));
                    $cancellation_request_from_client = false;
                }
                
                if($this->model->getAffectedRowCount() > 0) {
                    if($booking_detail[0]->booking_payment_status == Globals::PAYMENT_SUCCESS){
                        $this->updateUserWallet($booking_detail[0]->booking_amount, $booking_id, Globals::WALLET_CREDIT, $booking_detail[0]->booking_user_id, "Service order cancellation payment.");
                    }
                    if($booking_detail[0]->booking_vendor_company_id != null){
                        $info = $this->model->getServiceBookingDetail($booking_id, $booking_detail[0]->booking_vendor_company_id);
                        $this->ci->email_lib->order_cancelation_confirmation_mail_to_vendor($info[0]->company_email_id, $info[0]);
                    }else{
                        $info = $this->model->getServiceBookingDetail($booking_id);
                    }
                    $this->ci->email_lib->order_cancelation_confirmation_mail($info[0]->person_email, $info[0]);
                    

                    $this->_status = true;
                    $this->_message = $this->ci->lang->line('order_cancelation_confirmed');
                } else {
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('no_changes_to_update');
                }
                
            } else {
                $this->_message = $this->ci->lang->line('no_records_found');
                $this->_status = false;
            }


            return $this->getResponse();
        }
        
    }
    
    /** Function to get the canceled Order list.
    * @param null
    * @return JSON returns JSON with canceled Orders List
    */
    function _canceledServiceOrdersList(){
        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');


            $canceledServices = $this->model->getCanceledBookings();
            //print_r($activeServices); exit;

            if (!empty($canceledServices)) {
                $result = array();
                $i = 0;
                foreach ($canceledServices as $service) {
                    $result[$i]['booking_id'] = $service->booking_id;
                    $result[$i]['booking_pincode'] = $service->booking_pincode;
                    $result[$i]['person_mobile'] = $service->person_mobile;
                    $result[$i]['customer_name'] = $service->person_first_name . " " . $service->person_last_name;
                    $result[$i]['company_name'] = $service->company_name;
                    $result[$i]['company_landphone'] = $service->company_landphone;
                    $result[$i]['service_name'] = $service->service_name;
                    $result[$i]['booking_service_date'] = $service->booking_service_date;
                    $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                    $result[$i]['booking_status'] = $service->booking_status;
                    $result[$i]['booking_amount'] = $service->booking_amount;
                    $result[$i]['booking_cancelled_on'] = $service->booking_cancelled_on;
                    $result[$i]['booking_cancelled_by'] = $service->booking_cancelled_by;
                    if($service->booking_cancelled_by === $this->ci->session->userdata('user_id')){
                        $result[$i]['booking_cancelation_request_sent_from'] = 'Self';
                    }else{
                        $result[$i]['booking_cancelation_request_sent_from'] = 'User';
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

        return $this->getResponse();
    }


    /** Function to Confirm the order and credit the vendor wallet with service amount.
     * @param null
     * @return JSON returns order confirmation status
    */
    function _confirmOrderCompletion(){
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

                if(strtotime($now) >= strtotime($service_date) && $booking_detail[0]->booking_vendor_company_id != null && ( $booking_detail[0]->booking_status == Globals::BOOKING_CONFIRMED || $booking_detail[0]->booking_status == Globals::BOOKING_COMPLETED) ){
                    
                    $this->model->update_tb('mm_booking', array('booking_id' => $booking_id), array('booking_status' => Globals::BOOKING_COMPLETED, 'booking_completion_admin_confirmed' => 1, 'booking_completion_admin_confirmed_on'=>$now));
                    if ($this->model->getAffectedRowCount() > 0) {
                        //get the booking details
                        $info = $this->model->getServiceBookingDetail($booking_id, $booking_detail[0]->booking_vendor_company_id);

                        //get the Vendor and Admin Share for the service price
                        $profit_share = $this->calculateCutoffAmount($info[0]->booking_amount);
                        $this->updateVendorWallet($profit_share['vendor_share'], $booking_id, Globals::WALLET_CREDIT, $info[0]->company_person_id, "Service completion payment");
                        $this->updateAdminWallet($profit_share['admin_share'], $booking_id, Globals::WALLET_CREDIT, $person_id, "Service completion payment");
                        //Send Emails to Vendor 
                        //$this->ci->email_lib->order_completion_confirmation_mail($info[0]->person_email, $info[0]);
                        $this->ci->email_lib->order_completion_confirmation_mail_to_vendor($info[0]->company_email_id, $info[0], $profit_share['vendor_share']);
                        
                        $this->_status = true;
                        $this->_message = $this->ci->lang->line('order_completion_confirmed');
                    } else {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('no_changes_to_update');
                    }
                    
                }else {
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
    
    /** Function to get the Completed Order list.
    * @param null
    * @return JSON returns JSON with Completed Orders List
    */
    function _completedServiceOrdersList(){
        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');


            $completedServices = $this->model->getCompletedServiceOrders();
            //print_r($completedServices); exit;

            if (!empty($completedServices)) {
                $result = array();
                $i = 0;
                foreach ($completedServices as $service) {
                    $result[$i]['booking_id'] = $service->booking_id;
                    $result[$i]['booking_pincode'] = $service->booking_pincode;
                    $result[$i]['customer_name'] = $service->person_first_name . " " . $service->person_last_name;
                    $result[$i]['person_mobile'] = $service->person_mobile;
                    $result[$i]['company_name'] = $service->company_name;
                    $result[$i]['company_landphone'] = $service->company_landphone;
                    $result[$i]['service_name'] = $service->service_name;
                    $result[$i]['booking_service_date'] = $service->booking_service_date;
                    $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                    $result[$i]['booking_status'] = $service->booking_status;
                    $result[$i]['booking_amount'] = $service->booking_amount;
                    $result[$i]['booking_completion_company_confirmed'] = $service->booking_completion_company_confirmed;
                    $result[$i]['booking_completion_user_comfirmed'] = $service->booking_completion_user_comfirmed;
                    $result[$i]['booking_completion_admin_confirmed_on'] = $service->booking_completion_admin_confirmed_on;

                    $i++;
                }

                if(!empty($result)) {
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
    
    /** Function to get Companies for New Service(Bookings).
     * @param null
     * @return JSON returns the JSON with Companies for New Service    
     */
    function _getCompaniesForService(){
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('booking_id', 'Booking Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $booking_id = $this->ci->input->post('booking_id', true);


                $booking_detail = $this->model->get_tb('mm_booking', 'booking_service_date', array('booking_id' => $booking_id))->result();


                if (!empty($booking_detail)) {

                    $result = $this->model->getAvailableCompaniesForService($booking_detail[0]->booking_service_date);

                    $this->_message = "";
                    $this->_status = true;
                    $this->_rdata = $result;
                } else {
                    $this->_message = $this->ci->lang->line('no_records_found');
                    $this->_status = false;
                }


            return $this->getResponse();
        }
    }
    
    /** Function to get Employees for New Job(Bookings).
     * @param null
     * @return JSON returns the JSON with Employees for New Job    
     */
    function _getEmployeesForService(){
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('bookingId', 'Booking Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('companyId', 'Company Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $booking_id = $this->ci->input->post('bookingId', true);
            $company_id = $this->ci->input->post('companyId', true);

            $company = $this->model->get_tb('mm_vendor_company', 'company_id', array('company_id' => $company_id))->result();

            if (!empty($company)) {

                $booking_detail = $this->model->get_tb('mm_booking', 'booking_service_date', array('booking_id' => $booking_id))->result();


                if (!empty($booking_detail)) {

                    $result = $this->model->getAvailableEmployees($company_id, $booking_detail[0]->booking_service_date);

                    $this->_message = "";
                    $this->_status = true;
                    $this->_rdata = $result;
                } else {
                    $this->_message = $this->ci->lang->line('no_records_found');
                    $this->_status = false;
                }
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('no_records_found');
            }

            return $this->getResponse();
        }
    }
    
    /** Function to assign Service to Employee/s.
    * @param null
    * @return JSON returns the JSON with service assign status    
    */
    function _assignEmployeesToService(){
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('employeeId', 'Employee Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('bookingId', 'Booking Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('companyId', 'Company Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $booking_id     = $this->ci->input->post('bookingId', true);
            $employee_id    = $this->ci->input->post('employeeId', true);
            $company_id     = $this->ci->input->post('companyId', true);

            $company = $this->model->get_tb('mm_vendor_company', '*', array('company_id' => $company_id))->result();

            if (!empty($company)) {

                $service_not_assigned = $this->model->check_booking_job_is_assigned($booking_id);

                if (!empty($service_not_assigned)) {
                    $this->model->update_tb('mm_booking', array('booking_id' => $booking_id), array('booking_vendor_company_id' => $company_id, 'booking_status' => Globals::BOOKING_CONFIRMED));
                    $job = array();
                    $job['employee_job_booking_id'] = $booking_id;
                    $job['employee_job_employee_id'] = $employee_id;
                    $job['employee_job_assigned_on'] = date('Y-m-d H:i:s', strtotime('now'));

                    $insert_id = $this->model->insert_tb('mm_employee_job', $job);
                    $booking_detail = $this->model->getServiceBookingDetail($booking_id, $company_id);
                    
                    $this->ci->email_lib->service_confirmation_mail_to_user($booking_detail[0]);
                                       
                    // SMS
                    $this->sendSMS("+60" . $booking_detail[0]->person_mobile, "Your Service request has been accepted by company: " . $company[0]->company_name);
                    /* Admin */ $this->sendSMS('+601124129717', "New Service request has been accepted by vendor: " . $company[0]->company_name . " of User: " . $booking_detail[0]->person_email);
                    /* Admin */ $this->sendSMS('+60146771436', "New Service request has been accepted by vendor: " . $company[0]->company_name . " of User: " . $booking_detail[0]->person_email);
                    /* Admin */ $this->sendSMS('+60125918491', "New Service request has been accepted by vendor: " . $company[0]->company_name . " of User: " . $booking_detail[0]->person_email);
                    /* Admin */ $this->sendSMS('+60126570387', "New Service request has been accepted by vendor: " . $company[0]->company_name . " of User: " . $booking_detail[0]->person_email);


                    $this->_message = $this->ci->lang->line('service_assigned_successfully');
                    $this->_status = true;
                    $this->_rdata = $insert_id;
                } else {
                    $this->_message = $this->ci->lang->line('service_already_assigned');
                    $this->_status = false;
                }
            } else {
                $this->_status = false;
                $this->_message = $this->ci->lang->line('invalid_user');
            }

            return $this->getResponse();
        }
    }
    
    /** Function to list vendor Withdrawal request.
    * @param null
    * @return JSON returns the JSON vendor Withdrawal request    
    */
    function _vendorsWithdrawalRequestList(){
        $this->resetResponse();
        if($this->ci->session->userdata('user_id') != null){

                $requests = $this->model->getVendorWithdrawalRequest();
                
                if($requests) {
                    $result = array();
                    $i = 0;
                    foreach ($requests as $request) {
                        $result[$i]['vendor_wallet_withdrawal_vendor_id']   = $request->vendor_wallet_withdrawal_vendor_id;
                        $result[$i]['vendor_wallet_withdrawal_request_on']  = $request->vendor_wallet_withdrawal_request_on;
                        $result[$i]['vendor_wallet_withdrawal_amount']      = $request->vendor_wallet_withdrawal_amount;
                        $result[$i]['vendor_full_name']                     = $request->person_first_name . " ". $request->person_last_name;
                        $result[$i]['vendor_company']                       = $request->company_name;
                        $result[$i]['vendor_wallet_amount']                 = $request->person_wallet_amount;
                        $result[$i]['vendor_wallet_withdrawal_id']          = $request->vendor_wallet_withdrawal_id;
                        $result[$i]['vendor_wallet_withdrawal_approval_status'] = $request->vendor_wallet_withdrawal_approval_status;
                        $result[$i]['vendor_wallet_withdrawal_approved_on'] = $request->vendor_wallet_withdrawal_approved_on;
                        
                        $i++;
                    }
                    $this->_status = true;
                    $this->_rdata = $result;
                }else{
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('no_records_found');
                }
            
        }else{
            $this->_status = false;
            $this->_message = $this->ci->lang->line('invalid_user');
        }
        
        return $this->getResponse();
    }
    
    
    function _approveWithdrawalRequest(){
        $this->ci->load->library('form_validation');
        
        $this->resetResponse();

        $this->ci->form_validation->set_rules('withdrawId', 'Withdrawal Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $withdraw_id = $this->ci->input->post('withdrawId', true);


            $withdraw_detail = $this->model->get_tb('mm_vendor_wallet_withdrawal', '*', array('vendor_wallet_withdrawal_id' => $withdraw_id))->result();
            
            if (!empty($withdraw_detail)) {
                $vendor_person_id = $withdraw_detail[0]->vendor_wallet_withdrawal_vendor_id;
                $vendor_detail = $this->model->get_tb('mm_person', '*', array('person_id' => $vendor_person_id))->result();
                
                if(!empty($vendor_detail)){
                    if($vendor_detail[0]->person_wallet_amount >= $withdraw_detail[0]->vendor_wallet_withdrawal_amount){
                        
                        $now = date('Y-m-d H:i:s', strtotime('now'));
                        
                        $this->updateVendorWallet($withdraw_detail[0]->vendor_wallet_withdrawal_amount, $withdraw_id, Globals::WALLET_DEBIT, $vendor_person_id, "Wallet Withdrawal Request");
                        $this->model->update_tb('mm_vendor_wallet_withdrawal', array('vendor_wallet_withdrawal_id' => $withdraw_id), array('vendor_wallet_withdrawal_approval_status' => Globals::WALLET_WITHDRAWAL_REQUEST_APPROVED, 'vendor_wallet_withdrawal_approved_on' => $now));
                        
                        if ($this->model->getAffectedRowCount() > 0) {
                            
                            //Send Emails to Vendor 
                            //$this->ci->email_lib->order_completion_confirmation_mail($info[0]->person_email, $info[0]);
                            $this->ci->email_lib->withdrawal_approval_mail_to_vendor($vendor_detail[0]->person_email, $withdraw_detail[0], $withdraw_detail[0]->vendor_wallet_withdrawal_amount);

                            $this->_status = true;
                            $this->_message = $this->ci->lang->line('withdrawal_request_approved');
                        } else {
                            $this->_status = false;
                            $this->_message = $this->ci->lang->line('no_changes_to_update');
                        }
                    }else{
                        $this->_message = $this->ci->lang->line('wallet_balance_low_than_requested');
                        $this->_status = false;
                    }
                    
                }else {
                    $this->_message = $this->ci->lang->line('no_records_found');
                    $this->_status = false;
                }

            } else {
                $this->_message = $this->ci->lang->line('no_records_found');
                $this->_status = false;
            }


            return $this->getResponse();
        }
    }
    
    
    function _rejectWithdrawalRequest(){
        $this->ci->load->library('form_validation');
        
        $this->resetResponse();

        $this->ci->form_validation->set_rules('withdrawId', 'Withdrawal Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $withdraw_id = $this->ci->input->post('withdrawId', true);


            $withdraw_detail = $this->model->get_tb('mm_vendor_wallet_withdrawal', '*', array('vendor_wallet_withdrawal_id' => $withdraw_id))->result();
            
            if (!empty($withdraw_detail)) {
                $vendor_person_id = $withdraw_detail[0]->vendor_wallet_withdrawal_vendor_id;
                $vendor_detail = $this->model->get_tb('mm_person', '*', array('person_id' => $vendor_person_id))->result();
                
                if(!empty($vendor_detail)){

                    $now = date('Y-m-d H:i:s', strtotime('now'));

                    $this->model->update_tb('mm_vendor_wallet_withdrawal', array('vendor_wallet_withdrawal_id' => $withdraw_id), array('vendor_wallet_withdrawal_approval_status' => Globals::WALLET_WITHDRAWAL_REQUEST_REJECTED));

                    if ($this->model->getAffectedRowCount() > 0) {

                        //Send Emails to Vendor 
                        //$this->ci->email_lib->order_completion_confirmation_mail($info[0]->person_email, $info[0]);
                        $this->ci->email_lib->withdrawal_rejection_mail_to_vendor($vendor_detail[0]->person_email, $withdraw_detail[0]->vendor_wallet_withdrawal_amount);

                        $this->_status = true;
                        $this->_message = $this->ci->lang->line('withdrawal_request_rejected');
                    } else {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('no_changes_to_update');
                    }
                    
                }else {
                    $this->_message = $this->ci->lang->line('no_records_found');
                    $this->_status = false;
                }

            } else {
                $this->_message = $this->ci->lang->line('no_records_found');
                $this->_status = false;
            }


            return $this->getResponse();
        }
    }
}
