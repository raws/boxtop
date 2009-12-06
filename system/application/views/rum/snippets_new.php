<?php
$this->load->helper('form');
$this->load->view('application/header');
$this->load->view('rum/_snippets_header');
?>

<h2>New snippet</h2>

<script src="/javascripts/jquery.elastic.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$("#save_snippet").click(function() {
			$("#new_snippet_form").submit();
			return false;
		});
		
		$("#name_args_wrapper input").focus(function() {
		   $(this).parent().addClass("focus"); 
		}).blur(function() {
		    $(this).parent().removeClass("focus");
		});
		
		$("#snippet_body").focus(function() {
		    $(this).parent().addClass("focus");
		}).blur(function() {
		    $(this).parent().removeClass("focus");
		});
		
		$("#snippet_body").elastic();
		
		$("#snippet_name").focus();
	});
</script>

<?=validation_errors();?>

<?=form_open('snippets/new', array('id' => 'new_snippet_form'));?>

<h4>Name and arguments</h4>
<p>The name of the snippet is effectively its "method name." Arguments are optional.</p>

<div id="name_args_wrapper" class="input_wrapper" style="padding: 10px; line-height: 0;">
	<input id="snippet_name" type="text" name="name" value="<?=set_value('name');?>" />
	<span class="snippet_argument_parenthesis">(</span>
	<input id="snippet_arguments" type="text" name="arguments" value="<?=set_value('arguments');?>" />
	<span class="snippet_argument_parenthesis">)</span>
</div>

<h4>Code</h4>
<p>The snippet's code defines its functionality. The last value returned by the snippet is considered its return value.</p>

<div id="snippet_body_wrapper" class="input_wrapper">
    <textarea id="snippet_body" class="code" name="body" style="min-height: 280px;"><?=set_value('body');?></textarea>
</div>

<a id="save_snippet" class="button" href="#"><span class="label">Save Snippet</span> <span class="save">&#x2714;</span></a>

<?php $this->load->view('application/footer'); ?>
