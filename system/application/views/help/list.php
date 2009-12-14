<?php $this->load->view('application/header', array('title' => 'Search - Index')); ?>

<style type="text/css" media="screen">
	@import url("/stylesheets/inc.search.css");
</style>

<h1>Search</h1>

<h2>Index of all <?=number_format($total);?> <?=$this->uri->segment(2) == 'all' ? 'commands' : $this->uri->segment(2);?></h2>

<?php
function array_chunk_vertical($input, $size, $preserve_keys = false, $size_is_horizontal = true) {
	$chunks = array();

	if ($size_is_horizontal) {
		$chunk_count = ceil(count($input) / $size);
	} else {
		$chunk_count = $size;
	}

	for ($chunk_index = 0; $chunk_index < $chunk_count; $chunk_index++) {
		$chunks[] = array();
	}

	$chunk_index = 0;
	foreach ($input as $key => $value) {
		if ($preserve_keys) {
			$chunks[$chunk_index][$key] = $value;
		} else {
			$chunks[$chunk_index][] = $value;
		}

		if (++$chunk_index == $chunk_count) {
			$chunk_index = 0;
		}
	}

	return $chunks;
}

$data = array_chunk_vertical($results, 4);
?>

<table id="search_results_table" cellspacing="0" cellpadding="5">
	<?php foreach ($data as $row): ?>
		<tr>
			<?php foreach ($row as $result): ?>
				<td width="25%"><a href="/<?=isset($result->arguments)?'snippet':'factoid';?>/<?=$result->id;?>"><?=$result->name;?></a></td>
		 	<?php endforeach; ?>
		</tr>
	<?php endforeach; ?>
</table>

<p class="pagination">
	<?php if ($prev_page): ?><span class="group"><a href="/search/<?=$this->uri->segment(2);?>/<?=$page-1;?>">Previous</a></span><?php endif; ?>
	<span class="group">Page <b><?=$page;?></b> of <b><?=$pages;?></b></span>
	<?php if ($next_page): ?><span class="group"><a href="/search/<?=$this->uri->segment(2);?>/<?=$page+1;?>">Next</a></span><?php endif; ?>
</p>

<?php $this->load->view('application/footer'); ?>