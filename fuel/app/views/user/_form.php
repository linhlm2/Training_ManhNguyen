<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Userame', 'username', array('class'=>'control-label')); ?>
			<?php echo Form::input('username', Input::post('name', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>
		</div>

		<!-- <div class="form-group">
			<?php //echo Form::label('Address', 'address', array('class'=>'control-label')); ?>
			<?php //echo Form::textarea('address', Input::post('address', isset($user) ? $user->address : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Address')); ?>
		</div>

		<div class="form-group">
			<?php //echo Form::label('Phone', 'phone', array('class'=>'control-label')); ?>
			<?php //echo Form::input('phone', Input::post('phone', isset($user) ? $user->phone : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Phone')); ?>
		</div>

		<div class="form-group">
			<?php //echo Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?php //echo Form::textarea('description', Input::post('description', isset($user) ? $user->description : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Description')); ?>
		</div> -->

		<div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>
			<?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Email')); ?>
		</div>

		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>

<?php echo Form::close(); ?>