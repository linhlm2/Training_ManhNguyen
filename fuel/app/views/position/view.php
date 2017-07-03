<h2>Viewing <span class='muted'>#<?php echo $position->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $position->name; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $position->description; ?></p>

<?php echo Html::anchor('position/edit/'.$position->id, 'Edit'); ?> |
<?php echo Html::anchor('position', 'Back'); ?>