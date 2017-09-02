<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Googleplus_lib {
	
	public function __construct() {
		
		$CI =& get_instance();
		$CI->config->load('googleplus');
		
		require_once APPPATH .'third_party/google_api/autoload.php';
		
		$this->client = new Google_Client();
		$this->client->setApplicationName($CI->config->item('application_name', 'googleplus'));
		$this->client->setClientId($CI->config->item('client_id', 'googleplus'));
		$this->client->setClientSecret($CI->config->item('client_secret', 'googleplus'));
		$this->client->setRedirectUri($CI->config->item('redirect_uri', 'googleplus'));
		$this->client->setDeveloperKey($CI->config->item('api_key', 'googleplus'));
		$this->client->setScopes($CI->config->item('scopes', 'googleplus'));
		$this->client->setAccessType('online');
		$this->client->setApprovalPrompt('auto');
		//$this->oauth2 = new apiOauth2Service($this->client);

	}
	
	public function loginURL() {
        return $this->client->createAuthUrl();
    }
	
	public function getAuthenticate() {
        return $this->client->authenticate();
    }
	
	public function getAccessToken() {
        return $this->client->getAccessToken();
    }
	
	public function setAccessToken() {
        return $this->client->setAccessToken();
    }
	
	public function revokeToken() {
        return $this->client->revokeToken();
    }
	
	public function getUserInfo() {
        return $this->oauth2->userinfo->get();
    }

    public function verifyToken($id_token){
    	$payload = $this->client->verifyIdToken($id_token);
print_r($payload);
		if ($payload) {
		  $response = array('status'=>true, 'data'=>$payload);
		  
		} else {
		  $response = array('status'=>false, 'data'=>array());
		}
		return $response;
    }
	
}
?>