<?php
$this->load->helper('form');
$this->load->view('application/header', array('title' => 'Log In'));
?>

<script type="text/javascript" charset="utf-8">
	$(function() {
		// Bind log in button to form submission.
		$("#login_button").click(function() { $("#login_form").submit(); return false; });
		
		// Give username input focus.
		$("input[name='username']:first").focus();
	});
</script>

<h1>Log in</h1>

<p>Log in using your Wheaties account.</p>

<form id="login_form" method="post" action="/login">
	<p><label for="username">Username</label><input type="text" name="username" value="<?=set_value('username');?>" /></p>
	<p><label for="password">Password</label><input type="password" name="password" value="<?=set_value('password');?>" /></p>
	<a id="login_button" class="button save form" href="#">Log in</a>
</form>

<h2>Don't have an account?</h2>

No problem! Fill in the form below, and we'll get you registered.

<?php
	$this->load->view('session/_register');
	$this->load->view('application/footer');
?>