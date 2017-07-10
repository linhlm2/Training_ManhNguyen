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
<div class="row">
  	<div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	      	<div class="x_title">
	        	<h2>Change Password</h2>
	        	<div class="clearfix"></div>
	      	</div>
	      	<div class="x_content">
	        	<br />
	        	<?php //echo Form::open(array('action' => 'changepassword'), array('class'=> 'form-horizontal form-label-left', 'id' => 'demo-form2'), 'data-parsley-validate'); ?>
		        <form data-parsley-validate class="form-horizontal form-label-left" method="POST">
		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12">New Password<span class="required">*</span>
		            </label>
		            <div class="col-md-2 col-sm-6 col-xs-12">
		              <input type="password" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="password">
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span>
		            </label>
		            <div class="col-md-2 col-sm-6 col-xs-12">
		              <input type="password" id="last-name" required="required" class="form-control col-md-7 col-xs-12" name="password_confirm">
		            </div>
		          </div>
		          <div class="ln_solid"></div>
		          <div class="form-group">
		            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		            	<?php echo Html::anchor('user/index', 'Cancel', array('class' => 'btn btn-primary')); ?>
		              	<button class="btn btn-primary" type="reset">Reset</button>
		              	<button type="submit" class="btn btn-success">Submit</button>
		            </div>
		          </div>
		        <?php //echo Form::close(); ?>
		        </form>
	      	</div>
	    </div>
 	</div>
</div>