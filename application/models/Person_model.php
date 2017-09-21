<?php

/**
 * person_model is model to carryout all Db operations related to person  
 *
 */
class Person_model extends Mm_model {

    function __construct() {
        parent::__construct();
        $this->_table = 'mm_person';
       
    }

    /**
     *
     * Get login Information from table
     *
     * @param	string	$type type of the user 
     * @return	nil
     */
    function get($fields = 'person_id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true) {
		$this->db->select($fields);
		if(count($condition) > 0) {
			foreach($condition as $key => $cond) {
				$this->db->where($key, $cond, $filter);
			}	
		}
		$order != ''?$this->db->order_by($order):null;
		if ($offset >= 0 AND $row_count > 0)
			return $this->db->get($this->_table, $row_count, $offset);
		return $this->db->get($this->_table);
	}

    function getAllEmails() {
        $this->db->where('email !=', "");
        $this->db->select('email');
        return $this->db->get($this->_table);
    }
    
    function getUserDetails($fields = 'person_id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_user, 'user_person_id = person_id','left');
        $this->db->join($this->_person_type, 'person_type_id = person_type','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0)
                return $this->db->get($this->_table, $row_count, $offset);
          return $this->db->get($this->_table);
         //$this->db->last_query();
    }

    function getPersonDetails($fields = 'person_id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }   
        }
        $this->db->join($this->_person_type, 'person_type_id = person_type','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0)
                return $this->db->get($this->_table, $row_count, $offset);
          return $this->db->get($this->_table);
         //$this->db->last_query();
    }
    
    function getVendorDetails($fields = 'person_id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true){
        
        $this->db->select($fields);
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_vendor, 'vendor_person_id = person_id','left');
        $this->db->join($this->_person_type, 'person_type_id = person_type','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0)
                return $this->db->get($this->_table, $row_count, $offset);
        return $this->db->get($this->_table);
        
    }
    
    function getAdminDetails($fields = 'person_id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true){
        
        $this->db->select($fields);
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_admin, 'admin_person_id = person_id','left');
        $this->db->join($this->_person_type, 'person_type_id = person_type','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0)
                return $this->db->get($this->_table, $row_count, $offset);
        return $this->db->get($this->_table);
    }
    
    function check_email($email){
        return $this->db->select('person_email')
                  ->from($this->_table)
                  ->where('person_email',$email)
                  ->get()
                  ->result();

    }
    
    function get_permissions($fields = 'permission_type_name', $condition = array(), $filter = true){
        $this->db->select($fields);
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_permission_type, 'permission_type_id = permission_permission_type_id','left');
        return $this->db->get($this->_permission);
    }
    
    function getServiceBookings($now){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where(" (booking_service_date > '".$now."' OR booking_service_date = '".$now."') ")
                        ->where('booking_vendor_company_id IS NULL', null)             
                        ->where('booking_cancelled_by IS NULL', null)
                        ->where('booking_status', Globals::BOOKING_PROCESSING)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }

    function getNewServiceBookingsForVendorFreelanc($now, $vendor_id){
        return $this->db->query("SELECT * FROM `mm_booking` WHERE (`booking_service_date` > '$now' OR `booking_service_date` = '$now') AND `booking_vendor_company_id` IS NULL AND `booking_cancelled_by` IS NULL AND `booking_status` = 2 AND `booking_payment_status` = 1 AND `booking_pincode` IN ( SELECT `vendor_service_location_postcode` from `mm_vendor_service_location` WHERE `vendor_service_location_vendor_id` = '$vendor_id') GROUP BY `booking_id`")->result();
    }
    
    function getVendorServiceBookings($company_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where('booking_vendor_company_id', $company_id)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where('booking_completion_company_confirmed', 0)
                        ->where('booking_completion_admin_confirmed', 0)
                        ->where('booking_cancelled_approved_by_admin', 0)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }
    
    function getAllServiceBookingsUnderProcess(){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where('booking_completion_company_confirmed', 0)
                        ->where('booking_completion_admin_confirmed', 0)
                        ->where('booking_cancelled_approved_by_admin', 0)
                        ->where('booking_status !=',Globals::BOOKING_PROCESSING)
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }
    
    function getAllUserServiceBookingsUnderProcess($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where('booking_user_id', $person_id)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where('booking_completion_admin_confirmed', 0)
                        ->where('booking_cancelled_approved_by_admin', 0)
                        ->where(" ( booking_status = ".Globals::BOOKING_CONFIRMED." OR booking_status = ".Globals::BOOKING_PROCESSING." ) ")
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }
    
    function getVendorCompletedServiceBookings($companyId){
        return $this->db->select('*')
                 ->from($this->_booking)
                 ->where('booking_vendor_company_id', $companyId)
                 ->where('booking_status', Globals::BOOKING_COMPLETED)
                 ->where('booking_completion_company_confirmed', 1)
                 ->where('booking_cancelled_approved_by_admin', 0)
                 ->group_by('booking_id')
                 ->get()
                 ->result(); 
    }
    
    function getUserCompletedBookings($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where('booking_user_id', $person_id)
                        ->where("booking_status ", Globals::BOOKING_COMPLETED)
                        ->where(" (booking_completion_user_comfirmed = 1 OR booking_completion_admin_confirmed = 1) ")
                        ->group_by('booking_id')
                        ->get()
                        ->result();
    }
    
    function getAllCompletedServiceOrders(){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where('booking_completion_admin_confirmed', 1)
                        ->where('booking_status', Globals::BOOKING_COMPLETED)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->get()
                        ->result();
    }
    
    function getVendorsCompany(){
        return $this->db->select('*')
                        ->from($this->_vendor_company)
                        ->join($this->_person, 'company_person_id = person_id','left')
                        ->where('person_type', Globals::PERSON_TYPE_VENDOR)
                        ->or_where('person_type', Globals::PERSON_TYPE_FREELANCER)
                        ->get()
                        ->result();
    }
    
    
    function getEmployeeSessions($company_id){
        $query = "SELECT employee_id, employee_company_id, employee_name, "
                . " CASE "
                . " WHEN employee_session_monday IS NULL THEN employee_job_session_id"
                . " ELSE employee_session_monday"
                . " END AS employee_session_monday,"
                . " CASE "
                . " WHEN employee_session_tuesday IS NULL THEN employee_job_session_id"
                . " ELSE employee_session_tuesday"
                . " END AS employee_session_tuesday,"
                . " CASE "
                . " WHEN employee_session_wednesday IS NULL THEN employee_job_session_id"
                . " ELSE employee_session_wednesday"
                . " END AS employee_session_wednesday,"
                . " CASE "
                . " WHEN employee_session_thursday IS NULL THEN employee_job_session_id"
                . " ELSE employee_session_thursday"
                . " END AS employee_session_thursday,"
                . " CASE "
                . " WHEN employee_session_friday IS NULL THEN employee_job_session_id"
                . " ELSE employee_session_friday"
                . " END  AS employee_session_friday,"
                . " CASE "
                . " WHEN employee_session_saturday IS NULL THEN employee_job_session_id"
                . " ELSE employee_session_saturday"
                . " END AS employee_session_saturday,"
                . " CASE "
                . " WHEN employee_session_sunday IS NULL THEN employee_job_session_id"
                . " ELSE employee_session_sunday"
                . " END AS employee_session_sunday"
                . " FROM mm_company_employees LEFT JOIN mm_employee_session ON employee_id = employee_session_employee_id";
        $query .= " WHERE employee_archived = 0";
        
        //if($company_id != null){
            $query .= " AND employee_company_id = $company_id";
        //}
        return $this->db->query($query);
        
        
    }
    
    
    function getEmployeeSplSessions($company_id){
        $query = "SELECT employee_session_spl_id, company_name, employee_name, DATE_FORMAT(employee_session_spl_date_from, '%d-%m-%Y') AS employee_session_spl_date_from, DATE_FORMAT(employee_session_spl_date_to, '%d-%m-%Y') AS employee_session_spl_date_to, employee_session_spl_session_id, employee_session_spl_off_status from mm_employee_session_spl LEFT JOIN mm_company_employees ON employee_id = employee_session_spl_employee_id LEFT JOIN mm_vendor_company ON company_id = employee_company_id ";
            //if( $company_id != null && $company_id != ''){
                $query .= " WHERE employee_company_id = $company_id"; 
            //}
        
        $query .= " ORDER BY employee_session_spl_id DESC";
        
        return $this->db->query($query);
    }

    function getEmployeeBookedDates($employeeId, $startDate, $endDate){
        $where_condition = "( `booking_status` = ".Globals::BOOKING_CONFIRMED." OR `booking_status` = ".Globals::BOOKING_COMPLETED." )";
        return $this->db->select('booking_sessions_service_date, employee_job_booking_id as booking_id')
                        ->from($this->_employee_job)
                        ->join($this->_booking_sessions, 'booking_sessions_id = employee_job_booking_sessions_id','left')
                        ->join($this->_booking, 'booking_id = booking_sessions_booking_id','left')
                        ->where('booking_sessions_service_date IS NOT NULL', null)
                        ->where('booking_sessions_service_date >=', $startDate)
                        ->where('booking_sessions_service_date <=', $endDate)
                        ->where('employee_job_employee_id', $employeeId)
                        ->where($where_condition)
                        ->get()
                        ->result();
    }

    function getEmployeeOffDates($employeeId, $startDate, $endDate){
        return $this->db->select('employee_session_spl_date_from, employee_session_spl_date_to')
                ->from($this->_employee_session_spl)
                ->where('employee_session_spl_off_status', 1)
                ->group_start()
                ->where('employee_session_spl_date_from >=', $startDate)
                ->or_where('employee_session_spl_date_to >=', $startDate)
                ->group_end()
                ->group_start()
                ->where('employee_session_spl_date_from <=', $endDate)
                ->or_where('employee_session_spl_date_to <=', $endDate)
                ->group_end()
                ->where('employee_session_spl_employee_id', $employeeId)
                ->get()
                ->result();

    }

}
