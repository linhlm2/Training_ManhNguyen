<h2>Editing <span class='muted'>Position</span></h2>
<br>

<?php echo render('position/_form'); ?>
<p>
	<?php echo Html::anchor('position/view/'.$position->id, 'View'); ?> |
	<?php echo Html::anchor('position', 'Back'); ?></p>
