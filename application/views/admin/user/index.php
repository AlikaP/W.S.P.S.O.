<h2>Korisnici</h2>
<br>
	
	<tbody>
		<tr>
			<td>
			<div class="row"> 
				<div class="span4" style="margin-bottom:20px;" >    <?php //echo anchor('admin/user/edit', '<i class="icon-plus"></i> Add a user'); ?>		
						<?php echo anchor('admin/user/edit', '<button class="btn btn-inverse"> Novi korisnik </button>'); ?>	
				</div>
			
			    <div class="span4">
			    	<div class="input-append">
			        <?php echo form_open();
									echo my_form_dropdown('vrijednost_filtra', $type_options, "", 'style="width:62%;"');
								  	echo form_submit('submit', 'Filtriraj', 'class="btn btn-default"'); 
								  echo form_close(); ?>
					</div>
			    </div>

			    <div class="span4">
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
				<th>Korisnik</th>
				<th>Izmijeni</th>
				<th>Obriši</th>
			</tr>
		</thead>

		<tbody>

<!--Popis korisnika (tj. njihovi mailovi)  -->
														<!--ako postoji korisnik... za svakog korisnika iz tablice 'users' ($this->data['users'] = $this->user_m->get();)-->	
<?php if(count($users)): foreach($users as $user): ?>	<!--iz tablice 'users' dohvatiti redove tj. pojedinačne korisnike ($user) -->
		<tr>											<!-- $users je NIZ OBJEKATA, a $user su ti objekti, članovi $users niza-->

<!--email-->		  <td><?php echo anchor('admin/user/show/' . $user->id, $user->ime . ' ' . $user->prezime); ?></td>
											<!-- 'admin/user/edit/id'  >>>>>  edit($id) -->		
											<!-- $user->id je ono što se ispiše -->	

<!--gumb za edit-->	  <td><?php echo btn_edit('admin/user/edit/' . $user->id); ?></td>    <!--funkcije iz cms_helper-a -->


<!--gumb za delete--> <td><?php echo boss($user->nadleznost, $user->id); ?></td> 
												<!-- $user->id == FETCH USER'S ID -->
												<!-- definirano u user_m.php  -->
		</tr>
<?php endforeach; ?>

<?php else: ?>
		<tr>
			<td colspan="3">Nismo uspjeli pronaći nijednog korisnika.</td>
		</tr>
<?php endif; ?>	
		</tbody>

	</table>