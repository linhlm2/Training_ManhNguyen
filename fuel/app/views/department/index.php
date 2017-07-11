<div class="row">
  	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="x_panel">
     		<div class="x_title">
        		<h2>Departments</h2>
        		<div class="clearfix"></div>
      		</div>
      		<div class="x_content">
      			<?php if (!empty($departments)): ?>
			        <table class="table">
			          	<thead>
				            <tr>
				              	<th>#</th>
				              	<th>Name</th>
				              	<th>Address</th>
				              	<th>Phone</th>
				              	<th>Email</th>
				              	<th>Description</th>
				              	<th>&nbsp;</th>
				            </tr>
			          	</thead>
			          	<tbody>
			          		<?php $i = 1; ?>
			          		<?php foreach ($departments as $item): ?>
				            	<tr>
					              	<th scope="row"><?php echo $i++; ?></th>
					              	<td><?php echo $item->name; ?></td>
					              	<td><?php echo $item->address; ?></td>
									<td><?php echo $item->phone; ?></td>
									<td><?php echo $item->email; ?></td>
					              	<td><?php echo $item->description; ?></td>
					              	<td>
						              	<div class="btn-toolbar">
											<div class="btn-group">
												<?php echo Html::anchor('department/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>			<?php echo Html::anchor('department/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>			<?php echo Html::anchor('department/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					
											</div>
										</div>
									</td>
				            	</tr>
				            <?php endforeach; ?>
			          	</tbody>
			        </table>
		        <?php else: ?>
					<p>No Departments.</p>
				<?php endif; ?>
      		</div>
    	</div>
    	<?php echo Html::anchor('department/create', 'Add new Department', array('class' => 'btn btn-success')); ?>
  	</div>
</div>