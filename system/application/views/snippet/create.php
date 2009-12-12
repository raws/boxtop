<?php
$this->load->helper('form');
$this->load->view('snippet/_header', array('title' => 'New'));
?>

<script src="/javascripts/jquery/jquery.elastic.js" type="text/javascript" charset="utf-8"></script>
<script src="/javascripts/snippet/create.js" type="text/javascript" charset="utf-8"></script>


	<div id="left_column">
		<h2>New snippet</h2>
		
		<form id="new_snippet_form" method="post" action="/snippet/create">
			<?php $this->load->view('snippet/_edit_form'); ?>
		</form>
	</div>
	
	<div id="right_column">
		<h2 style="margin-bottom: 20px;">Toolbox</h2>
		
		<a id="save_button" class="button save" href="#">Save</a>
	</div>

<?php $this->load->view('application/footer'); ?>