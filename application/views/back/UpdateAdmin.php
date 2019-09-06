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
		<form action="<?php echo base_url(); ?>back/UpdateAdmin/<?php echo $AdminDetail[0]->Id ?>" method="post">
		<div class="form-group has-feedback">
			<input type="text" name="username" class="form-control" value="<?php echo $AdminDetail[0]->username ?>">
		</div>
			<div class="form-group has-feedback">
				<input type="submit" class="form-control" >
			</div>
		</form>
	</div>
	<!-- /.box-body -->
</div>
