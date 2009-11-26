<?php

if (! defined('BASEPATH')) exit('No direct script access');

class Auth {
    
    private $ci;
    
    function __construct() {
        $this->ci =& get_instance();
        
        $this->ci->load->model('session/account', 'account');
    }
    
    function login($username, $password) {
        return $this->ci->account->login($username, $password);
    }
    
    function logout() {
        return $this->ci->account->logout();
    }
    
    function account() {
        $account_id = $this->ci->session->userdata('account_id');
        
        if ($account_id) {
            return $this->ci->account->account_by_id($account_id);
        } else {
            return FALSE;
        }
    }
    
    function access() {
        if ($account = $this->account()) {
            return $account->access;
        } else {
            return 0;
        }
    }
    
    function logged_in() {
        return $this->access() > 0;
    }
    
    function logged_out() {
        return $this->access() <= 0;
    }
    
    function authorize($required_access = 1) {
        $required_access = $this->access_val($required_access);
        $effective_access = 0;
        
        if ($account = $this->account()) {
            $effective_access = $account->access;
        }
        
        if ($effective_access >= $required_access) {
            return TRUE;
        } else {
            if ($effective_access > 0) {
                // User is logged in, but does not have sufficient access.
                $this->ci->session->set_flashdata('error', "Oops! You do not have the appropriate access to do that.");
                
                redirect();
            } else {
                // User is not logged in.
                $this->ci->session->set_flashdata('return', $this->ci->uri->uri_string());
                $this->ci->session->set_flashdata('error', "Oops! You must log in to do that.");
                
                redirect('login');
            }
            
            return FALSE;
        }
    }
    
    function access_val($access) {
        switch ($access) {
            case 'owner':
                $access = 500;
                break;
            case 'admin':
                $access = 400;
                break;
            case 'mod':
                $access = 300;
                break;
            case 'helper':
                $access = 200;
                break;
            case 'peon':
                $access = 100;
                break;
            default:
                $access = (is_numeric($access) ? intval($access) : 1);
        }
        
        return $access;
    }
    
}