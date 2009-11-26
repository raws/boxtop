<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Session extends Controller {

	function __construct() {
		parent::Controller();
	}
	
	function login() {
	    if ($this->auth->logged_in()) {
	        $this->session->set_flashdata('error', "You're already logged in!");
	        redirect();
	    }
	    
	    if ($username = $this->input->post('username')) {
	        $data = array();
	        
	        $password = $this->input->post('password');
	        
	        if ($this->auth->login($username, $password)) {
	            $this->session->set_flashdata('success', "You've logged in successfully!");
	            
	            $return = ($this->session->flashdata('return') ? $this->session->flashdata('return') : '');
	            redirect($return);
	        } else {
	            $this->session->set_flashdata('error', "Oops! Login failed. Perhaps you made a typo?");
	            $this->session->keep_flashdata('return');
	            
	            redirect('login');
	        }
	    } else {
	        $this->session->keep_flashdata('return');
	        
	        $this->load->view('session/login');
	    }
	}
	
	function logout() {
	    if ($this->auth->logged_out()) {
	        $this->session->set_flashdata('error', "You're not logged in!");
	        redirect();
	    }
	    
	    if ($this->auth->logout()) {
	        $this->session->set_flashdata('success', "You've been logged out!");
	    } else {
	        $this->session->set_flashdata('error', "Oops! An error occurred while attempting to log you out.");
	    }
	    
	    redirect();
	}
	
}
