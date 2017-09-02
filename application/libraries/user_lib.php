<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'libraries/Base_lib.php';

class User_lib extends Base_lib {

    var $model;

    function __construct() {
        $this->ci = &get_instance();
        $this->getModel();
    }

    function getModel() {
        $this->ci->load->model('user_model');
        $this->model = $this->ci->user_model;
    }

    function get_user() {
        $user_id = $this->ci->session->userdata('user_id');
        return $this->model->get_user_data($user_id);
    }

    function check_user_email($email) {

        $checkemail = $this->model->check_email($email);
        if (!empty($checkemail)) {
            return FALSE;
        } else {
            return TRUE;
        }
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

    /**
     *
     * Create new user in the Db 
     *
     * @param	array	$data	array of person data
     * @param 	array 	$condition multiple conditions in array format
     * @return	nil
     */
    function _create_user($user_data) {

        $person_id = $this->model->insert($user_data);
        return $person_id;
    }

    function _listActiveOrders() {

        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');


            $activeServices = $this->model->getUserActiveBookings($person_id);
            //print_r($this->model->last_query()); exit;

            if (!empty($activeServices)) {
                $result = array();
                $i = 0;
                foreach ($activeServices as $service) {
                    $result[$i]['booking_id'] = $service->booking_id;
                    $result[$i]['booking_pincode'] = $service->booking_pincode;
                    $result[$i]['company_name'] = $service->company_name;
                    $result[$i]['company_landphone'] = $service->company_landphone;
                    $result[$i]['service_name'] = $service->service_name;
                    $result[$i]['booking_service_date'] = $service->booking_service_date;
                    $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                    $result[$i]['booking_status'] = $service->booking_status;
                    $result[$i]['booking_amount'] = $service->booking_amount;
                    $result[$i]['employee_name'] = $service->employee_name;
                    $result[$i]['employee_id'] = $service->employee_id;
                    
                    $now = date('Y-m-d H:i:s');
                    $cancelableDate = date('Y-m-d H:i:s', strtotime($service->booking_booked_on . ' +1 day'));
                    $service_date = date('Y-m-d H:i:s', strtotime($service->booking_service_date));
                    if (strtotime($now) < strtotime($cancelableDate)) {
                        $result[$i]['booking_cancelable'] = true;
                    } else {
                        $result[$i]['booking_cancelable'] = false;
                    }
                    
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

    /** Function to List the Cancelled Orders.
    * @param null
    * @return JSON returns the JSON with Cancelled Orders list.    
    */
    function _listCanceledOrders() {

        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');


            $activeServices = $this->model->getUserCanceledBookings($person_id);
            //print_r($activeServices); exit;

            if (!empty($activeServices)) {
                $result = array();
                $i = 0;
                foreach ($activeServices as $service) {
                    $result[$i]['booking_id'] = $service->booking_id;
                    $result[$i]['booking_pincode'] = $service->booking_pincode;
                    $result[$i]['company_name'] = $service->company_name;
                    $result[$i]['company_landphone'] = $service->company_landphone;
                    $result[$i]['service_name'] = $service->service_name;
                    $result[$i]['booking_service_date'] = $service->booking_service_date;
                    $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                    $result[$i]['booking_status'] = $service->booking_status;
                    $result[$i]['booking_amount'] = $service->booking_amount;
                    $result[$i]['booking_cancelled_on'] = $service->booking_cancelled_on;
                    $result[$i]['booking_cancelled_by'] = $service->booking_cancelled_by;
                    if($service->booking_cancelled_by == $this->ci->session->userdata('user_id')){
                        $result[$i]['booking_cancelation_request_sent_from'] = 'Self';
                    }else{
                        $result[$i]['booking_cancelation_request_sent_from'] = 'Admin';
                    }
                    $result[$i]['booking_cancelled_approved_by_admin'] = $service->booking_cancelled_approved_by_admin;
                    $result[$i]['booking_cancelled_approved_by_admin_on'] = $service->booking_cancelled_approved_by_admin_on;
                    
                    $result[$i]['employee_name'] = $service->employee_name;
                    $result[$i]['employee_id'] = $service->employee_id;
                    
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

    function _cancelUserOrder() {
        $this->ci->load->library('form_validation');
        $person_id = $this->ci->session->userdata('user_id');
        $this->resetResponse();

        $this->ci->form_validation->set_rules('bookingId', 'Booking Id', 'trim|required|xss_clean|encode_php_tags|integer', array('required' => 'You must provide a %s.'));

        if ($this->ci->form_validation->run() == FALSE) {
            return array('status' => false, 'message' => $this->ci->lang->line('Validation_error'));
        } else {

            $booking_id = $this->ci->input->post('bookingId', true);


            $booking_detail = $this->model->get_tb('mm_booking', 'booking_service_date, booking_booked_on', array('booking_id' => $booking_id))->result();

            if (!empty($booking_detail)) {
                $now = date('Y-m-d H:i:s');
                $cancelableDate = date('Y-m-d H:i:s', strtotime($booking_detail[0]->booking_booked_on . ' +1 day'));
                if (strtotime($now) < strtotime($cancelableDate)) {

                    $this->model->update_tb('mm_booking', array('booking_id' => $booking_id), array('booking_status' => Globals::BOOKING_CANCELLED, 'booking_cancelled_by' => $person_id, 'booking_cancelled_on' => $now));
                    if ($this->model->getAffectedRowCount() > 0) {
                        
                        $info = $this->model->getServiceBookingDetail($booking_id);
                        $this->ci->email_lib->order_cancelation_request_mail($info[0]->person_email, $info[0]);
                        
                        $this->_status = true;
                        $this->_message = $this->ci->lang->line('order_canceled_successfully');
                    } else {
                        $this->_status = false;
                        $this->_message = $this->ci->lang->line('no_changes_to_update');
                    }
                } else {
                    $this->_status = false;
                    $this->_message = $this->ci->lang->line('cancelation_time_expired');
                }
            } else {
                $this->_message = $this->ci->lang->line('no_records_found');
                $this->_status = false;
            }


            return $this->getResponse();
        }
    }
    
    
    function _listCompletedOrders(){
        $this->resetResponse();

        if ($this->ci->session->userdata('user_id') != null) {
            $person_id = $this->ci->session->userdata('user_id');


            $completedServices = $this->model->getUserCompletedBookings($person_id);
            //print_r($activeServices); exit;

            if (!empty($completedServices)) {
                $result = array();
                $i = 0;
                foreach ($completedServices as $service) {
                    $result[$i]['booking_id'] = $service->booking_id;
                    $result[$i]['booking_pincode'] = $service->booking_pincode;
                    $result[$i]['company_name'] = $service->company_name;
                    $result[$i]['company_landphone'] = $service->company_landphone;
                    $result[$i]['service_name'] = $service->service_name;
                    $result[$i]['booking_service_date'] = $service->booking_service_date;
                    $result[$i]['booking_booked_on'] = $service->booking_booked_on;
                    $result[$i]['booking_status'] = $service->booking_status;
                    $result[$i]['booking_amount'] = $service->booking_amount;
                    $result[$i]['booking_cancelled_on'] = $service->booking_cancelled_on;
                    $result[$i]['employee_name'] = $service->employee_name;
                    $result[$i]['employee_id'] = $service->employee_id;
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

                $lastServiceDate = $this->model->getLastDateofServiceDate($booking_id);

                if(strtotime($now) >= strtotime($lastServiceDate[0]->service_date) && $booking_detail[0]->booking_vendor_company_id != null && ( $booking_detail[0]->booking_status == Globals::BOOKING_CONFIRMED || $booking_detail[0]->booking_status == Globals::BOOKING_COMPLETED) ){
                    
                    $this->model->update_tb('mm_booking', array('booking_id' => $booking_id), array('booking_status' => Globals::BOOKING_COMPLETED, 'booking_completion_user_comfirmed' => 1));
                    if ($this->model->getAffectedRowCount() > 0) {
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

    function _getOrderInvoice(){
        
    }
}
