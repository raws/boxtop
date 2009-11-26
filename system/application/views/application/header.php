<html>
<head>
	<title>Wheaties</title>
	<link rel="stylesheet" href="/stylesheets/application.css" type="text/css" />
	<script src="/javascripts/jquery-1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>

<div id="nav">
    <div class="left">
    	<?=anchor('', 'Wheaties', array('class' => 'plain'));?>
    	<?=anchor('factoids', 'Factoids');?>
    	<?=anchor('rum', 'Rum');?>
	</div>
	<div class="right">
	    <?php if ($account = $this->auth->account()): ?>
    	    Logged in as <b><?=$account->username;?></b> (<?=$account->access;?>)
    	    <?=anchor('logout', 'Log out');?>
        <?php else: ?>
            <?=anchor('login', 'Log in');?>
        <?php endif; ?>
    </div>
    <div style="clear: both;"></div>
</div>

<div id="content">
    <?php if ($flashdata_success = $this->session->flashdata('success')): ?>
    <div class="flash success">
        <?=$flashdata_success;?>
    </div>
    <?php endif; ?>
    
    <?php if ($flashdata_error = $this->session->flashdata('error')): ?>
    <div class="flash error">
        <?=$flashdata_error;?>
    </div>
    <?php endif; ?>
