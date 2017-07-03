<h2>Listing <span class='muted'>Departments</span></h2>
<br>
<?php if ($departments): ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Description</th>
				<th>Email</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($departments as $item): ?>		
				<tr>
					<td><?php echo $item->name; ?></td>
					<td><?php echo $item->address; ?></td>
					<td><?php echo $item->phone; ?></td>
					<td><?php echo $item->description; ?></td>
					<td><?php echo $item->email; ?></td>
					<td>
						<div class="btn-toolbar">
							<div class="btn-group">
								<?php echo Html::anchor('department/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						
								<?php echo Html::anchor('department/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						
								<?php echo Html::anchor('department/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
						</div>

					</td>
				</tr>
			<?php endforeach; ?>	
		</tbody>
	</table>
<?php else: ?>
<p>No Departments.</p>

<?php endif; ?>
<p>
	<?php echo Html::anchor('department/create', 'Add new Department', array('class' => 'btn btn-success')); ?>
</p>
