<h2>Oružja</h2>
<br>
<tbody>
		<tr>
			<td>
			<div class="row"> 
				<div class="span4" style="margin-bottom:20px;" >    <?php //echo anchor('admin/user/edit', '<i class="icon-plus"></i> Add a user'); ?>		
						<?php // echo anchor('admin/weapon/edit', '<button class="btn btn-inverse"> Add a weapon </button>'); ?>	
				</div>
			

			    <div class="span4">
			    	<div class="input-append">
			       <?php echo form_open();
									echo form_input('vrijednost_search', "", 'style="width:55%;"'); 
								  	echo form_submit('submit', 'Pretraži', 'class="btn btn-default"'); 
								  echo form_close(); ?>
					</div>
			    </div>

			     <div class="span4">
			    	
			    </div>
  			</div>
			</td>
		</tr>
	</tbody>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Oružje</th>
				<th>Izmijeni</th>
				<th>Obriši</th>
			</tr>
		</thead>

		<tbody>

<!--Popis oružja (tj. njihovi nazivi)  -->
														<!--ako postoji korisnik... za svakog korisnika iz tablice 'users' ($this->data['users'] = $this->user_m->get();)-->	
<?php if(count($weapons)): foreach($weapons as $weapon): ?>	<!--iz tablice 'users' dohvatiti redove tj. pojedinačne korisnike ($user) -->
		<tr>											<!-- $users je NIZ OBJEKATA, a $user su ti objekti, članovi $users niza-->

<!--email-->		  <td><?php echo anchor('mech/weapon/show/' . $weapon->id_oruzije_mehanicar, $weapon->oruzije_mehanicar); ?></td>
											<!-- 'admin/user/edit/oruzije_mehanicar'  >>>>>  edit($naziv) -->		

<!--gumb za edit-->	  <td><?php // echo btn_edit('admin/weapon/edit/' . $weapon->id); ?></td>    <!--funkcije iz cms_helper-a -->


<!--gumb za delete--> <td><?php // echo btn_delete('admin/weapon/delete/' . $weapon->id); ?></td> 
												<!-- $user->id == FETCH USER'S ID -->
												<!-- definirano u user_m.php  -->
		</tr>
<?php endforeach; ?>

<?php else: ?>
		<tr>
			<td colspan="3">Ne možemo pronaći ni jedno oružje u sustavu.</td>
		</tr>
<?php endif; ?>	
		</tbody>

	</table>