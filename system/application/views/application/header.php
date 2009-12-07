<html>
<head>
	<title>Wheaties<?php if (isset($title)) { echo " - {$title}"; } ?></title>
	<link rel="stylesheet" href="/stylesheets/application.css" type="text/css" />
	<script src="/javascripts/jquery/jquery-1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/javascripts/jquery/jquery.ajaxify-0.4-min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/javascripts/jquery/jquery.placeholder.js" type="text/javascript" charset="utf-8"></script>
	<script src="/javascripts/common/command_search.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>

	<div id="nav">
		<div class="left">
			<div class="group">
				<p>Wheaties</p>
				
				<a href="/">About</a>
				<a href="/help">Help</a>
			</div>

			<div class="group">
				<p>Commands</p>
				
				<div id="nav_command_search">
					<form id="nav_command_search_form" method="post" action="/search" target="#nav_command_search_results">
						<input id="nav_command_search_query" class="placeholder" placeholder="Search" type="text" name="query" value="" autocomplete="off" />
					</form>
					
					<div id="nav_command_search_results">
					    <div class="message">Begin typing to search!</div>
					</div>
				</div>
				
				<?php if ($this->auth->authorize('helper', FALSE)): ?>
					<a href="/snippets/new">New Snippet</a>
				<?php endif; ?>
			</div>
		</div>

		<div class="right">
			<div class="group">
				<p>Account</p>
				
				<?php if ($account = $this->auth->account()): ?>
					<p class="plain"><?=$account->username;?> (<?=$account->access;?>)</p>
					<a href="/logout">Log out</a>
				<?php else: ?>
					<p class="plain">Guest</p>
					<a href="/login">Log in</a>
					<a href="/register">Register</a>
				<?php endif; ?>
			</div>
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