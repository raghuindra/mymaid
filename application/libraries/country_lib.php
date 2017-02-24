<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country_lib {
    function __construct() {
        $this->ci =& get_instance();
        $this->ci->load->model('country_model');
    }
    
    /**
     * gets country dropdown list
     */
    function getCountryList($get_dropdown = true) {
        $this->ci->load->model('country_model');
        $this->ci->data['country_list_all'] = $this->ci->country_model->get('country_id, country_name_en as country_name, country_code', array(), 'country_name')->result();
        if(!$get_dropdown)
            return false;
        //$this->ci->data['country_list'][''] = $this->ci->lang->line('vecto_label_dropdown_default');
        if(count($this->ci->data['country_list_all']) > 0) {
            foreach($this->ci->data['country_list_all'] as $key => $country) {
                $this->ci->data['country_list'][$country->country_id] = $country->country_name;
            }
        }
    }
    
    /**
     * Checks whether the user's spoken language is spanish or not 
     * 
     * @$country_id country id
     */
    function isSpanishCountry($country_id = 0) {
        $this->ci->data['email']['lang'] = 'us';
        $this->ci->data['email_lang_line_obj'] = $this->ci->lang->line($this->ci->data['email']['lang']);
        if($country_id == 0) 
            return false;
        $this->ci->data['country_lang'] = $this->ci->country_model->get('country_code', array('country_id' => $country_id, 'country_spanish_lang' => 1))->row();
        if(!empty($this->ci->data['country_lang'])) {
            $this->ci->data['email']['lang'] = 'es'; 
            $this->ci->data['email_lang_line_obj'] = $this->ci->lang->line($this->ci->data['email']['lang']);
            return true;
        }
        return false;
    }
    
    /**
     * checks the spanish language
     */
    function isSpanishCountryBySpanishFlag($country_spanish_lang = 0) {
        $this->ci->data['email']['lang'] = 'us';
        $this->ci->data['email_lang_line_obj'] = $this->ci->lang->line($this->ci->data['email']['lang']);
        if($country_spanish_lang) {
            $this->ci->data['email']['lang'] = 'es'; 
            $this->ci->data['email_lang_line_obj'] = $this->ci->lang->line($this->ci->data['email']['lang']);
            return true;
        }
        return false;
    }
	
	/**
     * Checks whether the user is from spanish or not 
     * 
     * @$country_code country code
     */
    function isSpanishCountryByCode($country_code = 'us') {
        $this->ci->data['country_spanish_data'] = $this->ci->country_model->get('country_id, country_spanish_lang, country_european', array('country_code' => $country_code))->row();
        if(!empty($this->ci->data['country_spanish_data'])) {
            return true;
        }
		$this->ci->data['country_spanish_data']->country_spanish_lang = 0;
		$this->ci->data['country_spanish_data']->country_european = 0;
        return false;
    }

    /**
     * Checks whether the user's spoken language is spanish or not 
     * 
     * @$country_id country id
     */
    function isEuropeanCountry($country_code = "") {
        if($country_code == "") 
            return false;
        $country_data = $this->ci->country_model->get('country_id', array('country_code' => $country_code))->row();
        if(!empty($country_data)) {
            return true;
        }
        return false;
    }
	
	 /**
     * Checks whether the user's region is eu or not 
     * 
     * @$country_id country id
     */
    function europeanCountry($country_code = "") {
        if($country_code == "") 
            return false;
        $country_data = $this->ci->country_model->get('country_id,country_european', array('country_code' => $country_code))->row();
       $region=''; 
        if(!empty($country_data)) {
           	if($country_data->country_european==0){
           		$region='us';
           }else{
           		$region='es';	
           	}
        }
        return $region;
    }
	
    /**
     * detects the country id by ip address
     */
	function detectCountryCodeByIP() {
		if(empty($_SERVER))
			return false;
		$this->ci->load->model('ip2nation_model');
		$this->ci->db->where('ip2nation_ip < ', 'INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '")', false);
		$ip2nation_data = $this->ci->ip2nation_model->get('ip2nation_country', array(), 'ip2nation_ip desc', 0, 1)->row();
		if(empty($ip2nation_data))
			return false;
		return $ip2nation_data->ip2nation_country;
	}
    
    /**
     * gets country list. It is including whether the country is european or not 
     */
    function getCountryEuropeanList() {
        $this->ci->load->model('country_model');
        $country_array = $this->ci->country_model->get('country_id, country_name_en as country_name, country_european', array(), 'country_name')->result();
        $this->ci->data['country_list'][''] = $this->ci->lang->line('vecto_label_dropdown_default');
        if(count($country_array) > 0) {
            foreach($country_array as $key => $country) {
                $this->ci->data['country_list'][$country->country_id . '-' . $country->country_european] = $country->country_name;
            }
        }
    }
	
    /**
     * finds currency symbol
     */
	function findCurrency($user_country_european = 0){
		$this->ci->data['currency_symbol'] = '$';
        if($user_country_european) {
			$this->ci->data['currency_symbol'] = '€';
        }
    }
}

/* End of file character_fix_lib */
/* Location: ./application/libraries/country_lib.php */