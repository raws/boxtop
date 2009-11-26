<?php $this->load->view('application/header'); ?>

<h1>Factoids</h1>

<?php $this->load->view('infobot/_search_form'); ?>

<h2>Create "<?php echo $name; ?>"</h2>

<p>Factoid creation is coming soon. In the meantime, you can always use Wheaties to create a factoid and edit it here:</p>

<code>
	&lt;You&gt; Wheaties, <?php echo $name; ?> is&hellip;<br />
	&lt;Wheaties&gt; You: ok!
</code>

<?php $this->load->view('application/footer'); ?>
