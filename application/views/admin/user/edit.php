<!-- FORMA ZA EDIT KORISNIKA -->


<div>
	<h3><?php echo empty($user->id) ? 'Dodaj novog korisnika' : 'Izmijeni korisnika ' . $user->name; ?></h3>
</div>



<div>
<?php echo validation_errors(); ?>

	<?php echo form_open(); ?>

		<table class="table">
			<tr>
				<td>Ime:</td>				<!-- set_value() u svrhu ispisa već postojeće vrijednsti-->
				<td><?php echo form_input(array('name'=>'ime', 'style'=>'width:100%'), set_value('ime', $user->ime)); ?></td>
			</tr>
			<tr>
				<td>Prezime:</td>				<!-- set_value() u svrhu ispisa već postojeće vrijednsti-->
				<td><?php echo form_input(array('name'=>'prezime', 'style'=>'width:100%'), set_value('prezime', $user->prezime)); ?></td>
			</tr>
			<tr>
				<td>Datum rođenja:</td>
				<td><?php echo form_input(array('name'=>'datum_rodjenja', 'style'=>'width:100%'), set_value('datum_rodjenja', dateform($user->datum_rodjenja)), 'class="datepicker"');  ?></td>
			</tr>
			<tr>
				<td>Adresa:</td>
				<td><?php echo form_input(array('name'=>'adresa', 'style'=>'width:100%'), set_value('adresa', $user->adresa)); ?></td>
			</tr>
			<tr>
				<td>JMBG:</td>
				<td><?php echo form_input(array('name'=>'JMBG', 'style'=>'width:100%'), set_value('JMBG', $user->JMBG));  ?></td>
			</tr>
			<tr>
				<td>Kontakt broj:</td>
				<td><?php echo form_input(array('name'=>'kontakt_broj', 'style'=>'width:100%'), set_value('kontakt_broj', $user->kontakt_broj));  ?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?php echo form_input(array('name'=>'email', 'style'=>'width:100%'), set_value('email', $user->email)); ?></td>
			</tr>

			<?php if($user->password == NULL): ?>
			<tr>
				<td>Lozinka:</td>
				<td>
					<div class="input-append">
	       
						        <?php echo form_password(array('name'=>'password', 'class'=>"well", 'id'=>"passwords", 'style'=>'width:50%')); ?>
						        <button type='button' id="generate" class="btn btn-default">Generiraj</button> <!-- MORA BITI type="button" -inače submitira formu -->
						    
					</div>
				</td>
			</tr>
			<?php endif; ?>

			<?php if(boss_check($user->nadleznost)==TRUE): //onemogućiti ukoliko je šef?>  
			<tr>
				<td>Tip</td><?php $css = 'style="width:100%;"'; ?>
				<td><?php echo my_form_dropdown('user_type', $type_options, "", $css);  ?></td>
			</tr>
			
			<tr>
				<td>Status:</td><?php $css = 'style="width:100%;"'; ?>
				<td><?php echo my_form_dropdown('status', $type_options_2, "", $css);  ?></td>
			</tr>
			<?php endif;?>

			
			<tr>
				<td>Oružani list:</td>
				<td><?php echo form_input(array('name'=>'oruzani_broj', 'style'=>'width:100%'), set_value('oruzani_broj', $user->oruzani_broj));  ?></td>
			</tr>

			<tr>
				<td></td>
				<td><?php echo form_submit('submit', 'Spremi', 'class="btn btn-inverse"'); ?></td>
			</tr>
		</table>	

	<?php echo form_close();?>
</div>

