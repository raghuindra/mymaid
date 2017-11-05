<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Application specific global variables
class Globals
{
    const ROLE_USER                 = 'ROLE_USER';
    const ROLE_VENDOR               = 'ROLE_VENDOR';
    const ROLE_ADMIN                = 'ROLE_ADMIN';
    const ROLE_FREELANCER           = 'ROLE_FREELANCER';
    const ROLE_SUPER_ADMIN          = 'ROLE_SUPER_ADMIN';

    const ROLE_USER_ID              = 1;
    const ROLE_VENDOR_ID            = 3;
    const ROLE_ADMIN_ID             = 2;
    const ROLE_FREELANCER_ID        = 4;
    const ROLE_SUPER_ADMIN_ID       = 5;
    
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
    const SESSION_FULL_DAY          = 1;
    const SESSION_MORNING           = 2;
    const SESSION_AFTERNOON         = 3;
    const SESSION_EVENING           = 4;
    const SESSION_FULL_DAY_NAME     = "Full-day (9am - 6pm)";
    const SESSION_MORNING_NAME      = "4 hours - Morning";
    const SESSION_AFTERNOON_NAME    = "4 hours - Afternoon";
    const SESSION_EVENING_NAME      = "2 hours - Evening";
    
    //frequency types
    const FREQUENCY_WEEKLY  = 'weekly';
    const FREQUENCY_BIWEEKLY = 'biweekly';
    
    //Payment Status
    const PAYMENT_SUCCESS   = 1;
    const PAYMENT_FAILURE   = 0;
    const PAYMENT_PENDING   = 2;
    
    //Booking Status
    const BOOKING_PROCESSING    = 2;
    const BOOKING_CONFIRMED     = 1;
    const BOOKING_CANCELLED     = 3;
    const BOOKING_COMPLETED     = 4;
    
    //Wallet Types
    const WALLET_CREDIT     = 'c';
    const WALLET_DEBIT      = 'd';
    
    //Withdrawal request Status
    const WALLET_WITHDRAWAL_REQUEST_PROCESSING = 0;
    const WALLET_WITHDRAWAL_REQUEST_REJECTED   = 1;
    const WALLET_WITHDRAWAL_REQUEST_APPROVED   = 2;


    public static function getPersonTypeName($person_type_id){
        
        switch ($person_type_id){
            case self::PERSON_TYPE_USER : return self::PERSON_TYPE_USER_NAME; 
            case self::PERSON_TYPE_VENDOR : return self::PERSON_TYPE_VENDOR_NAME;
            case self::PERSON_TYPE_ADMIN : return self::PERSON_TYPE_ADMIN_NAME;
            case self::PERSON_TYPE_FREELANCER : return self::PERSON_TYPE_FREELANCER_NAME;
                
        }
        
    }
    
    public static function getSessionNamesArray(){
        
        return array(self::SESSION_FULL_DAY_NAME, self::SESSION_MORNING_NAME, self::SESSION_AFTERNOON_NAME, self::SESSION_EVENING_NAME);
        
    }
    
    public static function getSessionName($sessionId){
      
        switch ($sessionId){
            case self::SESSION_FULL_DAY : return self::SESSION_FULL_DAY_NAME; 
            case self::SESSION_MORNING : return self::SESSION_MORNING_NAME;
            case self::SESSION_AFTERNOON : return self::SESSION_AFTERNOON_NAME;
            case self::SESSION_EVENING : return self::SESSION_EVENING_NAME;
                
        }
    }
    
}