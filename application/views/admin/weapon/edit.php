<!-- FORMA ZA EDIT ORUŽJA -->


	<h3><?php echo empty($weapon->id) ? 'Dodaj novo oružje' : 'Izmjeni oružje ' . $weapon->name; ?></h3>





<?php echo validation_errors(); ?>

	<?php echo form_open(); ?>

		<table class="table">
			<tr>
				<td>Naziv</td>				<!-- set_value() u svrhu ispisa već postojeće vrijednsti-->
				<td><?php echo form_input('puni_naziv', set_value('puni_naziv', $weapon->puni_naziv), 'style=width:100%'); ?></td>
			</tr>
			<tr>
				<td>Vlasnik</td> <?php $css = 'style="width:100%;"'; ?>
				<td>  
							<!-- 'name' -atribut u tablici 'users', 'vlasnik' - naziv onoga što unosimo u formu -->
				<?php echo	my_form_dropdown_2('name', 'vlasnik', $users_options, "", $css); //cms_helper ?> 

				</td>
			</tr>
			<tr>
				<td>Vrsta:</td>				<!-- set_value() u svrhu ispisa već postojeće vrijednsti-->
				<td><?php echo form_input('vrsta', set_value('vrsta', $weapon->vrsta), 'style=width:100%'); ?></td>
			</tr>
			<tr>
				<td>Marka:</td>				<!-- set_value() u svrhu ispisa već postojeće vrijednsti-->
				<td><?php echo form_input('marka', set_value('marka', $weapon->marka), 'style=width:100%'); ?></td>
			</tr>
			<tr>
				<td>Tvornički broj:</td>				<!-- set_value() u svrhu ispisa već postojeće vrijednsti-->
				<td><?php echo form_input('serijski_broj', set_value('serijski_broj', $weapon->serijski_broj), 'style=width:100%'); ?></td>
			</tr>
			<tr>
				<td>Kalibar:</td>				<!-- set_value() u svrhu ispisa već postojeće vrijednsti-->
				<td><?php echo form_input('kalibar', set_value('kalibar', $weapon->kalibar), 'style=width:65%'); ?> MM</td>
			</tr>
			<tr>
				<td>Dodaci:</td>				<!-- set_value() u svrhu ispisa već postojeće vrijednsti-->
				<td><?php echo form_input('dodaci', set_value('dodaci', $weapon->dodaci), 'style=width:100%'); ?></td>
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