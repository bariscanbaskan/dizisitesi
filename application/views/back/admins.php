<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Table With Full Features</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<?php
		if($this->session->flashdata('Message') != null)
		{
			?>
			<div class="row">
				<div class="col-xs-12">
					<div class="alert alert-<?php echo $this->session->flashdata('MessageType'); ?>"><?php echo $this->session->flashdata('Message'); ?></div>
				</div>
			</div>
			<?php
		}
		?>
		<table id="example1" class="table table-bordered table-striped">
			<thead>
			<tr>
				<th>Id</th>
				<th>Username</th>
				<th>Email</th>
				<th>Status</th>
				<th>Password</th>
				<th class="text-center">Actions </th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach ($admins as $row){ ?>
			<tr>
				<td>
				<?php echo $row->Id; ?>
				</td>
				<td>
					<?php echo $row->username; ?>
				</td>
				<td>
					<?php echo $row->email; ?>
				</td>
				<td>
					<?php echo $row->Status; ?>
				</td>
				<td>
					<?php echo $row->password; ?>

				</td>
				<td class="text-center">

					<a href="<?php echo base_url(); ?>back/deleteUser/<?php echo $row->Id; ?>" type="button" class="btn btn-md btn-danger">Delete</a>
					<a href="<?php echo base_url(); ?>back/UpdateAdmin/<?php echo $row->Id; ?>" type="button"  class="btn btn-md btn-success">Update</a>
				</td>
			</tr>
			<?php } ?>
			</tbody>

		</table>
	</div>
	<!-- /.box-body -->
</div>
