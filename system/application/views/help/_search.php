<div id="command_search_total_results" style="display: none;"><?=$total_results;?></div>

<ol>
	<?php foreach ($results as $result): ?>
		<?php $type = isset($result->arguments) ? 'snippet' : 'factoid'; ?>
		<li class="<?=$type;?>">
			<a href="/<?=$type;?>/<?=$result->id;?>">
				<span class="name"><?=$result->name;?></span>
				<span class="type"></span>
			</a>
		</li>
	<?php endforeach; ?>
</ol>

<?php if ($ajax_request): ?>
<script type="text/javascript" charset="utf-8">
	total_results = $("#command_search_total_results").text();
	$("#nav_command_search_results").append("<div class='message'>" +
		total_results + " total result" + (total_results == '1' ? '' : 's') + "</div>");
</script>
<?php endif; ?>