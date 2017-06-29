<?php

class User_model extends Mm_model {

    function __construct() {
        parent::__construct();
        $this->_table                   = 'mm_user';
        $this->_person_table            = 'mm_person';
        $this->_person_type_table       = 'mm_person_type';
        $this->_country_table           = 'mm_country';
        $this->_lang_table              = 'mm_language';
        $this->_vendor_service_location_table = 'mm_vendor_service_location';
        $this->_vendor_company          = "mm_vendor_company";
        $this->_service_package         = "mm_service_package";
        $this->_service_frequency_offer = "mm_service_frequency_offer";
        $this->_service_frequency           = "mm_service_frequency";
        $this->_service_addon_price         = "mm_service_addon_price";
        $this->_service_addon               = "mm_service_addon";
        $this->_service_spl_request         = "mm_service_spl_request";
        $this->_spl_request                 = "mm_spl_request";
        $this->_postcode_service_price      = "mm_postcode_service_price";
        $this->_building                = "mm_building";
        $this->_area                    = "mm_area";
        $this->_booking                             = "mm_booking";
        $this->_booking_addons                      = "mm_booking_addons";
        $this->_booking_spl_request                 = "mm_booking_spl_request";
        $this->_services                            = "mm_services";
        
    }

    function check_email($email) {
        return $this->db->select('user_email')
                        ->from($this->_table)
                        ->where('user_email', $email)
                        ->get()
                        ->result();
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
    
    
    function getUserActiveBookings($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where('booking_user_id', $person_id)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where(" ( booking_status = ".Globals::BOOKING_CONFIRMED." OR booking_status = ".Globals::BOOKING_PROCESSING." ) ")
                        ->get()
                        ->result();
    }
    
    function getUserCanceledBookings($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where('booking_user_id', $person_id)
                        ->where("booking_status ", Globals::BOOKING_CANCELLED)
                        ->get()
                        ->result();
    }
    
    function getUserCompletedBookings($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        ->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        ->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->where('booking_user_id', $person_id)
                        ->where("booking_status ", Globals::BOOKING_COMPLETED)
                        ->where("booking_completion_user_comfirmed ", '1')
                        ->get()
                        ->result();
    }


}
