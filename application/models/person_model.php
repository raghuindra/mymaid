<?php

/**
 * person_model is model to carryout all Db operations related to person  
 *
 */
class Person_model extends Np_model {

    function __construct() {
        parent::__construct();
        $this->_table = 'mm_person';
        $this->_country_table = 'mm_country';
//        $this->_administrator_table = 'np_administrator';
//        $this->_editor_table = 'np_editor';
//        $this->_member_table = 'np_member';
//        $this->_manager_table = 'np_manager';
//        $this->_catagory_table = 'np_catagory';
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

}
