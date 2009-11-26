<?php

if (! defined('BASEPATH')) exit('No direct script access');

class MY_Input extends CI_Input {
	function is_ajax_request() {
		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
	}
}
