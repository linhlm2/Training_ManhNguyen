<h2>Viewing <span class='muted'>#<?php echo $user->id; ?></span></h2>

<p>
	<strong>Username:</strong>
	<?php echo $user->username; ?>
</p>
<p>
	<strong>Email:</strong>
	<?php echo $user->email; ?>
</p>

<?php echo Html::anchor('user/edit/'.$user->id, 'Edit'); ?> |
<?php echo Html::anchor('user', 'Back'); ?>