<!-- FORMA ZA PROMIJENU LOZINKE-->


	<h3><?php echo 'Izmijeni lozinku' ?></h3>




<?php echo validation_errors(); ?>

	<?php echo form_open(); ?>

		<table class="table">
			<tr>
				<td>Nova lozinka:</td> 				
				<td>  
					<?php echo form_password(array('name'=>'password', 'style'=>'width:100%')); ?>

				</td>
			</tr>
			
			<tr>
				<td>Potvrda lozinke:</td>
				<td>  

					<?php echo form_password(array('name'=>'password_confirm', 'style'=>'width:100%')); ?> 

				</td>
			</tr>

			<tr>
				<td></td>
				<td><?php echo form_submit('submit', 'Spremi', 'class="btn btn-inverse"'); ?></td>
			</tr>
		</table>	

	<?php echo form_close();?>