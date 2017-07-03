<h2>Viewing <span class='muted'>#<?php echo $user->id; ?></span></h2>

<p>
	<strong>Username:</strong>
	<?php echo $user->username; ?>
</p>
<p>
	<strong>Email:</strong>
	<?php echo $user->email; ?>
</p>

<p>
	<strong>First Name:</strong>
	<?php echo $user->profile->firstname; ?>
</p>

<p>
	<strong>Last Name:</strong>
	<?php echo $user->profile->lastname; ?>
</p>

<p>
	<strong>Birthday:</strong>
	<?php echo $user->profile->birthday; ?>
</p>

<p>
	<strong>Department:</strong>
	<?php echo $user->profile->department->name; ?>
</p>

<p>
	<strong>Position:</strong>
	<?php echo $user->profile->position->name; ?>
</p>


<p>
	<strong>Address:</strong>
	<?php echo $user->profile->address; ?>
</p>

<p>
	<strong>Phone:</strong>
	<?php echo $user->profile->phone; ?>
</p>

<p>
	<strong>Gender:</strong>
	<?php $gender = ($user->profile->gender != NULL &&  $user->profile->gende == 0) ? 'Female' : 'Male'; echo $gender; ?>
</p>

<?php echo Html::anchor('user/edit/'.$user->id, 'Edit'); ?> |
<?php echo Html::anchor('user', 'Back'); ?>