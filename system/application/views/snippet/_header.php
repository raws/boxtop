<style type="text/css" media="screen">
	@import url("/stylesheets/inc.snippet.css");
</style>

<?php
$this->load->helper('text');

$title = 'Snippets' . (isset($title) ? ' - ' . character_limiter($title, 10) : '');
$this->load->view('application/header', array('title' => $title));
?>

<h1>Snippets</h1>