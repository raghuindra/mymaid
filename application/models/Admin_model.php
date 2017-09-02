<?php

class Admin_model extends Mm_model{
    
    function __construct() {
        parent::__construct();
        $this->_table     = 'mm_admin';

    }
    
    function check_email($email){
          return $this->db->select('admin_email')
                    ->from($this->_table)
                    ->where('admin_email',$email)
                    ->get()
                    ->result();


    }
    
    function getServicePackages($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_services, 'service_id = service_package_service_id','left');
        $this->db->join($this->_service_building, 'building_id = service_package_building_id','left');
        $this->db->join($this->_service_area, 'area_id = service_package_building_area_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_service_package, $row_count, $offset);
        }
          return $this->db->get($this->_service_package);
    }
    
       
    function getFrequencyOfferPriceList($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_service_frequency_offer, $row_count, $offset);
        }
          return $this->db->get($this->_service_frequency_offer);
    }
    
    function getFrequencyOffersForService($serviceId){
        
        return $this->db->query("SELECT * from mm_service_frequency WHERE service_frequency_archived=0 AND service_frequency_id NOT IN "
                . "(SELECT service_frequency_offer_frequency_id FROM mm_service_frequency_offer WHERE service_frequency_offer_archived = 0 AND service_frequency_offer_service_id = '".$serviceId."')")->result();
        
        
    }
    
    function getAddonsForService($serviceId){
        return $this->db->query("SELECT * from mm_service_addon WHERE service_addon_archived=0 AND service_addon_id NOT IN "
                . "(SELECT service_addon_price_addon_id FROM mm_service_addon_price WHERE service_addon_price_archived = 0 AND service_addon_price_service_id = '".$serviceId."')")->result();
    }
    
    
    function getServiceAddonsPriceList($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_service_addon, 'service_addon_id = service_addon_price_addon_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_service_addon_price, $row_count, $offset);
        }
          return $this->db->get($this->_service_addon_price);
    }
    
    function get_serviceSplRequest($serviceId){
        return $this->db->query("SELECT * from mm_spl_request WHERE spl_request_archived=0 AND spl_request_id NOT IN "
                . "(SELECT service_spl_request_spl_request_id FROM mm_service_spl_request WHERE service_spl_request_archived = 0 AND service_spl_request_service_id = '".$serviceId."')")->result();
    }
    
    function getServiceSplRequestList($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_spl_request, 'spl_request_id = service_spl_request_spl_request_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_service_spl_request, $row_count, $offset);
        }
          return $this->db->get($this->_service_spl_request);
        
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
    
    function get_postcodes($areacodes, $packageId){
        return $this->db->query("SELECT DISTINCT(postcode) FROM mm_postcode where post_office IN (".$areacodes.")"
                . " AND postcode NOT IN (SELECT postcode_service_price_postcode FROM mm_postcode_service_price WHERE postcode_service_price_package_id = ".$packageId.")");
    }
    
    function getServicePackagePincodePriceList($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
         $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        //$this->db->join($this->_spl_request, 'spl_request_id = service_spl_request_spl_request_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_postcode_service_price, $row_count, $offset);
        }
        return $this->db->get($this->_postcode_service_price);
    }
    
    /** Function to get the New Vendors list
     * 
     */
    function getNewVendors(){
        $where_condition = "( person_type_name = '".Globals::PERSON_TYPE_VENDOR_NAME."' OR person_type_name = '".Globals::PERSON_TYPE_FREELANCER_NAME."' )";
        $this->db->select('*'); 
        $this->db->where('person_status', '0');
        $this->db->where($where_condition);
        $this->db->join($this->_person_type, 'person_type_id = person_type','left');
        $this->db->join($this->_vendor_company, 'company_person_id = person_id','left');
        
        return $this->db->get($this->_person);
    }
    
    /* Function to get the Active Vendors list */
    function getActiveVendors($archived){
        $where_condition = "( person_type = '".Globals::PERSON_TYPE_VENDOR."' )";
        $this->db->select('*'); 
        $this->db->where('person_status', '1');
        $this->db->where('person_archived', $archived);
        $this->db->where($where_condition);
        $this->db->join($this->_vendor_company, 'company_person_id = person_id','left');
        $this->db->join($this->_state, 'state_code = company_state','left');
        
        return $this->db->get($this->_person);
    }
       
    /* Function to get the Active Freelancers list */
    function getActiveFreelancers($archived){
        $where_condition = "( person_type = '".Globals::PERSON_TYPE_FREELANCER."' )";
        $this->db->select('*'); 
        $this->db->where('person_status', '1');
        $this->db->where('person_archived', $archived);
        $this->db->where($where_condition);
        $this->db->join($this->_vendor_company, 'company_person_id = person_id','left');
        $this->db->join($this->_state, 'state_code = company_state','left');
        
        return $this->db->get($this->_person);
    }
    /* Function to get Vendor Company list */
    function getVendorCompany($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_person, 'person_id = company_person_id','left');
        $this->db->join($this->_person_type, 'person_type_id = person_type','left');
        $this->db->join($this->_state, 'state_code = company_state','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_vendor_company, $row_count, $offset);
        }
          return $this->db->get($this->_vendor_company);
        
    }
    
    
    function getNewServiceOrders($now){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_frequency, 'booking_frequency_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_service_package, 'service_package_id = booking_package_id','left')
                        ->join($this->_service_building, 'building_id = service_package_building_id','left')
                        ->join($this->_service_area, 'area_id = service_package_building_area_id','left')
                        ->join($this->_service_frequency_offer, 'service_frequency_offer_id = booking_frequency_frequency_offer_id','left')
                        ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->where('booking_service_date >=', $now)
                        ->where('booking_vendor_company_id IS NULL', null)             
                        ->where('booking_cancelled_by IS NULL', null)
                        ->where('booking_status', Globals::BOOKING_PROCESSING)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }
    
    
    function getActiveServiceOrders(){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where('booking_completion_admin_confirmed', 0)
                        ->where('booking_cancelled_approved_by_admin', 0)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where('booking_status != '.Globals::BOOKING_PROCESSING)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }
    
    function getServiceBookingDetail($bookingId, $company_id=null){
        $this->db->select('*');
        $this->db->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left');
        $this->db->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left');
        $this->db->join($this->_services, 'service_id = booking_service_id','left');
        $this->db->join($this->_person, 'person_id = booking_user_id','left');
        if($company_id != null){
            $this->db->join($this->_vendor_company, "booking_vendor_company_id = company_id", 'left');
            $this->db->where('company_id', $company_id);
        }
        $this->db->where('booking_id', $bookingId);
     return   $this->db->get($this->_booking)->result();
    }
    
    
    function getCompletedServiceOrders(){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where('booking_completion_admin_confirmed', 1)
                        ->where('booking_status', Globals::BOOKING_COMPLETED)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }
        
    
    function getCanceledBookings(){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where("booking_status ", Globals::BOOKING_CANCELLED)
                        ->where("booking_cancelled_approved_by_admin ", 1)
                        ->where("booking_cancelled_by IS NOT NULL", null)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }
    
    
    function getAvailableCompaniesForService($service_date){
        
        return $this->db->query("SELECT * FROM `mm_vendor_company` LEFT JOIN `mm_company_employees` ON "
                . "  (`employee_company_id`= `company_id`) WHERE `employee_archived` = '".Globals::UN_ARCHIVE."' AND employee_id NOT IN "
                . " ( SELECT employee_job_employee_id from mm_employee_job "
                . " LEFT JOIN mm_booking on employee_job_booking_id = booking_id "
                . " WHERE booking_service_date = '$service_date') GROUP BY `company_id`")->result();
        
    }
    
    function getAvailableEmployees($companyId, $booking_id){
        return $this->db->query("SELECT * FROM `mm_company_employees` "
                . " WHERE `employee_company_id`= '$companyId' AND `employee_archived` = '".Globals::UN_ARCHIVE."' AND `employee_id` NOT IN "
                . " ( SELECT `employee_job_employee_id` from `mm_employee_job` "
                . " LEFT JOIN `mm_booking` on `employee_job_booking_id` = `booking_id` "
                . " LEFT JOIN `mm_booking_sessions` on `booking_sessions_booking_id` = `booking_id` "
                . " WHERE `booking_sessions_service_date` IN(SELECT `booking_sessions_service_date` 
                                               FROM `mm_booking_sessions` WHERE `booking_sessions_booking_id` = $booking_id))")->result();
    }
    
    function getServiceDetailsForJobAssign($bookingId){
        return $this->db->query("SELECT * FROM `mm_booking_sessions` LEFT JOIN `mm_session` ON `session_id` = `booking_sessions_session_id` WHERE `booking_sessions_booking_id` = $bookingId")->result();
    }
    
    function check_booking_job_is_assigned($bookingId){
        return $this->db->query("SELECT * FROM `mm_booking` "
                . " WHERE `booking_id`= '$bookingId' AND `booking_vendor_company_id` IS NULL")->result();
        
    }
    
    function getVendorWithdrawalRequest(){
        return $this->db->select('*')
                        ->from($this->_vendor_wallet_withdrawal)
                        ->join($this->_person, 'person_id = vendor_wallet_withdrawal_vendor_id','left')
                        ->join($this->_vendor_company, 'company_person_id = vendor_wallet_withdrawal_vendor_id','left')
                        ->get()
                        ->result();
    }
    
    function getEmployeeSessionColumnName($Servdate){
        $dateObj = date_create($Servdate);
        $weekday = date_format($dateObj, 'w'); 
        $columnName = "";
        switch($weekday){
            
            case 'Monaday': $columnName = "employee_session_monday"; break;
            case 'Tuesday': $columnName = "employee_session_tuesday"; break;
            case 'Wednesday': $columnName = "employee_session_wednesday"; break;
            case 'Thursday': $columnName = "employee_session_thursday"; break;
            case 'Friday': $columnName = "employee_session_friday"; break;
            case 'Saturday': $columnName = "employee_session_saturday"; break;
            case 'Sunday': $columnName = "employee_session_sunday"; break;
        }
        return $columnName;
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
                                                AND employee_company_id = $company_id";
        
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
                                                AND '$date' BETWEEN employee_session_spl_date_from AND employee_session_spl_date_to) AND employee_company_id = $company_id ")->result();
    }
    
    /*
    * SQL to get the employee who has spl session on service date
    */
    function getEmployeeWhoGotSplSessionHoliday($date, $company_id){
        return $this->db->query("SELECT employee_id, employee_name FROM mm_company_employees
                            WHERE employee_id IN (SELECT employee_session_spl_employee_id 
                                                FROM mm_employee_session_spl
                                                WHERE employee_session_spl_off_status = 1
                                                AND '$date' BETWEEN employee_session_spl_date_from AND employee_session_spl_date_to) AND employee_company_id = $company_id")->result();
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
                            AND employee_job_session_id = 1 AND employee_company_id = $company_id ")->result();
        
    }
    
    /*
    * SQL to get the employees who has not assigned job on the perticular date.
    */
    function getEmployeeAssignedJob($date, $company_id){
        
        return $this->db->query("SELECT DISTINCT(employee_job_employee_id) as `employee_id`, `employee_name`
                            FROM `mm_employee_job`
                            LEFT JOIN `mm_booking_sessions` ON `booking_sessions_id` = `employee_job_booking_sessions_id`
                            LEFT JOIN `mm_company_employees` ON `employee_id` = `employee_job_employee_id`
                            WHERE `booking_sessions_service_date` = '$date' AND `employee_company_id` = $company_id")->result();
    }
    
    /*
    * SQL to get the employees who's company serving for the postcode location.
    */
    function getEmployeeServingForLocation($employeesStr, $postcode, $company_id){
        return $this->db->query("SELECT `employee_id`, `employee_name`
                                FROM `mm_company_employees`
                                LEFT JOIN `mm_vendor_company` AS `vc` ON `company_id` = `employee_company_id`
                                LEFT JOIN `mm_vendor_service_location` AS `vsl` ON `vsl`.`vendor_service_location_vendor_id` = `vc`.`company_person_id`
                                WHERE `vsl`.`vendor_service_location_postcode` = '$postcode' AND `employee_company_id` = $company_id
                                AND `employee_id` IN ($employeesStr)")->result();
    }
    
    function _getBookingSessionDetail($booking_id){
        return $this->db->query("SELECT * from mm_booking_sessions LEFT JOIN mm_session ON session_id = booking_sessions_session_id WHERE booking_sessions_booking_id = $booking_id")->result();
    }
        
}
