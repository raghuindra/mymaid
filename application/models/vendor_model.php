<?php

class Vendor_model extends Mm_model{
    
    function __construct() {
        parent::__construct();
        $this->_table                               = 'mm_vendor';

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
        $this->db->join($this->_state.' as st', 'st.state_code = pt.state_code','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_postcode.' as pt', $row_count, $offset);
        }
          return $this->db->get($this->_postcode.' as pt');
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
    
    function getServiceBookings_old($now){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_booking_frequency, 'booking_frequency_booking_id = booking_id','left') 
                        ->join($this->_service_frequency_offer, 'service_frequency_offer_id = booking_frequency_frequency_offer_id','left')
                        ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                        //->where('booking_service_date >', $now)
                        ->where('booking_vendor_company_id IS NULL', null)             
                        ->where('booking_cancelled_by IS NULL', null)
                        ->where('booking_status', Globals::BOOKING_PROCESSING)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }

    function getServiceBookings($now, $vendor_id){
            return $this->db->query("SELECT * FROM `mm_booking` LEFT JOIN `mm_booking_addons` ON `booking_addons_booking_id` = `booking_id` LEFT JOIN `mm_booking_spl_request` ON `booking_spl_request_booking_id` = `booking_id` LEFT JOIN `mm_services` ON `service_id` = `booking_service_id` LEFT JOIN `mm_person` ON `person_id` = `booking_user_id` LEFT JOIN `mm_booking_frequency` ON `booking_frequency_booking_id` = `booking_id` LEFT JOIN `mm_service_frequency_offer` ON `service_frequency_offer_id` = `booking_frequency_frequency_offer_id` LEFT JOIN `mm_service_frequency` ON `service_frequency_id` = `service_frequency_offer_frequency_id` WHERE `booking_vendor_company_id` IS NULL AND `booking_cancelled_by` IS NULL AND `booking_status` = 2 AND `booking_payment_status` = 1 
AND `booking_pincode` IN ( SELECT `vendor_service_location_postcode` from `mm_vendor_service_location` WHERE `vendor_service_location_vendor_id` = '$vendor_id' AND `vendor_service_location_archived` = 0) GROUP BY `booking_id` ORDER BY `booking_id` DESC")->result();
    }
    
    function getVendorServiceBookings($companyId){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_booking_frequency, 'booking_frequency_booking_id = booking_id','left') 
                        ->join($this->_service_frequency_offer, 'service_frequency_offer_id = booking_frequency_frequency_offer_id','left')
                        ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                        ->where('booking_vendor_company_id', $companyId)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where('booking_completion_company_confirmed', 0)
                        ->where('booking_completion_admin_confirmed', 0)
                        ->where('booking_cancelled_approved_by_admin', 0)
                        ->group_by('booking_id')
                        ->order_by("booking_id", "DESC")
                        ->get()
                        ->result();
    }
    
    function getVendorCompletedServiceBookings($companyId){
        return $this->db->select('*')
                 ->from($this->_booking)
                 ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                 ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                 ->join($this->_services, 'service_id = booking_service_id','left')
                 ->join($this->_person, 'person_id = booking_user_id','left')
                ->join($this->_booking_frequency, 'booking_frequency_booking_id = booking_id','left') 
                ->join($this->_service_frequency_offer, 'service_frequency_offer_id = booking_frequency_frequency_offer_id','left')
                ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                 ->where('booking_vendor_company_id', $companyId)
                 ->where('booking_status', Globals::BOOKING_COMPLETED)
                 ->where('booking_completion_company_confirmed', 1)
                 ->where('booking_cancelled_approved_by_admin', 0)
                 ->group_by('booking_id')
                 ->order_by("booking_id", "DESC")
                 ->get()
                 ->result(); 
    }
    
    
    function getVendorCanceledServiceBookings($companyId){
        return $this->db->select('*')
                 ->from($this->_booking)
                 ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                 ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                 ->join($this->_services, 'service_id = booking_service_id','left')
                 ->join($this->_person, 'person_id = booking_user_id','left')
                ->join($this->_booking_frequency, 'booking_frequency_booking_id = booking_id','left') 
                ->join($this->_service_frequency_offer, 'service_frequency_offer_id = booking_frequency_frequency_offer_id','left')
                ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                 ->where('booking_vendor_company_id', $companyId)
                 ->where('booking_status', Globals::BOOKING_CANCELLED)
                 ->where('booking_cancelled_by IS NOT NULL', null)
                 ->where('booking_completion_company_confirmed', 0)
                 ->where('booking_completion_admin_confirmed', 0)
                 ->group_by('booking_id')
                 ->order_by("booking_id", "DESC")
                 ->get()
                 ->result(); 
    }
    
    
    function getServiceBookingDetail($bookingId){
        return $this->db->select('*')
                        ->from($this->_booking)
//                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
//                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_vendor_company, "company_id = booking_vendor_company_id", 'left')
                        ->where('booking_id ', $bookingId)
                        ->group_by('booking_id')       
                        ->get()
                        ->result();
    }
    
    
    function getAvailableEmployees($companyId, $booking_id){
        return $this->db->query("SELECT * FROM `mm_company_employees` "
                . " WHERE `employee_company_id`= '$companyId' AND `employee_archived` = '".Globals::UN_ARCHIVE."' AND `employee_id` NOT IN "
                . " ( SELECT `employee_job_employee_id` from `mm_employee_job` "
                . " LEFT JOIN `mm_booking` on `employee_job_booking_id` = `booking_id` "
                . " LEFT JOIN `mm_booking_sessions` on `booking_sessions_booking_id` = `booking_id` "
                . " WHERE `booking_sessions_service_date` IN(SELECT `booking_sessions_service_date` 
                                               FROM `mm_booking_sessions` WHERE `booking_sessions_booking_id` = '$booking_id'))")->result();
    }
    
    function check_booking_job_is_assigned($bookingId){
        return $this->db->query("SELECT * FROM `mm_booking` "
                . " WHERE `booking_id`= '$bookingId' AND `booking_vendor_company_id` IS NULL")->result();
        
    }
    
    function getLastDateofServiceDate($booking_id){
        return $this->db->query("SELECT MAX(`booking_sessions_service_date`) as `service_date` FROM `mm_booking_sessions` WHERE `booking_sessions_booking_id` = '$booking_id' ")->result();
    }
    
    /*
    * SQL to get the Employees who has got/free for the said day of booking with full day or exact same session id.
    * Parameters:: Day of week, Date and session id
    */
    function getEmployeeSessionAndDayAvailability($day, $sessionId, $company_id){
        
        $query = "SELECT employee_id, employee_name FROM mm_company_employees 
                                WHERE employee_id IN (SELECT employee_session_employee_id 
                                                FROM mm_employee_session 
                                                WHERE employee_session_".$day." = 1 OR employee_session_".$day." = $sessionId)
                                                AND employee_company_id = '$company_id' AND `employee_archived` = '".Globals::UN_ARCHIVE."'";
        
        return $this->db->query($query)->result();
        
    }
    
    /*
    * SQL to get the employee who has spl session on service date
    */
    function getEmployeeWhoGotSplSession($date, $company_id){
        return $this->db->query("SELECT employee_id, employee_name FROM mm_company_employees
                            WHERE employee_id IN (SELECT employee_session_spl_employee_id 
                                                FROM mm_employee_session_spl
                                                WHERE employee_session_spl_off_status = 0
                                                AND '$date' BETWEEN employee_session_spl_date_from AND employee_session_spl_date_to) AND employee_company_id = '$company_id' AND `employee_archived` = '".Globals::UN_ARCHIVE."'")->result();
    }
    
    /*
    * SQL to get the employee who has spl session on service date
    */
    function getEmployeeWhoGotSplSessionHoliday($date, $company_id){
        return $this->db->query("SELECT employee_id, employee_name FROM mm_company_employees
                            WHERE employee_id IN (SELECT employee_session_spl_employee_id 
                                                FROM mm_employee_session_spl
                                                WHERE employee_session_spl_off_status = 1
                                                AND '$date' BETWEEN employee_session_spl_date_from AND employee_session_spl_date_to) AND employee_company_id = '$company_id' AND `employee_archived` = '".Globals::UN_ARCHIVE."'")->result();
    }
    
    /*
    * SQL to get the Employees who has got/free for the said day of booking with full day as a default and they dont have any spl * session assigned.
    * Parameters:: Day of week, Date and session id
    */
    function getEmployeeSplSessionAvailability( $date, $sessionId, $company_id){
        
        return $this->db->query("SELECT employee_id, employee_name FROM mm_company_employees
                            WHERE employee_id IN (SELECT employee_session_spl_employee_id 
                                                FROM mm_employee_session_spl
                                                WHERE employee_session_spl_off_status = 0
                                                AND '$date' BETWEEN employee_session_spl_date_from AND employee_session_spl_date_to AND (employee_session_spl_session_id = 1
                                                OR employee_session_spl_session_id = $sessionId))
                            AND employee_job_session_id = 1 AND employee_company_id = '$company_id' AND `employee_archived` = '".Globals::UN_ARCHIVE."'")->result();
        
    }
    
    /*
    * SQL to get the employees who has assigned job on the perticular date.
    */
    function getEmployeeAssignedJob($date, $company_id){
        
        return $this->db->query("SELECT DISTINCT(employee_job_employee_id) as `employee_id`, `employee_name`
                            FROM `mm_employee_job`
                            LEFT JOIN `mm_booking_sessions` ON `booking_sessions_id` = `employee_job_booking_sessions_id`
                            LEFT JOIN `mm_booking` ON `booking_id` = `booking_sessions_booking_id`
                            LEFT JOIN `mm_company_employees` ON `employee_id` = `employee_job_employee_id`
                            WHERE `booking_sessions_service_date` = '$date' AND `employee_company_id` = $company_id AND `booking_status` != '".Globals::BOOKING_CANCELLED."'")->result();
    }
    
    /*
    * SQL to get the employees who's company serving for the postcode location.
    */
    function getEmployeeServingForLocation($employeesStr, $postcode, $company_id){
        return $this->db->query("SELECT `employee_id`, `employee_name`
                                FROM `mm_company_employees`
                                LEFT JOIN `mm_vendor_company` AS `vc` ON `company_id` = `employee_company_id`
                                LEFT JOIN `mm_vendor_service_location` AS `vsl` ON `vsl`.`vendor_service_location_vendor_id` = `vc`.`company_person_id`
                                WHERE `vsl`.`vendor_service_location_postcode` = '$postcode' AND `employee_company_id` = '$company_id' AND `employee_archived` = '".Globals::UN_ARCHIVE."'
                                AND `employee_id` IN ($employeesStr)")->result();
    }
    
    function _getBookingSessionDetail($booking_id){
        return $this->db->query("SELECT * from mm_booking_sessions LEFT JOIN mm_session ON session_id = booking_sessions_session_id WHERE booking_sessions_booking_id = $booking_id")->result();
    }


    function checkVendorServiceBookingsForPostcode($companyId, $pincode){
    return $this->db->select('*')
                    ->from($this->_booking)
                    ->where('booking_vendor_company_id', $companyId)
                    ->where('booking_pincode', $pincode)
                    ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                    ->where('booking_completion_company_confirmed', 0)
                    ->where('booking_completion_admin_confirmed', 0)
                    ->where('booking_cancelled_approved_by_admin', 0)
                    ->group_by('booking_id')
                    ->order_by("booking_id", "DESC")
                    ->get()
                    ->result();
    }
        
        
}
