<?php $this->load->view('application/header'); ?>

<h1>Factoids</h1>

<?php $this->load->view('infobot/_search_form'); ?>

<h2>Search for "<?php echo $query; ?>"</h2>

<p><?php echo sizeof($results); ?> factoid<?php if (sizeof($results) != 1): ?>s<?php endif; ?> found.</p>

<ul>
	<?php foreach ($results as $result): ?>
	<li><?php echo anchor("factoids/edit/{$result->id}", $result->name); ?></li>
	<?php endforeach; ?>
</ul>

<?php $this->load->view('application/footer'); ?>
