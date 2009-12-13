<?php
$this->load->helper('form');
$this->load->view('snippet/_header', array('title' => $snippet->name));
?>

<style type="text/css" media="screen">
	@import url("/stylesheets/inc.highlight.github.css");
</style>

<script src="/javascripts/jquery/jquery-ui-1.7.2.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/javascripts/jquery/jquery.elastic.js" type="text/javascript" charset="utf-8"></script>
<script src="/javascripts/snippet/view.js" type="text/javascript" charset="utf-8"></script>
<script src="/javascripts/common/highlight.pack.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	hljs.tabReplace = '  ';
	hljs.initHighlightingOnLoad('ruby');
</script>

<div id="snippet">
	<div id="left_column">
		<h2>Viewing "<?=$snippet->name;?>"</h2>

		<div id="name_and_args">
			<span class="name code"><?=$snippet->name;?></span>
			<span class="paren">(</span>
			<span class="arguments code"><?=$snippet->arguments;?></span>
			<span class="paren">)</span>
			<span><?php
			$options = array(
					'default' => 'Default (Ruby style)',
					'string' => 'Combine into string',
					'split' => 'Split into array',
					'block' => 'Pass as block'
				);
			echo form_dropdown('parser', $options, $snippet->parser, 'disabled="disabled"');
			?></span>
		</div>

		<div id="body" class="code" style="overflow: auto;">
			<pre><code><?=$snippet->body;?></code></pre>
		</div>
	</div>

	<div id="right_column">
		<h2 style="margin-bottom: 20px;">Toolbox</h2>

		<?php if ($this->auth->authorize('helper', FALSE)): ?>
			<a id="edit_button" class="button edit" href="/snippet/edit/<?=$snippet->id;?>#edit" target="#snippet">Edit</a>
			<a id="delete_button" class="button delete" href="/snippet/delete/<?=$snippet->id;?>" target="#snippet">Delete</a>
		<?php else: ?>
			<a class="button" href="/login">Log in</a> to edit this snippet.
		<?php endif; ?>
		
		<h3 style="margin-top: 20px;">Created</h3>
		<p>By <b><?=$created_by->username;?></b> on <?=date('F j, Y \a\t g:i a', strtotime($snippet->created_at));?>.</p>

		<h3>Updated</h3>
		<p>By <b><?=$updated_by->username;?></b> on <?=date('F j, Y \a\t g:i a', strtotime($snippet->updated_at));?>.</p>
	</div>
</div>

<?php $this->load->view('application/footer'); ?>