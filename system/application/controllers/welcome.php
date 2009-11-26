<?php

if (! defined('BASEPATH')) exit('No direct script access');

class Welcome extends Controller {

	function __construct() {
		parent::Controller();	
	}
	
	function index() {
		$this->load->view('welcome/index');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */