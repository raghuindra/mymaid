<?php

/**
 * person_model is model to carryout all Db operations related to person  
 *
 */
class Person_model extends Mm_model {

    function __construct() {
        parent::__construct();
        $this->_table = 'mm_person';
        $this->_country_table = 'mm_country';
        $this->_admin_table = 'mm_admin';
        $this->_user_table = 'mm_user';
        $this->_vendor_table = 'mm_vendor';
        $this->_person_table = 'mm_person';
        $this->_person_type_table = 'mm_person_type';
        $this->_permission_table = 'mm_permission';
        $this->_permission_type_table = 'mm_permission_type';
        $this->_booking      = "mm_booking";
        $this->_vendor_company  = "mm_vendor_company";
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
        $this->db->join($this->_user_table, 'user_person_id = person_id','left');
        $this->db->join($this->_person_type_table, 'person_type_id = person_type','left');
        
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
        $this->db->join($this->_vendor_table, 'vendor_person_id = person_id','left');
        $this->db->join($this->_person_type_table, 'person_type_id = person_type','left');
        
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
        $this->db->join($this->_admin_table, 'admin_person_id = person_id','left');
        $this->db->join($this->_person_type_table, 'person_type_id = person_type','left');
        
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
        $this->db->join($this->_permission_type_table, 'permission_type_id = permission_permission_type_id','left');
        return $this->db->get($this->_permission_table);
    }
    
    function getServiceBookings($now){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where('booking_service_date >', $now)
                        ->where('booking_vendor_company_id IS NULL', null)             
                        ->where('booking_cancelled_by IS NULL', null)
                        ->where('booking_status', Globals::BOOKING_PROCESSING)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->get()
                        ->result();
    }
    
    function getVendorServiceBookings($company_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where('booking_vendor_company_id', $company_id)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where('booking_completion_company_confirmed', 0)
                        ->where('booking_completion_admin_confirmed', 0)
                        ->where('booking_cancelled_approved_by_admin', 0)
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
                 ->get()
                 ->result(); 
    }
    
    function getUserCompletedBookings($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->where('booking_user_id', $person_id)
                        ->where("booking_status ", Globals::BOOKING_COMPLETED)
                        ->where(" (booking_completion_user_comfirmed = 1 OR booking_completion_admin_confirmed = 1) ")
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

}
