<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bodhi_Controller extends CI_Controller {
	protected $events = array();
	protected $event_groups = array();
	
    function Bodhi_Controller()
    {
        parent::__construct();
		$this->db->cache_off();
		date_default_timezone_set('Asia/Kolkata');
    }
}