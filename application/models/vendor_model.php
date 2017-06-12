<?php

class Vendor_model extends Mm_model{
    
    function __construct() {
        parent::__construct();
        $this->_table                               = 'mm_vendor';
        $this->_person_table                        = 'mm_person';
        $this->_country_table                       = 'mm_country';
        $this->_lang_table                          = 'mm_language';
        $this->_state_table                         = "mm_state";
        $this->_postcode_table                      = "mm_postcode";
        $this->_company_employees                   = "mm_company_employees";
        $this->_session                             = "mm_session";
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
        $this->db->join($this->_state_table.' as st', 'st.state_code = pt.state_code','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_postcode_table.' as pt', $row_count, $offset);
        }
          return $this->db->get($this->_postcode_table.' as pt');
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
        
        
}
