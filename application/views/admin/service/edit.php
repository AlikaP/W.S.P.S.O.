<!-- FORMA ZA EDIT SERVISA -->


	<h3><?php echo empty($service->id) ? 'Dodaj novi servis' : 'Izmijeni ' . $service->naziv; ?></h3>




<?php echo validation_errors(); ?>

	<?php echo form_open(); ?>

		<table class="table">
			<tr>
				<td>Oružje:</td> <?php $css = 'style="width:100%;"'; ?>				
				<td>  
					<?php echo	my_form_dropdown_2('name', 'oruzije', $weapons_options, "", $css); //cms_helper ?> 

				</td>
			</tr>
			
			<tr>
				<td>Serviser:</td>
				<td>  

					<?php echo	my_form_dropdown_2('name', 'serviser', $mechs_options, "", $css); //cms_helper ?> 

				</td>
			</tr>

			<tr>
				<td>Početak servisa:</td>
				<td>  

					<?php echo	form_input(array('name'=>'pocetak_servisa', 'style'=>'width:100%'), set_value('pocetak_servisa', dateform($service->pocetak_servisa)), 'class="datepicker"');  ?> 

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