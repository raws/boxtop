<script src="/javascripts/snippet/edit.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
	$.bbq.pushState("#edit");
</script>

<div id="left_column">
	<h2>Editing "<?=$snippet->name;?>"</h2>
	
	<form id="edit_form" method="post" action="/snippet/save">
		<?php $this->load->view('snippet/_edit_form'); ?>
	</form>
</div>

<div id="right_column">
	<h2 style="margin-bottom: 20px;">Toolbox</h2>
	
	<a id="save_button" class="button save" href="#edit">Save</a>
	<a id="revert_button" class="button revert" href="/snippet/edit/<?=$snippet->id;?>" target="#snippet">Revert</a>
	<a id="delete_button" class="button delete" href="/snippet/delete/<?=$snippet->id;?>" target="#snippet">Delete</a>
	<a id="view_button" class="button done" href="/snippet/<?=$snippet->id;?>">Done</a>
	
	<h3 style="margin-top: 20px;">Created</h3>
	<p>By <b><?=$created_by->username;?></b> on <?=date('F j, Y \a\t g:i a', strtotime($snippet->created_at));?>.</p>
	
	<h3>Updated</h3>
	<p id="updated_at">By <b><?=$updated_by->username;?></b> on <?=date('F j, Y \a\t g:i a', strtotime($snippet->updated_at));?>.</p>
	
	<h2>Tips <a class="button toggle" href="#" target="#tips">Show</a></h2>
	
	<div id="tips">
		<p>honk honk, pimpin aint easy</p>
	</div>
</div>