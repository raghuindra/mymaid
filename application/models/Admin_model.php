<?php

class Admin_model extends Mm_model{
    
    function __construct() {
        parent::__construct();
        $this->_table = 'mm_admin';
        $this->_person_table = 'mm_person';
        $this->_country_table = 'mm_country';
        $this->_lang_table  = 'mm_language';
        $this->_service_table = "mm_services";
        $this->_service_package_table = "mm_service_package";
        $this->_service_building_table = "mm_building";
        $this->_service_area_table  = "mm_area";
        $this->_service_frequency_offer_table = "mm_service_frequency_offer";
        $this->_service_frequency_table = "mm_service_frequency";
    }
    
    function check_email($email)
    {
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
        $this->db->join($this->_service_table, 'service_id = service_package_service_id','left');
        $this->db->join($this->_service_building_table, 'building_id = service_package_building_id','left');
        $this->db->join($this->_service_area_table, 'area_id = service_package_building_area_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0)
                return $this->db->get($this->_service_package_table, $row_count, $offset);
          return $this->db->get($this->_service_package_table);
    }
    
       
    function getFrequencyOfferPriceList($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_service_frequency_table, 'service_frequency_id = service_frequency_offer_frequency_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0)
                return $this->db->get($this->_service_frequency_offer_table, $row_count, $offset);
          return $this->db->get($this->_service_frequency_offer_table);
    }
    
    function getServiceFrequencyOffers($serviceId){
        
        return $this->db->query("SELECT * from mm_service_frequency WHERE service_frequency_archived=0 AND service_frequency_id NOT IN "
                . "(SELECT service_frequency_offer_frequency_id FROM mm_service_frequency_offer WHERE service_frequency_offer_archived = 0 AND service_frequency_offer_service_id = '".$serviceId."')")->result();
        
        
    }
        
        
}
