<li<?=isset($definition) ? '' : ' id="proto_definition"';?>>
	<div class="definition">
		<div class="title">
			<div class="handle" title="Drag to re-order definition"></div>
			<a class="delete" title="Delete definition"></a>
		</div>
		
		<div class="content">
			<textarea name="definitions[]" class="code" autocomplete="off"><?=isset($definition) ? $definition->body : '';?></textarea>
		</div>
	</div>
</li>