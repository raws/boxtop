<script src="/javascripts/jquery/jquery-ui-1.7.2.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/javascripts/jquery/jquery.a-tools-1.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/javascripts/jquery/jquery.elastic.js" type="text/javascript" charset="utf-8"></script>
<script src="/javascripts/factoid/edit.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
	$.bbq.pushState("#edit");
</script>

<form id="edit_form" method="post" action="/factoid/save" target="#factoid">
	<input type="hidden" name="id" value="<?=$factoid->id;?>" />
	
	<div id="left_column">
		<h2>Editing "<?=$factoid->name;?>"</h2>
		
		<ul id="definitions">
			<?php
			// Output #proto_definition.
			$this->load->view('factoid/_edit_definition');
			
			// Output actual definitions.
			foreach ($definitions as $definition) {
				$this->load->view('factoid/_edit_definition', array('definition' => $definition));
			}
			?>
		</ul>
	</div>

	<div id="right_column">
		<!-- Begin toolbox -->
		<h2>Toolbox</h2>
		
		<h3>Factoid</h3>
		<p>
			<a id="save_button" class="button save" href="#edit">Save</a>
			<a id="revert_button" class="button revert" href="/factoid/edit/<?=$factoid->id;?>" target="#factoid">Revert</a>
			<a id="delete_button" class="button delete" href="/factoid/delete/<?=$factoid->id;?>" target="#factoid">Delete</a>
		</p>
		
		<h3 style="margin-top: 25px;">Definitions</h3>
		<p id="definition_count"><b><?=count($definitions);?></b> definition<?=count($definitions)==1?'':'s';?>.</p>
		<p>
			<a id="add_definition_button" class="button add" href="#edit">Add Definition</a>
			<a id="clear_definitions_button" class="button delete" href="#edit">Clear All</a>
		</p>
		<!-- End toolbox -->
		
		<!-- Begin tips -->
		<h2>Tips <a class="button toggle" href="#" target="#tips">Show</a></h2>
		
		<div id="tips">
			<h3>Definition length</h3>
			<p>Each definition may be as long as you like. Each individual line will be cut off at about 512 characters, but you may send multiple lines.</p>
		
			<h3>Multiple lines</h3>
			<p>Send multiple lines by simply typing on a new line&mdash;there's no need to insert "\n" as in IRC!</p>
		
			<h3>Special tags</h3>
			<p>You may use special tags in order to change the formatting or behavior of a given line.</p>
		
			<h4>&lt;action&gt;</h4>
			<p>Send the line as an action:</p>
			<code>
				"&lt;action&gt;poops in his hand"<br />
				* Wheaties poops in his hand
			</code>
		
			<h4>&lt;reply&gt;</h4>
			<p>Send the line as a reply, instead of a definition:</p>
			<code>
				"&lt;reply&gt;I am a salty herring"<br />
				&lt;Wheaties&gt; I am a salty herring
			</code>
		</div>
		<!-- End tips -->
	</div>
</form>