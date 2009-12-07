<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Session extends Controller {

	function __construct() {
		parent::Controller();
	}
	
	function login() {
	    if ($this->auth->logged_in()) { redirect(); }
	    
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
	    if ($this->auth->logged_out()) { redirect(); }
	    
	    if ($this->auth->logout()) {
	        $this->session->set_flashdata('success', "You've been logged out!");
	    } else {
	        $this->session->set_flashdata('error', "Oops! An error occurred while attempting to log you out.");
	    }
	    
	    redirect();
	}
	
	function register() {
		if ($this->auth->logged_in()) { redirect(); }
		
		$this->load->library('form_validation');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('session/register');
		} else {
		    $this->load->model('session/account', 'account');
		    
			$username = $this->input->post('username');
			$password = $this->input->post('password');
		    
		    if ($this->account->register($username, $password)) {
		        $this->session->set_flashdata('success', "You've been successfully registered, {$username}! You may now log in.");
    			redirect('login');
		    } else {
		        $this->session->set_flashdata('error', "Oops! An error occurred while attempting to register you. Please try again!");
		        $this->load->view('session/register');
		    }
		}
	}
	
	function username_check($username) {
	    $query = $this->db->get_where('session_accounts', array('username' => $username));
	    
	    if ($query->num_rows() > 0) {
	        $this->form_validation->set_message('username_check', "The username \"{$username}\" is already in use.");
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}
	
}
