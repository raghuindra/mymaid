<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_lib {

    var $model;

    function __construct() {
        $this->ci = &get_instance();
        $this->getModel();
    }

    function getModel() {
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
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";

        $response = array();
        if ($this->ci->session->userdata('user_id') != null) {
            $result = $this->model->get_tb('mm_services', 'service_id,service_name,service_created_on,service_updated_on,service_archived', array('service_archived'=>0))->result();
            if ($result) {
                $response = array(
                    'status' => true,
                    'message' => '',
                    'data' => $result
                );
                //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
            }else {
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
            //$this->ci->session->set_flashdata('error_message', $this->ci->lang->line('invalid_request'));                    
        }

        return $response;
    }
    
    function _archiveService(){
        
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();        
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $info = array();
            $service_id = $this->ci->input->post('serviceId', true);

            $result = $this->model->get_tb('mm_services', 'service_id', array('service_id' => $service_id))->result();
            if (!empty($result)) {
                $info['service_archived']    = Globals::ARCHIVE;               
                $info['service_updated_by'] = $person_id;

                $val = $this->model->update_tb('mm_services', array( 'service_id' => $service_id), $info);

                $response = array(
                    'status' => true,
                    'message' => $this->ci->lang->line('service_archived'),
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
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
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
                $result = $this->model->getServicePackages('*', array("service_package_service_id" => $serviceId, "service_package_archive"=>$archived))->result();

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
    
    
    function _archiveServicePackage(){
        
        $this->ci->data['success_message']  = "";
        $this->ci->data['error_message']    = "";
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
            $archive    = intval($this->ci->input->post('archive', true));
            
            $result = $this->model->get_tb('mm_service_package', 'service_package_id', array('service_package_id' => $package_id, 'service_package_service_id' => $service_id))->result();
            if (!empty($result)) {
                $info['service_package_archive']    = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE ;               
                $info['service_package_updated_by'] = $person_id;

                $val = $this->model->update_tb('mm_service_package', array('service_package_id' => $package_id, 'service_package_service_id' => $service_id), $info);
                $msg = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('service_package_archived') : $this->ci->lang->line('service_package_unarchived') ;
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

    
    function _createServiceFrequencyOfferPrice(){
        $this->ci->load->library('form_validation');
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $person_id = $this->ci->session->userdata('user_id');

        $response = array();

        $this->ci->form_validation->set_rules('add_frequency_service_id', 'Service Id', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('add_service_frequency', 'Service Frequency', 'trim|required|xss_clean|encode_php_tags', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('add_frequency_discount', 'Service Frequency Discount', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));

        
        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('service_name_missing');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $service_freq = $this->ci->input->post('add_service_frequency', true);
            $service_id   = $this->ci->input->post('add_frequency_service_id', true);
            
            $result = $this->model->get_tb('mm_service_frequency', 'service_frequency_id', array('service_frequency_id' => $service_freq))->result();
            
            if (!empty($result)) {
                
                $result = $this->model->get_tb('mm_services', 'service_id', array('service_id' => $service_id))->result();
                
                if(!empty($result)){
                    
                    if($this->checkFrequencyOfferAdded($service_freq, $service_id)){
                        return $response = array(
                            'status' => false,
                            'message' => $this->ci->lang->line('service_frequency_offer_already_created'),
                        );
                    }

                    $offerVal  = $this->ci->input->post('add_frequency_discount', true);
                    $insert_id = $this->createFrequencyOffer($service_freq, $service_id, $offerVal, $person_id);
                    
                    if ($insert_id > 0) {
                        $response = array(
                            'status' => true,
                            'message' => $this->ci->lang->line('service_frequency_offer_created'),
                        );
                        //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
                    }else{
                        $response = array(
                            'status' => false,
                            'message' => $this->ci->lang->line('something_problem'),
                        );
                    }
                }else{
                   $response = array(
                        'status' => false,
                        'message' => $this->ci->lang->line('invalid_data'),
                    ); 
                }
            } else {
                $response = array(
                    'status' => false,
                    'message' => $this->ci->lang->line('invalid_data'),
                );
                //$this->ci->session->set_flashdata('error_message', $this->ci->lang->line('service_name_already_available'));                    
            }

            return $response;
        }
        
    }
     
    
    function checkFrequencyOfferAdded($frequencyId, $serviceId){
        
        $result = $this->model->get_tb('mm_service_frequency_offer', 'service_frequency_offer_id', array('service_frequency_offer_frequency_id' => $frequencyId, 'service_frequency_offer_service_id'=>$serviceId, 'service_frequency_offer_archived'=>0))->result();
        if(!empty($result)){
            return true;
        } else{
            return false;           
        }       
    }
    
    function createFrequencyOffer($freqId, $serviceId, $offerVal, $person_id, $offerIn = Globals::FREQUENCY_OFFER_IN_PERCENTAGE ){
        $info = array();
        $info['service_frequency_offer_frequency_id']   = $freqId;
        $info['service_frequency_offer_service_id']     = $serviceId;
        $info['service_frequency_offer_value']          = $offerVal;
        $info['service_frequency_offer_in']             = $offerIn;
        $info['service_frequency_offer_created_on']     = date('Y-m-d H:i:s', strtotime('now'));
        $info['service_frequency_offer_created_by']     = $person_id;

        return $insert_id = $this->model->insert_tb('mm_service_frequency_offer', $info);
    }
    
    /* Function to check the Offer history available in User service booking*/
    function checkFrequencyOfferHistoryAvailable(){
        return false;
    }
            
    function _getFrequencyOfferList($serviceId){
        
        $this->ci->data['success_message'] = "";
        $this->ci->data['error_message'] = "";
        $archived = 0;
        $response = array();
        if ($this->ci->session->userdata('user_id') != null) {
            $archived = $this->ci->input->post('archived', true);
            $result = $this->model->getFrequencyOfferPriceList('*', array('service_frequency_offer_service_id'=>$serviceId,'service_frequency_offer_archived'=>$archived))->result();
            if ($result) {
                $response = array(
                    'status' => true,
                    'message' => '',
                    'data' => $result
                );
                //$this->ci->session->set_flashdata('success_message', $this->ci->lang->line('service_name_inserted'));                    
            }else {
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
            //$this->ci->session->set_flashdata('error_message', $this->ci->lang->line('invalid_request'));                    
        }

        return $response;
        
    }
    
    function _archiveServiceFrequencyOffer(){
        $this->ci->data['success_message']  = "";
        $this->ci->data['error_message']    = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
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
            $freqOffer_id   = $this->ci->input->post('freqOfferId', true);
            $freqId         = $this->ci->input->post('frequencyId', true);
            $service_id     = $this->ci->input->post('serviceId', true);
            $archive        = intval($this->ci->input->post('archive', true));
            
            $result = $this->model->get_tb('mm_service_frequency_offer', 'service_frequency_offer_id', array('service_frequency_offer_id' => $freqOffer_id, 'service_frequency_offer_frequency_id' => $freqId, 'service_frequency_offer_service_id'=>$service_id))->result();
            if (!empty($result)) {
                
                $msg = $this->archiveFrequencyOffer($freqOffer_id, $freqId, $service_id, $archive, $person_id);
         
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
    
    
    /*  */
    function archiveFrequencyOffer($freqOffer_id, $freqId, $service_id, $archive, $person_id ){
        $info['service_frequency_offer_archived']    = ($archive == Globals::ARCHIVE) ? Globals::ARCHIVE : Globals::UN_ARCHIVE ;               
        $info['service_frequency_offer_updated_by'] = $person_id;

        $this->model->update_tb('mm_service_frequency_offer', array('service_frequency_offer_id' => $freqOffer_id, 'service_frequency_offer_frequency_id' => $freqId, 'service_frequency_offer_service_id'=>$service_id), $info);
        return $msg = ($archive == Globals::ARCHIVE) ? $this->ci->lang->line('service_frequency_offer_archived') : $this->ci->lang->line('service_frequency_offer_unarchived') ;
        
    }


    /*   */
    function _updateServiceFrequencyOffer(){
        
        $this->ci->data['success_message']  = "";
        $this->ci->data['error_message']    = "";
        $person_id = $this->ci->session->userdata('user_id');

        $this->ci->load->library('form_validation');

        $response = array();
        $this->ci->form_validation->set_rules('freqOfferId', 'Service Frequency Offer Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('serviceId', 'Service Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('frequencyId', 'Service Frequency Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));
        $this->ci->form_validation->set_rules('offerVal', 'Offer Discount Value', 'trim|required|xss_clean|encode_php_tags|numeric', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            $this->ci->data['error_message'] = $this->ci->lang->line('Validation_error');
            //$this->ci->session->set_flashdata('error_message', $this->ci->data['error_message']);
            return $response = array('status' => false, 'message' => $this->ci->data['error_message']);
        } else {

            $info = array();
            $freqOffer_id   = $this->ci->input->post('freqOfferId', true);
            $freqId         = $this->ci->input->post('frequencyId', true);
            $service_id     = $this->ci->input->post('serviceId', true);
            $offerVal        = intval($this->ci->input->post('offerVal', true));
            
            $result = $this->model->get_tb('mm_service_frequency_offer', 'service_frequency_offer_id', array('service_frequency_offer_id' => $freqOffer_id, 'service_frequency_offer_frequency_id' => $freqId, 'service_frequency_offer_service_id'=>$service_id))->result();
            if (!empty($result)) {
                
                if(!$this->checkFrequencyOfferHistoryAvailable()){
                    $info['service_frequency_offer_value']      = $offerVal;               
                    $info['service_frequency_offer_updated_by'] = $person_id;

                    $this->model->update_tb('mm_service_frequency_offer', array('service_frequency_offer_id' => $freqOffer_id, 'service_frequency_offer_frequency_id' => $freqId, 'service_frequency_offer_service_id'=>$service_id), $info);
                    
                    $response = array(
                        'status' => true,
                        'message' => $this->ci->lang->line('service_frequency_offer_updated'),
                    );
                }else{
                    
                    $msg = $this->archiveFrequencyOffer($freqOffer_id, $freqId, $service_id, Globals::ARCHIVE, $person_id);
                    $insert_id = $this->createFrequencyOffer($freqId, $service_id, $offerVal, $person_id);
                    
                    if($insert_id >0){
                        $response = array(
                            'status' => false,
                            'message' => $msg,
                        );
                    }
                }
                
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
    
    
}
