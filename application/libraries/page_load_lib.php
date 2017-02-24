<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Page_load Lib is a PHP-functions library. It is generalised functions should run at every page load
 *
 * PHP versions 4 and 5
 *
 * @category	Libraries
 * @package		Nightpocket
 * @author		Vinayak Kadolkar
 * @copyright	Lastshore
 * @license		wilandco
 * @version		1.0
 */
class Page_load_lib {
	function __construct() {
		$this->ci =& get_instance();
		//$this->get_lang();
		//$this->get_url();
		//$this->get_config();
                //$this->check_maintenance();
		//$this->get_json();
		//$this->validate_user();
		//$this->get_subscription_type();
                $this->detect_browser_language();
		//$this->get_metadata();
                
	}
	/**
	 * Sets a language for the User
	 * 
	 */
	function get_lang(){
		$this->ci->lang->load("np","english");
	}
	
	 /**
     * gets all configuration from Database
     */
	function get_config() {
		$config_array = $this->ci->config_model->get('config_name, config_value')->result();
		if(count($config_array) > 0) {
			foreach($config_array as $key => $config) {
				$this->ci->data['config'][$config->config_name] = $config->config_value;
			}	
		}
		
	}
	
	 /**
     * checks maintenance if we need to put the site offline
     */
    function check_maintenance() {
        if(!$this->ci->data['config']['maintenance'])
            return false;
        redirect('maintenance_' . lang_code . '.html', 'refresh');
    }
	 
	  
	/**
     * detect country code by using ip address
     */
    function detect_browser_language() {
    	$this->ci->data['lang_code']='en';
	$this->ci->data['lang_name']='english';
    	$this->ci->data['currency_symbol'] = '$';
        if($this->ci->session->userdata('user_id') || empty($_SERVER['HTTP_HOST']) || empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
            return false;
		
        $this->ci->load->library(array('country_lib'));
		//$browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		//if($browser_lang == '') {
		$browser_lang = $this->ci->country_lib->detectCountryCodeByIP();
		$this->data['user_location']=$browser_lang;
		//}
		if(!$browser_lang || $browser_lang == '')
			return false;
		$cookie_data = array(
		    'name'   => 'country_symbol',
		    'expire' => '2592000'
		);
		//$this->ci->country_lib->isSpanishCountryByCode($browser_lang);
		//$this->ci->data['currency_symbol'] = $this->ci->data['country_spanish_data']->country_european?'€':'$';
       	$cookie_data['value'] = $this->ci->data['currency_symbol'];
       	$this->ci->input->set_cookie($cookie_data);
			
        /*if($this->ci->data['country_spanish_data']->country_spanish_lang) {
            if($_SERVER['HTTP_HOST'] != $this->ci->data['vecto_site_url']['es']) {
                redirect('http://' . $this->ci->data['vecto_site_url']['es'], 'refresh');
            }
        } else {
            if($_SERVER['HTTP_HOST'] != $this->ci->data['vecto_site_url']['en']) {
                redirect('http://' . $this->ci->data['vecto_site_url']['en'], 'refresh');
            }
        }*/
    }

	/**
	 * Validate the User 
	 * Returns true, if user is Valid
	 *
	 * @return	bool
	 */
	function validate_user($user){
		if($user == "") {
			redirect('np_member.html', 'refresh');
		}
		elseif($user==$this->ci->session->userdata('user_type') && $this->ci->session->userdata('user_id')!='')
                {
                    return TRUE;
                }elseif($user!=$this->ci->session->userdata('user_type')){
                        $type = $this->ci->session->userdata('user_type');
                        switch ($type) {
                             case 'administrator':
                                             $redirect_url="home.html";
                                     break;
                             case 'editor':
                                             $redirect_url="Ehome.html";
                                     break;
                             case 'member':
                                             $redirect_url="dashboard.html";
                                     break;
                             case 'manager':
                                             $redirect_url="manager_reservations.html";
                                     break;
                             default: $redirect_url="np_member.html";
                     }
                     redirect($redirect_url, 'refresh');
                }else{
                    redirect($redirect_url, 'refresh');
                }

	}
	
	
	function send_np_email($sender,$recipient,$subject,$message,$config='',$attach=''){
		$this->ci->load->library('email');
		$this->ci->email->clear(TRUE);
		if($config!=''){
			$this->ci->email->initialize($config);
		}
                if($attach!='')
                {
                    $this->ci->email->attach($attach);
                }
		
		$this->ci->email->from($sender);
		$this->ci->email->to($recipient);		
		$this->ci->email->subject($subject);
		$this->ci->email->message($message);
		
		if($this->ci->email->send())
                {
                    return TRUE;
                }else{
                    return FALSE;
                }
		
		//echo $this->ci->email->print_debugger();
	}
        
        
	
	
	
	
	

}