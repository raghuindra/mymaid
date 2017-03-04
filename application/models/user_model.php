<?php

class User_model extends Mm_model{
    
    function __construct() {
        parent::__construct();
        $this->_table = 'mm_user';
        $this->_person_table = 'mm_person';
        $this->_country_table = 'mm_country';
        $this->_lang_table  = 'mm_language';
    }
    
    function check_email($email)
    {
          return $this->db->select('user_email')
                    ->from($this->_table)
                    ->where('user_email',$email)
                    ->get()
                    ->result();

    }
        
        
}
