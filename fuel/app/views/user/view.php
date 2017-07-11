<div class="row">
  	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="x_panel">
      		<div class="x_title">
        		<h2>Viewing #<?php echo $user->id; ?></h2>
        		<div class="clearfix"></div>
      		</div>
      		<div class="x_content">
        		<form class="form-horizontal form-label-left" novalidate>
			        <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span>
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $user->username; ?>">
			            </div>
			        </div>

			        <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $user->email; ?>">
			            </div>
			        </div>

			        <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name <span class="required">*</span>
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $user->profile->firstname; ?>">
			            </div>
			        </div>

			        <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name <span class="required">*</span>
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $user->profile->lastname; ?>">
			            </div>
			        </div>

			        <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday <span class="required">*</span>
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo date("Y/m/d",strtotime($user->profile->birthday)); ?>">
			            </div>
			        </div>

			        <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">Department <span class="required">*</span>
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<input disabled="disabled" class="form-control col-md-7 col-xs-12" 
			              	value="<?php 
										if ((!empty($user->profile->department))) {
											echo $user->profile->department->name;
										} else {
											echo '';
										}
									?>">
			            </div>
			        </div>

			        <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">Position <span class="required">*</span>
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<input disabled="disabled" class="form-control col-md-7 col-xs-12" 
			              	value="<?php 
										if ((!empty($user->profile->position))) {
											echo $user->profile->position->name;
										} else {
											echo '';
										}
									?>">
			            </div>
			        </div>

		          	<div class="item form-group">
		            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
		            	</label>
		            	<div class="col-md-6 col-sm-6 col-xs-12">
		              		<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $user->profile->address; ?>">
		            	</div>
		          	</div>

		          	<div class="item form-group">
		            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Phone <span class="required">*</span>
		            	</label>
		            	<div class="col-md-6 col-sm-6 col-xs-12">
		              		<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $user->profile->phone; ?>">
		            	</div>
		          	</div>

		          	<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          	<input disabled="disabled" class="form-control col-md-7 col-xs-12"
                          	value="<?php $gender = ($user->profile->gender != NULL &&  $user->profile->gender == 0) ? 'Female' : 'Male'; echo $gender; ?>">
                        </div>
                    </div>

		          	<div class="ln_solid"></div>
		          	<div class="form-group">
		            	<div class="col-md-6 col-md-offset-3">
		              		<?php echo Html::anchor('user/edit/'.$user->id, 'Edit', array('class' => 'btn btn-primary')); ?>
		              		<?php echo Html::anchor('user/uploadavatar/'.$user->id, 'Upload Avatar', array('class' => 'btn btn-primary')); ?>
		              		<?php if (Session::get('group_id') == 6) : ?>
								<?php echo Html::anchor('user', 'Back', array('class' => 'btn btn-info')); ?>
							<?php endif; ?>
		            	</div>
		          	</div>
		        </form>
     		</div>
    	</div>
  	</div>
</div>


