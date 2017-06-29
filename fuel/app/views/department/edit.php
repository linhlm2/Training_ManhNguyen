<h2>Editing <span class='muted'>Department</span></h2>
<br>

<?php echo render('department/_form'); ?>
<p>
	<?php echo Html::anchor('department/view/'.$department->id, 'View'); ?> |
	<?php echo Html::anchor('department', 'Back'); ?>
</p>
