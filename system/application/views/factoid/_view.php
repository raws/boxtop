<div id="left_column">
	<h2>Viewing "<?=$factoid->name;?>"</h2>

	<?php if (count($definitions) > 0): ?>
		<ul>
			<?php foreach ($definitions as $definition): ?>
				<li><?=auto_link($definition->body);?></li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>This factoid does not have any associated definitions.</p>
	<?php endif; ?>
</div>

<div id="right_column">
	<h2>Toolbox</h2>
	
	<?php if ($this->auth->logged_in()): ?>
		<a id="edit_button" class="button edit" href="/factoid/edit/<?=$factoid->id;?>#edit" target="#factoid">Edit</a>
		<a id="delete_button" class="button delete" href="/factoid/delete/<?=$factoid->id;?>" target="#factoid">Delete</a>
	<?php else: ?>	
		<a class="button" href="/login">Log In</a> to modify this factoid.
	<?php endif; ?>
</div>