<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
        'session/register' => array(
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required'
                )
            )
    );