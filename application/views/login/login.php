
<!-- FORMA ZA LOGIRANJE -->
<div style="max-width:300px; max-height: 500px; padding: 20px; margin: 0 auto 20px;">



<?php // echo '<pre>' . print_r($this->session->userdata, TRUE). '</pre>'; ?>

<?php echo validation_errors(); ?>
	
	

				<img style="width: auto; display: block; 
			       margin-left: auto;
			    margin-right: auto;
			    max-height: 500px;" src="<?php echo base_url('assets/img/black.png'); ?>">
			    <br>

				 <h2 style="text-align: center; color:black">W.S.P.S.O.</h2> 

	<?php echo form_open() ?>

		<table class="table">
			<tr>
				
			</tr>
			<tr>
				<td>Korisničko ime:</td>
				<td><?php echo form_input(array('name'=>'name', 'style'=>'width:100%')); ?> </td>
			</tr>
			<tr>
				<td>Lozinka:</td>
				<td><?php echo form_password(array('name'=>'password', 'style'=>'width:100%')); ?></td>
			</tr>
			<tr>
				<td></td>
				<td><?php echo form_submit('submit', 'Prijava', 'class="btn btn-inverse"'); ?></td>
			</tr>
		</table>
		
	<?php echo form_close() ?>
</div>