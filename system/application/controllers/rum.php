<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Rum extends Controller {

	function __construct() {
		parent::Controller();
		
		$this->load->scaffolding('rum_snippets');
	}
	
}