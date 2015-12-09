<h2>Servisi</h2>
<br>
	
	<tbody>
		<tr>
			<td>
			<div class="row"> 
				<div class="span4" style="margin-bottom:20px; " >    <?php //echo anchor('admin/user/edit', '<i class="icon-plus"></i> Add a user'); ?>		
						<?php echo anchor('admin/service/edit', '<button class="btn btn-inverse"> Novi servis </button>'); ?>	
				</div>
			
			    <div class="span4" >
			    	<div class="input-append">
			        <?php echo form_open();
									echo my_form_dropdown('vrijednost_filtra', $type_options, "", 'style="width:62%;"');
								  	echo form_submit('submit', 'Filtriraj', 'class="btn btn-default"'); 
								  echo form_close(); ?>
					</div>
			    </div>

			    <div class="span4" >
			    	<div class="input-append">
			       <?php echo form_open();
									echo form_input('vrijednost_search', "", 'style="width:55%;"'); 
								  	echo form_submit('submit', 'Pretraži', 'class="btn btn-default"'); 
								  echo form_close(); ?>
					</div>
			    </div>
  			</div>
			</td>
		</tr>
	</tbody>



	<table class="table table-striped">
		<thead>
			<tr>
				<th>Servis</th>
				<th>Izmijeni</th>
				<th>Obriši</th>
			</tr>
		</thead>

		<tbody>

<!--Popis oružja (tj. njihovi nazivi)  -->
														<!--ako postoji korisnik... za svakog korisnika iz tablice 'users' ($this->data['users'] = $this->user_m->get();)-->	
<?php if(count($services)): foreach($services as $service): ?>	<!--iz tablice 'users' dohvatiti redove tj. pojedinačne korisnike ($user) -->
		<tr>											<!-- $users je NIZ OBJEKATA, a $user su ti objekti, članovi $users niza-->

<!--email-->		  <td><?php echo anchor('admin/service/show/' . $service->id, $service->naziv); ?></td>
													

<!--gumb za edit-->	  <td><?php echo end_s($service->preuzeto, $service->id); ?></td>    <!--funkcije iz cms_helper-a -->
										<!--ako je logiran kao admin, redirect admin/service/edit/id -->
										<!--ako je logiran kao mech, redirect mech/service/edit/id -->

<!--gumb za delete--> <td><?php echo btn_delete('admin/service/delete/' . $service->id); ?></td> 
												<!-- $user->id == FETCH USER'S ID -->
												<!-- definirano u user_m.php  -->
		</tr>
<?php endforeach; ?>

<?php else: ?>
		<tr>
			<td colspan="3">Nismo uspjeli pronaći nijedan servis.</td>
		</tr>
<?php endif; ?>	
		</tbody>

	</table>