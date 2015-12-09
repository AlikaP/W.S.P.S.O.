<h2>Moj profil</h2>  <!-- ubacuje se $profile -profil jednog korisnika (row()) -->
<br>

<tbody>
		<tr>
			<td>
			<div class="row"> 
				<div class="span4" style="margin-bottom:20px;" >    
							
						<?php echo anchor('client/my_profile/edit/' . $profile->id, '<button class="btn btn-inverse"> Promijeni lozinku </button>'); ?>	
					
				</div>
			   
  			</div>
			</td>
		</tr>
	</tbody>
	

	<table class="table table-striped">
		<thead>
			<tr>
				<th>KORISNIK</th>
				
			</tr>
		</thead>

		<tbody>

<?php if(count($profile)):  ?>  <!-- za svakog korisnika (redak) - sve vrijednosti (članove niza) -->
														<!-- ako je $pro=n, petlja se izvršava n puta -->
		<tr>   											<!-- $profile == row()-->
														<!-- $profile je JEDAN OBJEKT, nije niz objekata-->
														<!-- zato ne može: foreach($profile as $pro):  echo $pro->id -->

			<td>ID: <?php echo $profile->id ?></td> <!-- $profile->id == FETCH USER'S ID -->
		
												
		</tr>
		<tr><td>Ime: <?php echo $profile->ime ?></td> </tr>	
		<tr><td>Prezime: <?php echo $profile->prezime ?></td> </tr>	
		<tr><td>Korisničko ime: <?php echo $profile->name ?></td> </tr>									
		<tr><td>Mail: <?php echo $profile->email ?></td> </tr>

		<tr><td>Tip korisnika: <?php 

								if($profile->user_type == 'admin'){echo 'Administrator';}
								elseif($profile->user_type == 'mech'){echo 'Serviser';}
								elseif($profile->user_type == 'client'){echo 'Klijent';}

		 ?></td> </tr>


		<tr><td>Datum rođenja: <?php echo $profile->datum_rodjenja ?></td> </tr>									
		<tr><td>Adresa: <?php echo $profile->adresa ?></td> </tr>
		<tr><td>JMBG: <?php echo $profile->JMBG ?></td> </tr>
		<tr><td>Kontakt broj: <?php echo $profile->kontakt_broj ?></td> </tr>
		<tr><td>Oružani list: <?php echo $profile->oruzani_broj ?></td> </tr>

		

		<tr>
			<td>Broj oružja u vlasništvu: <?php echo $num_oruzija ?> </td> 
		</tr>

		<tr>
			<td>Oružja: <?php 

						foreach($clients as $client_profile): ?>

							|<?php echo $client_profile->oruzije_client ?>|&nbsp 
						
						<?php 
						endforeach;
							?>
			</td> 
		</tr>

<?php else: ?>
		<tr>
			<td colspan="3">We could not find any users.</td>
		</tr>

<?php endif; ?>	

		</tbody>

	</table>