<?php

class Booking_model extends Mm_model {

    function __construct() {
        parent::__construct();
        $this->_table                           = 'mm_user';
        $this->_person_table                    = 'mm_person';
        $this->_person_type_table               = 'mm_person_type';
        $this->_country_table                   = 'mm_country';
        $this->_lang_table                      = 'mm_language';
        $this->_vendor_service_location_table   = 'mm_vendor_service_location';
        $this->_services                        = "mm_services";
        $this->_service_package                 = "mm_service_package";
        $this->_service_frequency_offer         = "mm_service_frequency_offer";
        $this->_service_frequency               = "mm_service_frequency";
        $this->_service_addon_price             = "mm_service_addon_price";
        $this->_service_addon                   = "mm_service_addon";
        $this->_service_spl_request             = "mm_service_spl_request";
        $this->_spl_request                     = "mm_spl_request";
        $this->_postcode_service_price          = "mm_postcode_service_price";
        $this->_building                        = "mm_building";
        $this->_area                            = "mm_area";
        $this->_booking                         = "mm_booking";
        $this->_booking_addons                  = "mm_booking_addons";
        $this->_booking_spl_request             = "mm_booking_spl_request";
        
        
    }

    function check_email($email) {
        return $this->db->select('user_email')
                        ->from($this->_table)
                        ->where('user_email', $email)
                        ->get()
                        ->result();
    }
    
    function getServicePackages($serviceIds){
        return $this->db->select('*')
                        ->from($this->_service_package)
                        ->join($this->_building, 'building_id = service_package_building_id','left')
                        ->join($this->_area, 'area_id = service_package_building_area_id','left')
                        ->where('service_package_archive', Globals::UN_ARCHIVE)
                        ->where_in('service_package_service_id', $serviceIds)
                        ->get()
                        ->result();
        
    }
    
    function getPackagePostcodePrice($packageId, $postcode){
        return $this->db->select('*')
                        ->from($this->_postcode_service_price)                       
                        ->where('postcode_service_archived', Globals::UN_ARCHIVE)
                        ->where('postcode_service_price_package_id', $packageId)
                        ->where('postcode_service_price_postcode', $postcode)
                        ->get()
                        ->result();
    }
            
    function getServiceFrequencies($serviceIds){
        return $this->db->select('*')
                        ->from($this->_service_frequency_offer)
                        ->join($this->_service_frequency, 'service_frequency_id = service_frequency_offer_frequency_id','left')
                        ->where('service_frequency_offer_archived', Globals::UN_ARCHIVE)
                        ->where('service_frequency_archived', Globals::UN_ARCHIVE)
                        ->where_in('service_frequency_offer_service_id', $serviceIds)
                        ->get()
                        ->result();
    }
    
    function getServiceAddons($serviceIds){
        return $this->db->select('*')
                        ->from($this->_service_addon_price)
                        ->join($this->_service_addon, 'service_addon_id = service_addon_price_addon_id','left')
                        ->where('service_addon_price_archived', Globals::UN_ARCHIVE)
                        ->where('service_addon_archived', Globals::UN_ARCHIVE)
                        ->where_in('service_addon_price_service_id', $serviceIds)
                        ->get()
                        ->result();
    }
    
    function getServiceSplRequests($serviceIds){
        
        return $this->db->select('*')
                        ->from($this->_service_spl_request)
                        ->join($this->_spl_request, 'spl_request_id = service_spl_request_spl_request_id','left')
                        ->where('service_spl_request_archived', Globals::UN_ARCHIVE)
                        ->where('spl_request_archived', Globals::UN_ARCHIVE)
                        ->where_in('service_spl_request_service_id', $serviceIds)
                        ->get()
                        ->result();
    }
    
    
    function getVendorAndServiceDetails($pincode){
        return $this->db->select('*')
                        ->from($this->_vendor_service_location_table)
                        ->join($this->_person_table, 'vendor_service_location_vendor_id = person_id','left')
                        ->where('vendor_service_location_postcode', $pincode)
                        ->where('vendor_service_location_archived', Globals::UN_ARCHIVE)
                        ->get()
                        ->result();
    }
    
    function getUserDetails($fields = 'person_id', $condition = array(), $order = '', $offset = 0, $row_count = 0, $filter = true){
        $this->db->select($fields); 
        if(count($condition) > 0) {
            foreach($condition as $key => $cond) {
                    $this->db->where($key, $cond, $filter);
            }	
        }
        $this->db->join($this->_table, 'user_person_id = person_id','left');
        $this->db->join($this->_person_type_table, 'person_type_id = person_type','left');
        
        $order != ''?$this->db->order_by($order):null;
        if ($offset >= 0 AND $row_count > 0)
                return $this->db->get($this->_person_table, $row_count, $offset);
          return $this->db->get($this->_person_table);
         //$this->db->last_query();
    }
    
    function getServiceBookingDetail($bookingId){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person_table, 'person_id = booking_user_id','left')
                        ->where('booking_id ', $bookingId)
                        ->get()
                        ->result();
    }


}
