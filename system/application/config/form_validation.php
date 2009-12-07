<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
        'session/register' => array(
                array(
                    'field' => 'username',
                    'label' => 'username',
                    'rules' => 'trim|required|min_length[3]|max_length[50]|xss_clean|callback_username_check'
                ),
                array(
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'trim|required|min_length[6]'
                ),
                array(
                    'field' => 'password_confirmation',
                    'label' => 'password confirmation',
                    'rules' => 'trim|required|matches[password]'
                )
            )
    );