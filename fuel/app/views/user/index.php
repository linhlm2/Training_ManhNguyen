<!-- <h2>Listing <span class='muted'>Users</span></h2>
<br> -->
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
	        <h2>Users</h2>
	        <div class="clearfix"></div>
      	</div>
      	<div class="x_content">
      		<?php if (!empty($users)): ?>
	        <table id="datatable-buttons" class="table table-striped table-bordered jambo_table bulk_action">
		        <thead>
		            <tr>
		             	<th style="width: 3%;">
		                  	<input type="checkbox" id="check-all" class="flat">
		                </th>
		              	<th>No.</th>
		              	<th>Username</th>
		              	<th>Email</th>
		              	<th>Status</th>
		              	<th>Created</th>
		              	<th class="table-action" style="width: 11%;">Action</th>
		            </tr>
		        </thead>


	          	<tbody>
		          	<?php $i = 1; ?>
		          	<?php foreach ($users as $user): ?>
		          		<?php if($user->group_id == 2) continue; ?>
			            <tr>
			            	<?php 
			            		if($user->group_id !== 1) 
			            			$disable = 'disabled';
			            		else 
			            			$disable = '';
			            	?>
			            	<td class="a-center">
			                  	<input type="checkbox" class="flat resetPassword" <?php //echo $disable; ?> name="table_records" value="<?php echo $user->id; ?>">
			                </td>
			            	<td><?php echo $i++; ?></td>
				            <td><?php echo $user->username; ?></td>
				            <td><?php echo $user->email; ?></td>
				            <td>
				            	<?php 
				            		if ($user->group_id == 6) {
				            			echo 'OK';
				            		} else {
				            			if (!empty($user->profile)) {
				            				echo ($user->profile->active == 1) ? 'OK' : 'None';
				            			} else {
				            				echo 'None';
				            			}
				            		}

				            	?>
				            	
				            </td>
				            <td><?php echo date('m/d/Y H:i:s', $user->created_at); ?></td>
				            <td>
				          		<div class="btn-toolbar">
									<div class="btn-group">
										<?php echo Html::anchor('user/view/'.$user->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						
										<?php echo Html::anchor('user/edit/'.$user->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						
										<?php echo Html::anchor('user/delete/'.$user->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					
									</div>
								</div>
				          	</td>
			            </tr>
		            <?php endforeach; ?>
		         </tbody>
	        </table>
	        <?php else: ?>
				<p>No Users.</p>
			<?php endif; ?>
			<?php echo Html::anchor('user/create', 'Add new User', array('class' => 'btn btn-success')); ?>
			<button class ='btn btn-info resetok' id ='reset_password'>Reset Password</button>
      </div>
    </div>
</div>