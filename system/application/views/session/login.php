<?php
$this->load->helper('form');

$this->load->view('application/header');
?>

<h1>Log in</h1>

<?=form_open('login');?>

<p><?=form_label('Username', 'username') . form_input('username', '');?></p>
<p><?=form_label('Password', 'password') . form_password('password', '');?></p>

<?=form_submit('login', 'Log in');?>
</form>

<?php $this->load->view('application/footer'); ?>