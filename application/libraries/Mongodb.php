<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Author: https://roytuts.com
*/

class MongoDB {
	
	private $conn;
	function __construct() {
		$this->ci =& get_instance();
		$this->ci->load->config('mongodb');
		
		$host = $this->ci->config->item('host');
		print_r($host);
		$port = $this->ci->config->item('port');
		print_r($port);
		$username = $this->ci->config->item('username');
		$password = $this->ci->config->item('password');
		$this->ci->conn = new MongoDB\Driver\Manager('mongodb://' . $host. ':' . $port);
	}
	
	function getConn() {
		return $this->ci->conn;
	}
	
}