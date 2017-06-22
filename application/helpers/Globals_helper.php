<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Application specific global variables
class Globals
{
    const ROLE_USER                 = 'ROLE_USER';
    const ROLE_VENDOR               = 'ROLE_VENDOR';
    const ROLE_ADMIN                = 'ROLE_ADMIN';
    const ROLE_FREELANCER           = 'ROLE_FREELANCER';
    
    const PERSON_TYPE_USER          = 1;
    const PERSON_TYPE_VENDOR        = 2;
    const PERSON_TYPE_ADMIN         = 3;
    const PERSON_TYPE_FREELANCER    = 4;
    
    const PERSON_TYPE_USER_NAME          = 'user';
    const PERSON_TYPE_VENDOR_NAME        = 'vendor';
    const PERSON_TYPE_ADMIN_NAME         = 'admin';
    const PERSON_TYPE_FREELANCER_NAME    = 'freelancer';
    
    const ARCHIVE                   = 1;
    const UN_ARCHIVE                = 0;
    
    const FREQUENCY_OFFER_IN_PERCENTAGE = "Percentage";
    const FREQUENCY_OFFER_IN_PRICE      = "Price";
    
    const EMPLOYEE_FULLTIME         = 1;
    const EMPLOYEE_PARTTIME         = 2;
    
    //Payment Status
    const PAYMENT_SUCCESS   = 1;
    const PAYMENT_FAILURE   = 0;
    const PAYMENT_PENDING   = 2;
    
    //Booking Status
    const BOOKING_PROCESSING    = 2;
    const BOOKING_CONFIRMED     = 1;
    const BOOKING_CANCELLED     = 3;
    const BOOKING_COMPLETED     = 4;


    public static function getPersonTypeName($person_type_id){
        
        switch ($person_type_id){
            case self::PERSON_TYPE_USER : return self::PERSON_TYPE_USER_NAME; 
            case self::PERSON_TYPE_VENDOR : return self::PERSON_TYPE_VENDOR_NAME;
            case self::PERSON_TYPE_ADMIN : return self::PERSON_TYPE_ADMIN_NAME;
            case self::PERSON_TYPE_FREELANCER : return self::PERSON_TYPE_FREELANCER_NAME;
                
        }
        
    }
    
}