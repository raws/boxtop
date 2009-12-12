<?php if (strlen(validation_errors()) > 0): ?>
	<div class="flash error"><?=validation_errors();?></div>
<?php endif; ?>

<div id="name_and_args">
	<input class="code" type="text" name="name" size="1" autocomplete="off" value="<?=isset($snippet)?$snippet->name:set_value('name');?>" />
	<span class="paren">(</span>
	<input class="code" type="text" name="arguments" size="1" autocomplete="off" value="<?=isset($snippet)?$snippet->arguments:set_value('arguments');?>" />
	<span class="paren">)</span>
</div>

<div id="body">
	<textarea class="code" name="body"><?=isset($snippet)?$snippet->body:set_value('body');?></textarea>
</div>

<?php if (isset($snippet)): ?>
	<input type="hidden" name="id" value="<?=$snippet->id;?>" />
<?php endif; ?>