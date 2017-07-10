<div class="row">
  	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="x_panel">
      		<div class="x_title">
        		<h2>Viewing #<?php echo $position->id; ?></h2>
        		<div class="clearfix"></div>
      		</div>
      		<div class="x_content">
        		<form class="form-horizontal form-label-left" novalidate>
			        <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span>
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $position->name; ?>">
			            </div>
			        </div>

		          	<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          	<input disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $position->description; ?>">
                        </div>
                    </div>

		          	<div class="ln_solid"></div>
		          	<div class="form-group">
		            	<div class="col-md-6 col-md-offset-3">
		              		<?php echo Html::anchor('position/edit/'.$position->id, 'Edit', array('class' => 'btn btn-primary')); ?>
							<?php echo Html::anchor('position', 'Back', array('class' => 'btn btn-info')); ?>
		            	</div>
		          	</div>
		        </form>
     		</div>
    	</div>
  	</div>
</div>


