<style type="text/css" media="screen">
	label { width: 150px; }
	a.button.form { margin-left: 160px; }
</style>

<script type="text/javascript" charset="utf-8">
	$(function() {
		$("#register_button").click(function() { $("#register_form").submit(); return false; });
	});
</script>

<?php $this->load->helper('form'); ?>

<?php if (strlen(validation_errors()) > 0): ?>
	<div class="flash error"><?=validation_errors();?></div>
<?php endif; ?>

<form id="register_form" method="post" action="/register">
	<p><label for="username">Username</label><input type="text" name="username" value="<?=set_value('username');?>" /></p>
	<p><label for="password">Password</label><input type="password" name="password" value="<?=set_value('password');?>" /></p>
	<p><label for="password_confirmation">Confirm Password</label><input type="password" name="password_confirmation" value="<?=set_value('password_confirmation');?>" /></p>
	<a id="register_button" class="button add form" href="#">Register</a>
</form>