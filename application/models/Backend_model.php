<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_model extends CI_Model { 
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function last_query(){
        return $this->db->last_query();
    }
    
    public function select_table_OR($table,$condition,$array){
        return $this->db->select('*')
                    ->from($table)
                    ->where($condition)
                    ->or_where($array)
                    ->get()
                    ->result();                   
    }
    
    public function select_table($table,$condition){
        return $this->db->select('*')
                    ->from($table) 
                    ->where($condition)
                    ->get()
                    ->result();
    }
    
    public function update_table($table,$data,$condition){
       return $this->db->update($table,$data,$condition);
    }
    
    public function select_table_like($table,$select,$term){
                $this->db->select($select); 
                $i=0;
               foreach($term as $val){ $this->db->like("name",$val);}               
                //$this->db->like("name",$term);
                $this->db->limit(10,0);
                 return $this->db->get($table)->result();
                 
                
    }
	
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
    
    function get_table($table,$fields = 'id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true) {
		$this->db->select($fields);
		if(count($condition) > 0) {
			foreach($condition as $key => $cond) {
				$this->db->where($key, $cond, $filter);
			}	
		}
		$order != ''?$this->db->order_by($order):null;
		if ($offset >= 0 AND $row_count > 0)
			return $this->db->get($table, $row_count, $offset);
		return $this->db->get($table);
    }
    
    public function table_insert($table,$data){
                $this->db->insert($table,$data);
                return $this->db->insert_id();
    }
    
     public function multiple_insert($table,$data){
               return  $this->db->insert_batch($table,$data);
                //return $this->db->insert_id();
    }
        
    public function delete_data($table,$condition=NULL){      
        $this->db->delete($table,$condition);    
               
    }
    
    public function truncate($table){
        return $this->db->truncate($table); 
    }
}