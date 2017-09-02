<?php
/**
 * Mm_model is basic model for all database related operations 
 *
 * PHP versions 4 and 5
 *
 * @category	models
 * @package		mymaid
 * @author		Raghavendra Patil
 * @copyright	mymaid
 * @license		mymaid
 * @version		1.0
 */

class Mm_model extends CI_Model 
{
	function __construct() {
		parent::__construct();
        $this->loadTableNames();
	}
    
    /*
    * Load the table names
    */
    function loadTableNames(){
        
        $this->_admin                           = 'mm_admin';
        $this->_area                            = "mm_area";
        
        $this->_booking                         = "mm_booking";
        $this->_booking_addons                  = "mm_booking_addons";
        $this->_booking_spl_request             = "mm_booking_spl_request";
        $this->_booking_frequency               = "mm_booking_frequency";
        $this->_booking_sessions                = "mm_booking_sessions";
        $this->_booking_user_detail             = "mm_booking_user_detail";
        $this->_booking_spl_request             = "mm_booking_spl_request";
        $this->_building                        = "mm_building";
        
        $this->_company_employees               = "mm_company_employees";
        $this->_country                         = 'mm_country';
        
        $this->_employee_job                    = "mm_employee_job";
        $this->_employee_session_spl            = "mm_employee_session_spl";
        
        $this->_lang                            = 'mm_language';
        
        $this->_postcode                        = "mm_postcode";
        $this->_person                          = 'mm_person';
        $this->_person_type                     = 'mm_person_type';
        $this->_postcode                        = "mm_postcode";
        $this->_postcode_service_price          = "mm_postcode_service_price";
        $this->_permission_type                 = 'mm_permission_type';
        $this->_permission                      = 'mm_permission';
        
        $this->_session                         = "mm_session";
        $this->_state                           = "mm_state";
        $this->_services                        = "mm_services";
        $this->_service_package                 = "mm_service_package";
        $this->_service_frequency_offer         = "mm_service_frequency_offer";
        $this->_service_frequency               = "mm_service_frequency";
        $this->_service_addon_price             = "mm_service_addon_price";
        $this->_service_addon                   = "mm_service_addon";
        $this->_service_spl_request             = "mm_service_spl_request";
        $this->_service_building                = "mm_building";
        $this->_service_area                    = "mm_area";
        $this->_spl_request                     = "mm_spl_request";
        
        $this->_vendor                          = 'mm_vendor';
        $this->_vendor_company                  = "mm_vendor_company";
        $this->_vendor_service_location         = 'mm_vendor_service_location';
        $this->_vendor_wallet_withdrawal        = "mm_vendor_wallet_withdrawal";
        
        $this->_user                            = 'mm_user';
        
    }
	
	/**
	 *
	 * Get function to retrieve result set from database
	 *
	 * @param	array	$fields	array of fields 
	 * @param	string	$condition	
	 * @param   string  $order 
	 * @param   string  $offset
	 * @param   bool	$filter
	 * @return	arrayObject
	 */
	function get($fields = 'id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true) {
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
	
	/**
	 *
	 * Get_tb function to retrive resultset from database  based on table name
	 *
	 * @param   string  $tbl name of table to get from 
	 * @param	array	$fields	array of fields 
	 * @param	string	$condition	
	 * @param   string  $order 
	 * @param   string  $offset
	 * @param   bool	$filter
	 * @return	arrayObject
	 */
	function get_tb($tbl,$fields = 'id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true) {
		$this->db->select($fields);
		if(count($condition) > 0) {
			foreach($condition as $key => $cond) {
				$this->db->where($key, $cond, $filter);
			}	
		}
		$order != ''?$this->db->order_by($order):null;
		if ($offset >= 0 AND $row_count > 0)
			return $this->db->get($tbl, $row_count, $offset);
		return $this->db->get($tbl);
	}
	
	/**
	 *
	 * Insert function to insert row in database
	 *
	 * @param	array	$data	array of fields 
	 * @return	integer
	 */
	function insert($data) {
		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}
	
	/**
	 *
	 * Insert_tb function to insert row in database based on table
	 *
	 * @param  	string  $tbl	Table name to insert in 
	 * @param	array	$data	array of fields 
	 * @return	integer
	 */
	function insert_tb($tbl,$data) {
		$this->db->insert($tbl, $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
        /**
	 *
	 * Insert Batch function to insert Multiple rows in database
	 *
	 * @param	array	$data	array of fields 
	 * @return	nil
	 */
        function insert_batch($data) {
            $this->db->insert_batch($this->_table, $data);
        }
        
        /**
	 *
	 * Insert Batch function to insert Multiple rows in database
	 *
	 * @param	array	$data	array of fields 
	 * @return	nil
	 */
        function insert_batch_tb($table,$data) {
            $this->db->insert_batch($table, $data);
        }
	
	/**
	 *
	 * Update function to update row in database
	 *
	 * @param	array	$data	array of fields 
	 * @param 	array 	$condition multiple conditions in array format
	 * @return	nil
	 */
	function update($condition = array(), $data = array()) {
		$this->db->set($data);
		if(count($condition) > 0) {
			foreach($condition as $key => $cond) {
				$this->db->where($key, $cond);
			}	
		}
		return  $this->db->update($this->_table);
	}	
	
	/**
	 *
	 * Update function to update row in database
	 *
	 * @param	string	$tbl	name of table 
	 * @param	array	$data	array of fields 
	 * @param 	array 	$condition multiple conditions in array format
	 * @return	nil
	 */
	function update_tb($tbl,$condition = array(), $data = array()) {
		$this->db->set($data);
		if(count($condition) > 0) {
			foreach($condition as $key => $cond) {
				$this->db->where($key, $cond);
			}	
		}
		return  $this->db->update($tbl);
	}
        
        /**
	 *
	 * SET function to update row in database
	 *
	 * @param	string	$tbl	name of table 
	 * @param	array	$data	array of fields 
	 * @param 	array 	$condition multiple conditions in array format
	 * @return	nil
	 */
	function set_tb($tbl,$condition = array(), $data = array(),$escape=FALSE) {
            foreach($data as $name => $val) {
                    $this->db->set($name, $val,$escape);
                }	            
		if(count($condition) > 0) {
			foreach($condition as $key => $cond) {
				$this->db->where($key, $cond);
			}	
		}
		return  $this->db->update($tbl);
	}
               
	
	/**
	 *
	 * Delete function to delete row in database
	 *
	 * @param	string	$type	field 
	 * @param 	string 	$value  value of field on which row has to be deleted
	 * @return	bool
	 */
	function delete($type, $value) {
		$this->db->where($type, $value);
		return $this->db->delete($this->_table);
	}
	
	/**
	 *
	 * Delete function to delete row in database based on table name and column
	 * @param	string	$type	tablename
	 * @param 	string 	$condition  value & field on which row has to be deleted
	 * @return	bool
	 */
	function delete_tb($tbl,$condition) {
		$this->db->where($condition);
		 return $this->db->delete($tbl);
                
	}
        
        /**
	 *
	 * Delete function to delete row in database based on table name and column
	 * @param	string	$type	tablename
	 * @param 	array 	$condition  value & field on which row has to be deleted
	 * @return	bool
	 */
	function delete_tb_array($tbl,$condition) {
		foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond);
                }
		return $this->db->delete($tbl);
	}
        
        
        public function last_query(){
            return $this->db->last_query();
        }
	
	function tempqry($str){
		return $this->db->query($str);
	} 
        
        function getAffectedRowCount(){
            return $this->db->affected_rows();
        }
        
        function sendMessage($mobile, $message, $from, $createdDate, $updatedBy, $updatedDate){
            return $this->db->query("INSERT INTO `sms_trigger` ( `phoneNumber` , `message` , `createdBy` , `createdDate` , `updatedBy` , `updatedDate` ) 
VALUES ('$mobile', '$message', '$from', '$createdDate', '$updatedBy', '$updatedDate')");
            //return sp_smsAlert_insert($mobile, $message,$from, $date);
        }
        
        function update_batch_tb($tbl, $batchData, $conditionKey){
            return $this->db->update_batch($tbl, $batchData, $conditionKey);
        }
        
        function update_person_wallet_credit($person_id, $amount){
            return $this->db->query("UPDATE `mm_person` SET `person_wallet_amount` = `person_wallet_amount` + $amount WHERE `person_id`= $person_id");
            
        }
        
        function update_person_wallet_debit($person_id, $amount){
            return $this->db->query("UPDATE `mm_person` SET `person_wallet_amount` = `person_wallet_amount` - $amount WHERE `person_id`= $person_id");
            
        }

        function get_table_row_count($tbl){
        	return $this->db->query("select count(*) as count from ".$tbl);
        }
}
?>