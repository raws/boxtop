<?php $this->load->view('application/header', array('title' => "Search for \"{$query}\"")); ?>

<script src="/javascripts/search/fluidify_search.js" type="text/javascript" charset="utf-8"></script>
<style type="text/css" media="screen">
	@import url("/stylesheets/inc.search.css");
</style>

<h1>Search for "<?=$query;?>"</h1>

<p>Your search yielded <b><?=$total_results;?></b> result<?=$total_results == 1 ? '' : 's';?>.</p>

<div id="search_results">
	<?php $this->load->view('help/_search'); ?>
</div>

<div style="clear: both;"></div>

<p class="pagination">
	<?php if ($has_prev_page): ?><span class="group"><a href="/search/<?=$query;?>/<?=$page-1;?>">Previous</a></span><?php endif; ?>
	<span class="group">Page <b><?=$page;?></b> of <b><?=$total_pages;?></b></span>
	<?php if ($has_next_page): ?><span class="group"><a href="/search/<?=$query;?>/<?=$page+1;?>">Next</a></span><?php endif; ?>
</p>

<?php $this->load->view('application/footer'); ?>