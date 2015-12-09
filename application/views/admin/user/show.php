<h2>Korisnik</h2>  <!-- ubacuje se $profile -profil jednog korisnika (row()) -->

	

	<table class="table table-striped">
		<thead>
			<tr>
				<th>PODACI:</th>
				
			</tr>
		</thead>

		<tbody>

<?php if(count($user_profile)):  ?>  <!-- za svakog korisnika (redak) - sve vrijednosti (članove niza) -->
														<!-- ako je $pro=n, petlja se izvršava n puta -->
		<tr>   											<!-- $profile == row()-->
														<!-- $profile je JEDAN OBJEKT, nije niz objekata-->
														<!-- zato ne može: foreach($profile as $pro):  echo $pro->id -->

			<td>ID: <?php echo $user_profile->id ?></td> <!-- $profile->id == FETCH USER'S ID -->
		
												
		</tr>
		<tr><td>Ime: <?php echo $user_profile->ime ?></td> </tr>
		<tr><td>Prezime: <?php echo $user_profile->prezime ?></td> </tr>
		<tr><td>Korisničko ime: <?php echo $user_profile->name ?></td> </tr>									
		<tr><td>Lozinka: <?php echo $user_profile->password ?></td> </tr>
		<tr><td>Mail: <?php echo $user_profile->email ?></td> </tr>
		<tr><td>Tip korisnika: <?php 

						if($user_profile->user_type == 'admin'){echo 'Administrator';}
						elseif($user_profile->user_type == 'mech'){echo 'Serviser';}
						elseif($user_profile->user_type == 'client'){echo 'Klijent';}

		 ?></td> </tr>

		<tr><?php if($user_profile->user_type == 'mech' || $user_profile->user_type == 'admin'): ?>
			<td>Status zaposlenja: <?php echo $user_profile->status ?></td>
			<?php endif; ?> 
		</tr>
		<tr><?php if($user_profile->nadleznost == 'Šef'): ?>
			<td>Poseban status: <?php echo $user_profile->nadleznost ?></td>
			<?php endif; ?> 
		</tr>
		<tr><?php if($user_profile->user_type == 'mech' || $user_profile->user_type == 'admin' && $user_profile->nadleznost != 'Šef'): ?>
			<td>Radni odnos: <br> <?php
				foreach($zaposlenici as $zaposleni):
					?> od <?php 
				  	echo dateform($zaposleni->pocetak_rada); 
					if($zaposleni->kraj_rada != "0000-00-00"):
					 ?> do
						<?php echo dateform($zaposleni->kraj_rada);
					else:
						echo " do danas"; 
					endif;
					?><br><?php
				endforeach; ?>
			</td> 
			<?php endif; ?> 
		</tr>

		<tr><td>Datum rođenja: <?php echo dateform($user_profile->datum_rodjenja); ?></td> </tr>									
		<tr><td>Adresa: <?php echo $user_profile->adresa ?></td> </tr>
		<tr><td>JMBG: <?php echo $user_profile->JMBG ?></td> </tr>
		<tr><td>Kontakt broj: <?php echo $user_profile->kontakt_broj ?></td> </tr>

		<?php if($user_profile->user_type == 'client'):?>
		<tr><td>Oružani list: <?php echo $user_profile->oruzani_broj ?></td> </tr>
		<?php endif; ?>

		<tr><td>Profil stvoren: <?php echo datetimeform($user_profile->created); ?></td> </tr>
		<tr><td>Zadnja izmjena profila: <?php echo datetimeform($user_profile->modified); ?></td> </tr>

		<?php if($user_profile->user_type == 'mech'):?>
		<tr>
			<td>
				Broj neobrađenih servisa: <?php echo $num_zahtjeva_pozornost ?><br>
				Broj rješenih servisa: <?php echo $num_rjeseno ?><br>
				Broj nerješenih servisa: <?php echo $num_nerjeseno?><br>
				Ukupno: <?php echo $num_services ?>
			</td> 
		</tr>

		<tr>
			<td>Servisi: <?php 

						foreach($mechanics as $mech_profile): ?>

							|<?php echo anchor('admin/service/show/' . $mech_profile->servis_mehanicar, $mech_profile->naziv_servisa);?>|&nbsp
						
						<?php 
						endforeach;
							?>
			</td> 
		</tr>
		<?php elseif($user_profile->user_type == 'client'): ?>
		<tr>
			<td>Broj oružja u vlasništvu: <?php echo $num_oruzija ?> </td> 
		</tr>

		<tr>
			<td>Oružja: <?php 

						foreach($clients as $client_profile): ?>

							|<?php echo anchor('admin/weapon/show/' . $client_profile->id_oruzija_client, $client_profile->oruzije_client);?>|&nbsp 
						
						<?php 
						endforeach;
							?>
			</td> 
		</tr>
		<?php endif; ?>
		

		<!-- POTREBNO DODATI ISPIS POSEBNIH PODATAKA ZA MEHANIČARA I KLIJENTA-->

<?php else: ?>
		<tr>
			<td colspan="3">Nismo uspjeli pronaći nijednog korisnika.</td>
		</tr>

<?php endif; ?>	

		</tbody>

	</table>