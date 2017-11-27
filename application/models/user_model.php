<?php

class User_model extends Mm_model {

    function __construct() {
        parent::__construct();
        $this->_table                   = 'mm_user';
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
                        //->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        //->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_person, 'person_id = booking_user_id','left')
                        ->where('booking_id ', $bookingId)
                        ->get()
                        ->result();
    }
    
    
    function getUserActiveBookings($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        //->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        //->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->join($this->_employee_job, 'employee_job_booking_id = booking_id','left')
                        ->join($this->_company_employees, 'employee_id = employee_job_employee_id','left')
                        ->where('booking_user_id', $person_id)
                        ->where('booking_payment_status', Globals::PAYMENT_SUCCESS)
                        ->where(" ( booking_status = ".Globals::BOOKING_CONFIRMED." OR booking_status = ".Globals::BOOKING_PROCESSING." ) ")
                        ->group_by('booking_id')
                        ->order_by("booking_id", "desc")
                        ->get()
                        ->result();
    }
    
    function getUserCanceledBookings($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        //->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        //->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->join($this->_employee_job, 'employee_job_booking_id = booking_id','left')
                        ->join($this->_company_employees, 'employee_id = employee_job_employee_id','left')
                        ->where('booking_user_id', $person_id)
                        ->where("booking_status ", Globals::BOOKING_CANCELLED)
                        ->group_by('booking_id')
                        ->order_by("booking_id", "desc")
                        ->get()
                        ->result();
    }
    
    function getUserCompletedBookings($person_id){
        return $this->db->select('*')
                        ->from($this->_booking)
                        //->join($this->_booking_addons, 'booking_addons_booking_id = booking_id','left')
                        //->join($this->_booking_spl_request, 'booking_spl_request_booking_id = booking_id','left')
                        ->join($this->_services, 'service_id = booking_service_id','left')
                        ->join($this->_vendor_company, 'company_id = booking_vendor_company_id','left')
                        ->join($this->_employee_job, 'employee_job_booking_id = booking_id','left')
                        ->join($this->_company_employees, 'employee_id = employee_job_employee_id','left')
                        ->where('booking_user_id', $person_id)
                        ->where("booking_status ", Globals::BOOKING_COMPLETED)
                        //->where("booking_completion_user_comfirmed ", '1')
                        ->group_by('booking_id')
                        ->order_by("booking_id", "desc")
                        ->get()
                        ->result();
    }

    function getLastDateofServiceDate($booking_id){
        return $this->db->query("SELECT MAX(`booking_sessions_service_date`) as `service_date` FROM `mm_booking_sessions` WHERE `booking_sessions_booking_id` = '$booking_id' ")->result();
    }


}
