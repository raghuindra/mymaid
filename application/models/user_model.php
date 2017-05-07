<?php

class User_model extends Mm_model {

    function __construct() {
        parent::__construct();
        $this->_table                   = 'mm_user';
        $this->_person_table            = 'mm_person';
        $this->_country_table           = 'mm_country';
        $this->_lang_table              = 'mm_language';
        $this->_vendor_service_location_table = 'mm_vendor_service_location';
        $this->_service_package         = "mm_service_package";
        $this->_service_frequency_offer = "mm_service_frequency_offer";
        $this->_service_frequency           = "mm_service_frequency";
        $this->_service_addon_price         = "mm_service_addon_price";
        $this->_service_addon               = "mm_service_addon";
        $this->_service_spl_request         = "mm_service_spl_request";
        $this->_spl_request                 = "mm_spl_request";
        $this->_postcode_service_price      = "mm_postcode_service_price";
        
    }

    function check_email($email) {
        return $this->db->select('user_email')
                        ->from($this->_table)
                        ->where('user_email', $email)
                        ->get()
                        ->result();
    }
    
    function getServicePackages($serviceIds, $postcode){
        return $this->db->select('*')
                        ->from($this->_service_package)
                        ->join($this->_postcode_service_price, 'postcode_service_price_package_id = service_package_id','left')
                        ->where('service_package_archive', Globals::UN_ARCHIVE)
                        ->where_in('service_package_service_id', $serviceIds)
                        ->or_where('postcode_service_price_postcode', $postcode)
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


}
