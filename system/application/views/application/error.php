<?php $this->load->view('application/header', array('title' => 'Error')); ?>

<h1>Error</h1>

<?php
$this->load->view('application/_error');
$this->load->view('application/footer');
?>