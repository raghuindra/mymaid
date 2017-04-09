<?php

class Admin_model extends Mm_model{
    
    function __construct() {
        parent::__construct();
        $this->_table                               = 'mm_admin';
        $this->_person_table                        = 'mm_person';
        $this->_person_type_table                   = 'mm_person_type';
        $this->_country_table                       = 'mm_country';
        $this->_vendor_company_table                = "mm_vendor_company";
        $this->_lang_table                          = 'mm_language';
        $this->_service_table                       = "mm_services";
        $this->_service_package_table               = "mm_service_package";
        $this->_service_building_table              = "mm_building";
        $this->_service_area_table                  = "mm_area";
        $this->_service_frequency_offer_table       = "mm_service_frequency_offer";
        $this->_service_frequency_table             = "mm_service_frequency";
        $this->_service_addon_price_table           = "mm_service_addon_price";
        $this->_service_addon_table                 = "mm_service_addon";
        $this->_spl_request_table                   = "mm_spl_request";
        $this->_service_spl_request_table           = "mm_service_spl_request";
        $this->_state_table                         = "mm_state";
        $this->_postcode_table                      = "mm_postcode";
        $this->_postcode_service_price_table        = "mm_postcode_service_price";      
        
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
        $this->db->join($this->_service_table, 'service_id = service_package_service_id','left');
        $this->db->join($this->_service_building_table, 'building_id = service_package_building_id','left');
        $this->db->join($this->_service_area_table, 'area_id = service_package_building_area_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_service_package_table, $row_count, $offset);
        }
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
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_service_frequency_offer_table, $row_count, $offset);
        }
          return $this->db->get($this->_service_frequency_offer_table);
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
        $this->db->join($this->_service_addon_table, 'service_addon_id = service_addon_price_addon_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_service_addon_price_table, $row_count, $offset);
        }
          return $this->db->get($this->_service_addon_price_table);
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
        $this->db->join($this->_spl_request_table, 'spl_request_id = service_spl_request_spl_request_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_service_spl_request_table, $row_count, $offset);
        }
          return $this->db->get($this->_service_spl_request_table);
        
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
        //$this->db->join($this->_spl_request_table, 'spl_request_id = service_spl_request_spl_request_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_postcode_service_price_table, $row_count, $offset);
        }
        return $this->db->get($this->_postcode_service_price_table);
    }
    
    /** Function to get the New Vendors list
     * 
     */
    function getNewVendors(){
        $this->db->select('*'); 
        $this->db->where('person_status', '0');
        $this->db->where('person_type_name', Globals::PERSON_TYPE_VENDOR_NAME);
        $this->db->join($this->_person_type_table, 'person_type_id = person_type','left');
        $this->db->join($this->_vendor_company_table, 'company_person_id = person_id','left');
        
        return $this->db->get($this->_person_table);
    }
    
    /* Function to get the Active Vendors list */
    function getActiveVendors($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_vendor_company_table, 'company_person_id = person_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_person_table, $row_count, $offset);
        }
          return $this->db->get($this->_person_table);
    }
    
    /* Function to get Vendor Company list */
    function getVendorCompany($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_person_table, 'person_id = company_person_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_vendor_company_table, $row_count, $offset);
        }
          return $this->db->get($this->_vendor_company_table);
        
    }
        
        
}
