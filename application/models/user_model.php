<?php

class User_model extends Np_model{
    
    function __construct() {
        parent::__construct();
        $this->_table = 'mm_user';
        $this->_person_table = 'mm_person';
        $this->_country_table = 'mm_country';
        $this->_lang_table  = 'mm_language';
    }
        
        
}
