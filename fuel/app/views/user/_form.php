<?php if (Session::get_flash('success')): ?>
    <div class="alert alert-success alert-dismissable">
      <p>
      <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
      </p>
    </div>
  <?php endif; ?>
  <?php if (Session::get_flash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
      <p>
      <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
      </p>
    </div>
<?php endif; ?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  	<div class="x_title">
		    <div class="clearfix"></div>
		</div>
		<div class="x_content">
			<br />
		    <!-- <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> -->
			<?php echo Form::open(array("class"=>"form-horizontal form-label-left")); ?>

		      	<div class="form-group">
			        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span></label> -->
			        <?php echo Form::label('First Name *', 'firstname', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')); ?>
					
			        <div class="col-md-6 col-sm-6 col-xs-12">
			          	<!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
			          	<?php echo Form::input('firstname', Input::post('firstname', isset($user) ? $user->profile->firstname : ''), 
			          				array('class' => 'form-control col-md-7 col-xs-12', 'placeholder'=>'First Name')); 
			          	?>
			        </div>
		      	</div>

		      	<div class="form-group">
			        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span></label> -->
			        <?php echo Form::label('Last Name *', 'lastname', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')); ?>
			        <div class="col-md-6 col-sm-6 col-xs-12">
			          	<!-- <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12"> -->
			          	<?php echo Form::input('lastname', Input::post('lastname', isset($user) ? $user->profile->lastname : ''), 
			          				array('class' => 'form-control col-md-7 col-xs-12', 'placeholder'=>'Last Name')); 
			          	?>
			        </div>
		      	</div>

		      	<!-- <div class="form-group"> -->
			        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span></label>
			        <div class="col-md-4 col-sm-4 col-xs-12 date" id="myDatepicker"> -->
			          	<!-- <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text"> -->
			          	<?php //echo Form::input('birthday', Input::post('birthday', isset($user) ? $user->profile->birthday : ''), 
			          				//array('class' => 'date-picker form-control col-md-7 col-xs-12', 'placeholder'=>'Birthday', 'id' => 'birthday', 'type' => 'text')); 
			          	?>
			          	<!-- <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span> -->
			        <!-- </div> -->
		      	<!-- </div> -->

		      	<div class="form-group">
                	<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required" >* </span></label>
                    <div class='input-group col-md-2 col-sm-2 col-xs-10' id='birthday' style="padding-left: 10px !important;">
                        <input type='text' class="form-control col-md-7 col-xs-12" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

				<div class="form-group">
					<?php echo Form::label('Department *', 'department', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')); ?>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<?php if(empty($departments)) : ?>
				            <?php echo 'Please create departments before create user!'; ?>
				        <?php else : ?>
				        	<?php 
								echo Form::select('department', 'Choose', $departments, array('class'=>'form-control col-md-7 col-xs-12'));
							?>
				        <?php endif; ?>
						
					</div>	
				</div>

		      	<div class="form-group">
			        <label class="control-label col-md-3 col-sm-3 col-xs-12">Postision <span class="required" >* </span></label>
			        <div class="col-md-6 col-sm-6 col-xs-12">
			          	<div id="position" class="btn-group" data-toggle="buttons">
				           <!--  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
				              	<input type="radio" class="flat" name="position" id="positionM" value="staff" checked="" required /> &nbsp; Staff &nbsp;
				            </label>
				            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
				              	<input type="radio" class="flat" name="position" id="positionF" value="dod" /> Deputy of department
				            </label>
				            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
				              	<input type="radio" class="flat" name="position" id="positionF" value="hod" /> Head of department
				            </label> -->
				            <?php if(empty($positions)) : ?>
				            	<?php echo 'Please create positions before create user!'; ?>
				            <?php else : ?>
				            	<?php foreach ($positions as $key => $position) : ?>
				            		<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						              	<input type="radio" class="flat" name="position" value="<?php echo $position->id; ?>" /> <?php echo $position->name; ?>
						            </label>
				            	<?php endforeach; ?>	
				            <?php endif; ?>
			          	</div>
			        </div>
		      	</div>

		      	<div class="form-group">
			        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span></label> -->
			        <?php echo Form::label('Address *', 'address', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')); ?>
			        <div class="col-md-6 col-sm-6 col-xs-12">
			          	<!-- <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12"> -->
			          	<?php echo Form::input('address', Input::post('address', isset($user) ? $user->profile->address : ''), 
			          				array('class' => 'form-control col-md-7 col-xs-12', 'placeholder'=>'Address')); 
			          	?>
			        </div>
		      	</div>

		      	<div class="form-group">
			        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span></label> -->
			        <?php echo Form::label('Phone *', 'phone', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')); ?>
			        <div class="col-md-6 col-sm-6 col-xs-12">
			          	<!-- <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12"> -->
			          	<?php echo Form::input('phone', Input::post('phone', isset($user) ? $user->profile->phone : ''), 
			          				array('class' => 'form-control col-md-7 col-xs-12', 'placeholder'=>'Phone')); 
			          	?>
			        </div>
		      	</div>

		      	<div class="form-group">
			        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
			        <div class="col-md-6 col-sm-6 col-xs-12">
			          	<div id="gender" class="btn-group" data-toggle="buttons">
				            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
				              	<!-- <input type="radio" name="gender" value="male"> &nbsp; Male &nbsp; -->
				              	<input type="radio" class="flat" name="gender" id="genderM" value="1" checked="" required /> &nbsp; Male &nbsp;
				            </label>
				            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
				              	<!-- <input type="radio" name="gender" value="female"> Female -->
				              	<input type="radio" class="flat" name="gender" id="genderF" value="0" /> Female
				            </label>
			          	</div>
			        </div>
		      	</div>

		      	<div class="ln_solid"></div>
		      	<div class="form-group">
			        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			          	<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
			          	<?php echo Html::anchor('user', 'Back', array('class' => "btn btn-primary")); ?>
					  	<button class="btn btn-danger" type="reset">Reset</button>
			          	<button type="submit" class="btn btn-success">Submit</button>
			        </div>
	     	 	</div>
			<?php echo Form::close(); ?>

		    <!-- </form> -->
	 	</div>
	</div>
</div>

<?php echo Asset::js('jquery.min.js'); ?>
<?php echo Asset::js('bootstrap-datetimepicker.min.js') ?>
<?php echo Asset::css('bootstrap-datetimepicker.css') ?>

<script type="text/javascript">
	$('#birthday').click(function(event) {
		$(this).datetimepicker({
	        format: 'YYYY/MM/DD'
	    });
	});
</script>