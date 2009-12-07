<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Account extends Model {
    
    const accounts_table = 'session_accounts';
    
    function __construct() {
        parent::Model();
    }
    
    function login($username, $password) {
        $query = $this->db->get_where(Account::accounts_table, array('username' => $username), 1);
        
        if ($query->num_rows() > 0) {
            $account = $query->row();

            $crypted_password = $this->encrypt($password);
            if ($crypted_password == $account->crypted_password) {
                $this->session->set_userdata('account_id', $account->id);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    function logout() {
        if ($this->session->userdata('account_id')) {
            $this->session->unset_userdata('account_id');
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function register($username, $password) {
        $data = array(
                'username' => $username,
                'crypted_password' => $this->encrypt($password),
                'persistence_token' => $this->persistence_token()
            );
        
        $this->db->insert(Account::accounts_table, $data);
        
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function account_by_id($account_id) {
        $query = $this->db->get_where(Account::accounts_table, array('id' => $account_id), 1);
        
        if ($query->num_rows() > 0) {
            $account = $query->row();
            return $account;
        } else {
            return FALSE;
        }
    }
    
    function encrypt() {
        if (func_num_args() == 0) {
            return FALSE;
        }
        
        $tokens = func_get_args();
        $digest = implode(null, $tokens);
        
        for ($i = 0; $i < 20; $i++) {
            $digest = hash('sha512', $digest);
        }
        
        return $digest;
    }
    
    function persistence_token() {
        return $this->encrypt(rand());
    }

}
