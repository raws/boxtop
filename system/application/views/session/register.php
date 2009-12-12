<?php $this->load->view('application/header', array('title' => 'Register')); ?>

<script type="text/javascript" charset="utf-8">
	$(function() {
		$("input[name='username']:first").focus();
	});
</script>

<h1>Register</h1>

<p>Your Wheaties account will give you access to additional features. Oh boy!</p>

<?php
$this->load->view('session/_register');
$this->load->view('application/footer');
?>