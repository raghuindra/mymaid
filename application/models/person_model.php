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
        $this->_person_type_table = 'mm_person_type';
        $this->_permission_table = 'mm_permission';
        $this->_permission_type_table = 'mm_permission_type';
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
         $this->db->last_query(); exit;
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
    
    

}
