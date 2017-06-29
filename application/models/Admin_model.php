<?php

class Admin_model extends Mm_model{
    
    function __construct() {
        parent::__construct();
        $this->_table                               = 'mm_admin';
        $this->_person                        = 'mm_person';
        $this->_person_type_table                   = 'mm_person_type';
        $this->_country_table                       = 'mm_country';
        $this->_vendor_company                = "mm_vendor_company";
        $this->_lang_table                          = 'mm_language';
        $this->_services                       = "mm_services";
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
        $this->_booking                             = "mm_booking";
        $this->_booking_addons                      = "mm_booking_addons";
        $this->_booking_spl_request                 = "mm_booking_spl_request";
        
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
        $this->db->join($this->_services, 'service_id = service_package_service_id','left');
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
        $where_condition = "( person_type_name = '".Globals::PERSON_TYPE_VENDOR_NAME."' OR person_type_name = '".Globals::PERSON_TYPE_FREELANCER_NAME."' )";
        $this->db->select('*'); 
        $this->db->where('person_status', '0');
        $this->db->where($where_condition);
        $this->db->join($this->_person_type_table, 'person_type_id = person_type','left');
        $this->db->join($this->_vendor_company, 'company_person_id = person_id','left');
        
        return $this->db->get($this->_person);
    }
    
    /* Function to get the Active Vendors list */
    function getActiveVendors($archived){
        $where_condition = "( person_type = '".Globals::PERSON_TYPE_VENDOR."' OR person_type = '".Globals::PERSON_TYPE_FREELANCER."' )";
        $this->db->select('*'); 
        $this->db->where('person_status', '1');
        $this->db->where('person_archived', $archived);
        $this->db->where($where_condition);
        $this->db->join($this->_vendor_company, 'company_person_id = person_id','left');
        
        return $this->db->get($this->_person);
    }
    
    /* Function to get Vendor Company list */
    function getVendorCompany($fields = '*',$condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true ){
        
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_person, 'person_id = company_person_id','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0){
                return $this->db->get($this->_vendor_company, $row_count, $offset);
        }
          return $this->db->get($this->_vendor_company);
        
    }
    
    
    function getNewServiceOrders($now){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->where('booking_service_date >', $now)
                        ->where('booking_vendor_company_id IS NULL', null)             
                        ->where('booking_cancelled_by IS NULL', null)
                        ->where('booking_status', Globals::BOOKING_PROCESSING)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->get()
                        ->result();
    }
    
    
    function getActiveServiceOrders(){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where('booking_completion_admin_confirmed', 0)
                        ->where('booking_cancelled_approved_by_admin', 0)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where('booking_status != '.Globals::BOOKING_PROCESSING)
                        ->get()
                        ->result();
    }
    
    function getServiceBookingDetail($bookingId, $company_id=null){
        $this->db->select('*');
        $this->db->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left');
        $this->db->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left');
        $this->db->join($this->_services, 'service_id = booking_service_id','left');
        $this->db->join($this->_person, 'person_id = booking_user_id','left');
        if($company_id != null){
            $this->db->join($this->_vendor_company, "booking_vendor_company_id = company_id", 'left');
            $this->db->where('company_id', $company_id);
        }
        $this->db->where('booking_id', $bookingId);
     return   $this->db->get($this->_booking)->result();
    }
    
    
    function getCompletedServiceOrders(){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where('booking_completion_admin_confirmed', 1)
                        ->where('booking_status', Globals::BOOKING_COMPLETED)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->get()
                        ->result();
    }
        
    
    function getCanceledBookings(){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where("booking_status ", Globals::BOOKING_CANCELLED)
                        ->where("booking_cancelled_approved_by_admin ", 1)
                        ->where("booking_cancelled_by IS NOT NULL", null)               
                        ->get()
                        ->result();
    }
    
    
    function getAvailableCompaniesForService($service_date){
        
        return $this->db->query("SELECT * FROM `mm_vendor_company` LEFT JOIN `mm_company_employees` ON "
                . "  (`employee_company_id`= `company_id`) WHERE `employee_archived` = '".Globals::UN_ARCHIVE."' AND employee_id NOT IN "
                . " ( SELECT employee_job_employee_id from mm_employee_job "
                . " LEFT JOIN mm_booking on employee_job_booking_id = booking_id "
                . " WHERE booking_service_date = '$service_date') GROUP BY `company_id`")->result();
        
    }
    
    function getAvailableEmployees($companyId, $service_date){
        return $this->db->query("SELECT * FROM `mm_company_employees` "
                . " WHERE `employee_company_id`= '$companyId' AND `employee_archived` = '".Globals::UN_ARCHIVE."' AND employee_id NOT IN "
                . " ( SELECT employee_job_employee_id from mm_employee_job "
                . " LEFT JOIN mm_booking on employee_job_booking_id = booking_id "
                . " WHERE booking_service_date = '$service_date')")->result();
    }
    
    function check_booking_job_is_assigned($bookingId){
        return $this->db->query("SELECT * FROM `mm_booking` "
                . " WHERE `booking_id`= '$bookingId' AND `booking_vendor_company_id` IS NULL")->result();
        
    }
        
}
