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
	        	<h2>Form</h2>
	        	<div class="clearfix"></div>
	      	</div>
	      	<div class="x_content">
	      		<?php echo Form::open(array("class"=>"form-horizontal form-label-left", "novalidate")); ?>
		          	<div class="item form-group">
		          		<?php echo Form::label('Name *', 'name', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')); ?>
		            	<div class="col-md-6 col-sm-6 col-xs-12">
		            		<?php echo Form::input('name', Input::post('name', isset($position) ? $position->name : ''), 
		            				array('class' => 'form-control col-md-7 col-xs-12', 'placeholder'=>'Name')); ?>
		            	</div>
		          	</div>

		          	<div class="item form-group">
		            	<?php echo Form::label('Description', 'description', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')); ?>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<?php echo Form::textarea('description', Input::post('description', isset($position) ? $position->description : ''), array('class' => 'col-md-7 col-xs-12 form-control', 'rows' => 1, 'placeholder'=>'Description')); ?>
			            </div>
		          	</div>
		          	<div class="ln_solid"></div>
		          	<div class="form-group">
			            <div class="col-md-6 col-md-offset-3">
			              	<?php echo Html::anchor('position', 'Back', array('class' => 'btn btn-primary')); ?>
			              	<button id="send" type="submit" class="btn btn-success">Submit</button>
								
			            </div>
	          		</div>
	       		<?php echo Form::close(); ?>
      		</div>
    	</div>
  	</div>
</div>