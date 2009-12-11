<?php
$this->load->helper('text');

$title = 'Factoids' . (isset($title) ? ' - ' . character_limiter($title, 10) : '');
$this->load->view('application/header', array('title' => $title));
?>

<h1>Factoids</h1>