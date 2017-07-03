<h2>Viewing <span class='muted'>#<?php echo $department->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $department->name; ?>
</p>
<p>
	<strong>Address:</strong>
	<?php echo $department->address; ?>
</p>
<p>
	<strong>Phone:</strong>
	<?php echo $department->phone; ?>
</p>
<p>
	<strong>Description:</strong>
	<?php echo $department->description; ?>
</p>
<p>
	<strong>Email:</strong>
	<?php echo $department->email; ?>
</p>

<?php echo Html::anchor('department/edit/'.$department->id, 'Edit'); ?> |
<?php echo Html::anchor('department', 'Back'); ?>