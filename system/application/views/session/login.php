<?php
$this->load->helper('form');
$this->load->view('application/header');
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

<?=form_open('login', array('id' => 'login_form'));?>
	<p><?=form_label('Username', 'username') . form_input('username', '');?></p>
	<p><?=form_label('Password', 'password') . form_password('password', '');?></p>
	<a id="login_button" class="button save form" href="#">Log in</a>
</form>

<h2>Don't have an account?</h2>

No problem! Fill in the form below, and we'll get you registered.

<?php
	$this->load->view('session/_register');
	$this->load->view('application/footer');
?>