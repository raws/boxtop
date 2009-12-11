<?php $this->load->view('factoid/_header', array('title' => $factoid->name)); ?>

<script src="/javascripts/factoid/view.js" type="text/javascript" charset="utf-8"></script>

<div id="factoid">
	<?php $this->load->view('factoid/_view'); ?>
</div>

<?php $this->load->view('application/footer'); ?>