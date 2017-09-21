<?php

class Booking_model extends Mm_model {

    function __construct() {
        parent::__construct();
        $this->_table       = 'mm_user';
    }

    
    function check_email($email) {
        return $this->db->select('user_email')
                        ->from($this->_table)
                        ->where('user_email', $email)
                        ->get()
                        ->result();
    }
    
    
    function getServicePackages($serviceIds){
        return $this->db->select('*')
                        ->from($this->_service_package)
                        ->join($this->_building, 'building_id = service_package_building_id','left')
                        ->join($this->_area, 'area_id = service_package_building_area_id','left')
                        ->where('service_package_archive', Globals::UN_ARCHIVE)
                        ->where_in('service_package_service_id', $serviceIds)
                        ->get()
                        ->result();
        
    }
    
    
    function getPackagePostcodePrice($packageId, $postcode){
        return $this->db->select('*')
                        ->from($this->_postcode_service_price)                       
                        ->where('postcode_service_archived', Globals::UN_ARCHIVE)
                        ->where('postcode_service_price_package_id', $packageId)
                        ->where('postcode_service_price_postcode', $postcode)
                        ->get()
                        ->result();
    }
            
    function getServiceFrequencies($serviceIds){
        return $this->db->select('*')
                        ->from($this->_service_frequency_offer)
                        ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                        ->where('service_frequency_offer_archived', Globals::UN_ARCHIVE)
                        ->where('service_frequency_archived', Globals::UN_ARCHIVE)
                        ->where_in('service_frequency_offer_service_id', $serviceIds)
                        ->get()
                        ->result();
    }
    
    function getServiceAddons($serviceIds){
        return $this->db->select('*')
                        ->from($this->_service_addon_price)
                        ->join($this->_service_addon, 'service_addon_id = service_addon_price_addon_id','left')
                        ->where('service_addon_price_archived', Globals::UN_ARCHIVE)
                        ->where('service_addon_archived', Globals::UN_ARCHIVE)
                        ->where_in('service_addon_price_service_id', $serviceIds)
                        ->get()
                        ->result();
    }
    
    function getServiceSplRequests($serviceIds){
        
        return $this->db->select('*')
                        ->from($this->_service_spl_request)
                        ->join($this->_spl_request, 'spl_request_id = service_spl_request_spl_request_id','left')
                        ->where('service_spl_request_archived', Globals::UN_ARCHIVE)
                        ->where('spl_request_archived', Globals::UN_ARCHIVE)
                        ->where_in('service_spl_request_service_id', $serviceIds)
                        ->get()
                        ->result();
    }
    
    
    function getVendorAndServiceDetails($pincode){
        return $this->db->select('*')
                        ->from($this->_vendor_service_location)
                        ->join($this->_person, 'vendor_service_location_vendor_id = person_id','left')
                        ->where('vendor_service_location_postcode', $pincode)
                        ->where('vendor_service_location_archived', Globals::UN_ARCHIVE)
                        ->get()
                        ->result();
    }
    
    function getUserDetails($fields = 'person_id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_table, 'user_person_id = person_id','left');
        $this->db->join($this->_person_type, 'person_type_id = person_type','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0)
                return $this->db->get($this->_person, $row_count, $offset);
          return $this->db->get($this->_person);
         //$this->db->last_query();
    }
    
    function getServiceBookingDetail($bookingId){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_booking_user_detail, 'booking_user_detail_booking_id = booking_id', 'left')
                        ->where('booking_id ', $bookingId)
                        ->get()
                        ->result();
    }
    
    
    function get_freqDetail($freq_offer_id){
        return $this->db->select('*')
                        ->from($this->_service_frequency_offer)
                        ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                        ->where('service_frequency_offer_id ', $freq_offer_id)
                        ->get()
                        ->result();
        
    }
    
    
    function getServiceOrderDetails($booking_id){
        
        return $this->db->select('*')
                        ->from($this->_booking)                     
                        ->join($this->_booking_user_detail, 'booking_user_detail_booking_id = booking_id','left')
                        ->join($this->_state, 'state_code = booking_user_detail_state','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_service_package, 'service_package_id = booking_package_id','left')
                        ->join($this->_service_building, 'building_id = service_package_building_id','left')
                        ->join($this->_service_area, 'area_id = service_package_building_area_id','left')
                        ->join($this->_booking_frequency, 'booking_frequency_booking_id = booking_id','left') 
                        ->join($this->_service_frequency_offer, 'service_frequency_offer_id = booking_frequency_frequency_offer_id','left')
                        ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        //->join($this->_person, 'person_id = booking_user_id','left')
                        ->where('booking_id', $booking_id)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
        
    }
    
    function getBookingAddonDetails($booking_id){
        return $this->db->select('*')
                        ->from($this->_booking)                       
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_service_addon_price, 'service_addon_price_id = booking_addons_addon_price_id', 'left')
                        ->join($this->_service_addon, 'service_addon_id = service_addon_price_addon_id', 'left')                       
                        ->where('booking_id', $booking_id)
                        ->get()
                        ->result();
    }
    
    function getBookingSessionDateDetails($booking_id){
        return $this->db->select('*')
                        ->from($this->_booking)                       
                        ->join($this->_booking_sessions, 'booking_sessions_booking_id = booking_id','left')
                        ->join($this->_session, 'session_id = booking_sessions_session_id','left')                      
                        ->where('booking_id', $booking_id)
                        ->get()
                        ->result();
    }
    
    function getBookingSplRequestDetails($booking_id){
        return $this->db->select('*')
                        ->from($this->_booking)                       
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_service_spl_request, 'service_spl_request_id = booking_spl_request_service_spl_request_id','left')
                        ->join($this->_spl_request, 'spl_request_id = service_spl_request_spl_request_id','left')                      
                        ->where('booking_id', $booking_id)
                        ->get()
                        ->result();
    }
    
    
    function getEmployeeDetails($bookingId){
        return $this->db->select('booking_sessions_id, booking_sessions_service_date, employee_job_employee_id, employee_name')
                        ->from($this->_employee_job)     
                        ->join($this->_booking_sessions, 'booking_sessions_id = employee_job_booking_sessions_id','left')
                        ->join($this->_company_employees, 'employee_id = employee_job_employee_id','left')
                        ->where('employee_job_booking_id', $bookingId)
                        ->where('booking_sessions_booking_id', $bookingId)
                        ->get()
                        ->result();
    }
    
    /*
    * SQL to get the Employees who has got/free for the said day of booking with full day or exact same session id.
    * Parameters:: Day of week, Date and session id
    */
    function getEmployeeSessionAndDayAvailability($day, $sessionId){
        
        $query = "SELECT employee_id FROM mm_company_employees 
                                WHERE employee_id IN (SELECT employee_session_employee_id 
                                                FROM mm_employee_session 
                                                WHERE employee_session_".$day." = 1 OR employee_session_".$day." = $sessionId) AND `employee_archived` = '".Globals::UN_ARCHIVE."'";
        
        return $this->db->query($query)->result();
        
    }
    
    /*
    * SQL to get the employee who has spl session on service date
    */
    function getEmployeeWhoGotSplSession($date){
        return $this->db->query("SELECT employee_id, employee_name FROM mm_company_employees
                            WHERE employee_id IN (SELECT employee_session_spl_employee_id 
                                                FROM mm_employee_session_spl
                                                WHERE employee_session_spl_off_status = 0
                                                AND '$date' BETWEEN employee_session_spl_date_from AND employee_session_spl_date_to) AND `employee_archived` = '".Globals::UN_ARCHIVE."'")->result();
    }
    
    /*
    * SQL to get the employee who has spl session on service date
    */
    function getEmployeeWhoGotSplSessionHoliday($date){
        return $this->db->query("SELECT employee_id, employee_name FROM mm_company_employees
                            WHERE employee_id IN (SELECT employee_session_spl_employee_id 
                                                FROM mm_employee_session_spl
                                                WHERE employee_session_spl_off_status = 1
                                                AND '$date' BETWEEN employee_session_spl_date_from AND employee_session_spl_date_to) AND `employee_archived` = '".Globals::UN_ARCHIVE."'")->result();
    }
    
    /*
    * SQL to get the Employees who has got/free for the said day of booking with full day as a default and they dont have any spl * session assigned.
    * Parameters:: Day of week, Date and session id
    */
    function getEmployeeSplSessionAvailability($date, $sessionId){
        
        return $this->db->query("SELECT employee_id FROM mm_company_employees
                            WHERE employee_id IN (SELECT employee_session_spl_employee_id 
                                                FROM mm_employee_session_spl
                                                WHERE employee_session_spl_off_status = 0
                                                AND '$date' BETWEEN employee_session_spl_date_from AND employee_session_spl_date_to AND (employee_session_spl_session_id = 1
                                                OR employee_session_spl_session_id = $sessionId))
                            AND employee_job_session_id = 1 AND `employee_archived` = '".Globals::UN_ARCHIVE."'")->result();
        
    }
    
    /*
    * SQL to get the employees who has assigned job on the perticular date.
    */
    function getEmployeeAssignedJob($date){
        
        return $this->db->query("SELECT DISTINCT(employee_job_employee_id) as employee_id
                            FROM mm_employee_job
                            LEFT JOIN mm_booking_sessions ON booking_sessions_id = employee_job_booking_sessions_id
                            LEFT JOIN `mm_booking` ON `booking_id` = `booking_sessions_booking_id`
                            WHERE booking_sessions_service_date = '$date' AND `booking_status` != '".Globals::BOOKING_CANCELLED."'")->result();
    }
    
    /*
    * SQL to get the employees who's company serving for the postcode location.
    */
    function getEmployeeServingForLocation($employeesStr, $postcode, $req_crew_count){
        $query = "SELECT `employee_id`, IF ( count(`employee_id`) >= $req_crew_count, 1, 0)  as `meet_req_count`
                                FROM `mm_company_employees`
                                LEFT JOIN `mm_vendor_company` AS `vc` ON `company_id` = `employee_company_id`
                                LEFT JOIN `mm_vendor_service_location` AS `vsl` ON `vsl`.`vendor_service_location_vendor_id` = `vc`.`company_person_id`
                                WHERE `vsl`.vendor_service_location_postcode = '$postcode'
                                AND `employee_id` IN ($employeesStr) AND `employee_archived` = '".Globals::UN_ARCHIVE."' GROUP BY `employee_company_id`";
        return $this->db->query($query)->result();
    }
       

}
