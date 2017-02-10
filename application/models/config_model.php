<?php
class Config_model extends backend_model 
{
	function __construct() {
		parent::__construct();
		$this->_table = 'np_config';
	}
}

?>