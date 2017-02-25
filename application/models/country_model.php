<?php

class Country_model extends Mm_model 
{
	function __construct() {
            parent::__construct();
            $this->_table = 'mm_country';
            $this->_download_stats_table = 'download_stats_country';
	}
    
    function getBackendSalesStatS($fields = 'user_id', $condition = array(), $order = 'country_id asc', $offset = 0, $row_count = 0) {
        $user_fullname = $this->input->get('user_fullname', true);
        $user_fullname && $user_fullname != ''?$this->db->like('user_fullname', $user_fullname):null;
        $this->db->select($fields);
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                $this->db->where($key, $cond);
            }   
        }
        $this->db->join($this->_download_stats_table, 'download_stats_country_id = country_id', 'left');
        $this->db->order_by($order);
        if ($offset >= 0 AND $row_count > 0)
            return $this->db->get($this->_table, $row_count, $offset);
        return $this->db->get($this->_table);
    }    
}

?>