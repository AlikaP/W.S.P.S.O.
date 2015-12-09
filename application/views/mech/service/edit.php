<!-- FORMA ZA EDIT SERVISA -->


	<h3><?php echo empty($service_2->id) ? 'Dodaj novi servis' : 'Izmijeni ' . $service_2->naziv; ?></h3>





<?php echo validation_errors(); ?>

	<?php echo form_open(); ?>

		<table class="table">
			<tr>
				<td>Kraj servisa:</td>				
				<td>  

					<?php // $date= 'kraj_servisa'; echo form_input($date); ?> 

					<?php echo form_input('kraj_servisa', set_value('kraj_servisa', dateform($service_2->kraj_servisa)), 'class="datepicker" style="width:100%;"');  ?>

				</td>
			</tr>
			<tr>
				<td>Status:</td>
				<td>  

					<?php echo my_form_dropdown('status', $options, "", 'style="width:100%;"')  ?>

				</td>
			</tr>
			<tr>
				<td>Komentar:</td>
				<td>  

					<?php echo	form_textarea('komentar', set_value('komentar', $service_2->komentar), 'style="width:100%;"');  ?> 

				</td>
			</tr>

			<tr>
				<td></td>
				<td><?php echo form_submit('submit', 'Spremi', 'class="btn btn-inverse"'); ?></td>
			</tr>
		</table>	

	<?php echo form_close();?>


<!--

foreach($users as $user):

echo $user->name;

endforeach;
					-->

<!--

<select class="form-control">
            
            foreach($groups as $row)
            { 
              echo '<option value="'.$row->description.'">'.$row->description.'</option>';
            }
            
</select>
+<php
-->

<!--

<select class="form-control">
            
            foreach($users as $user)
            { 
              echo '<option value="'.$user->name.'">'.$user->name.'</option>';
            }
            
</select>
+<php
-->