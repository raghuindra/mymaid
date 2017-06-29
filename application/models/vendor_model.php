<?php

class Vendor_model extends Mm_model{
    
    function __construct() {
        parent::__construct();
        $this->_table                               = 'mm_vendor';
        $this->_person_table                        = 'mm_person';
        $this->_country_table                       = 'mm_country';
        $this->_lang_table                          = 'mm_language';
        $this->_state_table                         = "mm_state";
        $this->_postcode_table                      = "mm_postcode";
        $this->_company_employees                   = "mm_company_employees";
        $this->_session                             = "mm_session";
        $this->_booking                             = "mm_booking";
        $this->_booking_addons                      = "mm_booking_addons";
        $this->_booking_spl_request                 = "mm_booking_spl_request";
        $this->_services                            = "mm_services";
        $this->_service_package                     = "mm_service_package";
        
    }
    
    function check_email($email)
    {
          return $this->db->select('user_email')
                    ->from($this->_table)
                    ->where('vendor_email',$email)
                    ->get()
                    ->result();


    }
    
    /* Get the states and state level infromation(Postalcode, area name) */
    function getStates($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_state_table.' as st', 'st.state_code = pt.state_code','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_postcode_table.' as pt', $row_count, $offset);
        }
          return $this->db->get($this->_postcode_table.' as pt');
    }
    
    function get_postcodes($areacodes, $vendorId){
        return $this->db->query("SELECT DISTINCT(postcode) FROM mm_postcode where post_office IN (".$areacodes.")"
                . " AND postcode NOT IN (SELECT vendor_service_location_postcode FROM mm_vendor_service_location WHERE vendor_service_location_vendor_id = ".$vendorId.")");
    }
    
    function getCompanyEmployees($companyId, $archived){
        return $this->db->select('*')
                        ->from($this->_company_employees)
                        ->join($this->_session, 'session_id = employee_job_session_id','left')
                        ->where('employee_company_id', $companyId)
                        ->where('employee_archived', $archived)
                        ->get()
                        ->result();
    }
    
    function getServiceBookings($now){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person_table, 'person_id = booking_user_id','left')
                        ->where('booking_service_date >', $now)
                        ->where('booking_vendor_company_id IS NULL', null)             
                        ->where('booking_cancelled_by IS NULL', null)
                        ->where('booking_status', Globals::BOOKING_PROCESSING)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->get()
                        ->result();
    }
    
    function getVendorServiceBookings($companyId){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person_table, 'person_id = booking_user_id','left')
                        ->where('booking_vendor_company_id', $companyId)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where('booking_completion_company_confirmed', 0)
                        ->where('booking_completion_admin_confirmed', 0)
                        ->where('booking_cancelled_approved_by_admin', 0)
                        ->get()
                        ->result();
    }
    
    function getVendorCompletedServiceBookings($companyId){
        return $this->db->select('*')
                 ->from($this->_booking)
                 ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                 ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                 ->join($this->_services, 'service_id = booking_service_id','left')
                 ->join($this->_person_table, 'person_id = booking_user_id','left')
                 ->where('booking_vendor_company_id', $companyId)
                 ->where('booking_status', Globals::BOOKING_COMPLETED)
                 ->where('booking_completion_company_confirmed', 1)
                 ->where('booking_cancelled_approved_by_admin', 0)
                 ->get()
                 ->result(); 
    }
    
    
    function getVendorCanceledServiceBookings($companyId){
        return $this->db->select('*')
                 ->from($this->_booking)
                 ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                 ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                 ->join($this->_services, 'service_id = booking_service_id','left')
                 ->join($this->_person_table, 'person_id = booking_user_id','left')
                 ->where('booking_vendor_company_id', $companyId)
                 ->where('booking_status', Globals::BOOKING_CANCELLED)
                 ->where('booking_cancelled_by IS NOT NULL', null)
                 ->where('booking_completion_company_confirmed', 0)
                 ->where('booking_completion_admin_confirmed', 0)
                 ->get()
                 ->result(); 
    }
    
    
    function getServiceBookingDetail($bookingId){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person_table, 'person_id = booking_user_id','left')
                        ->where('booking_id ', $bookingId)
                        ->get()
                        ->result();
    }
    
    
    function getAvailableEmployees($companyId, $service_date){
        return $this->db->query("SELECT * FROM `mm_company_employees` "
                . " WHERE `employee_company_id`= '$companyId' AND `employee_archived` = '".Globals::UN_ARCHIVE."' AND employee_id NOT IN "
                . " ( SELECT employee_job_employee_id from mm_employee_job "
                . " LEFT JOIN mm_booking on employee_job_booking_id = booking_id "
                . " WHERE booking_service_date = '$service_date')")->result();
    }
    
    function check_booking_job_is_assigned($bookingId){
        return $this->db->query("SELECT * FROM `mm_booking` "
                . " WHERE `booking_id`= '$bookingId' AND `booking_vendor_company_id` IS NULL")->result();
        
    }
    
   
        
        
}
