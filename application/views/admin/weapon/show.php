<h2>Oružje</h2>  <!-- ubacuje se $profile -profil jednog korisnika (row()) -->

	

	<table class="table table-striped">
		<thead>
			<tr>
				<th>PODACI:</th>
				
			</tr>
		</thead>

		<tbody>

<?php if(count($weapon_profile)):  ?>  <!-- za svakog korisnika (redak) - sve vrijednosti (članove niza) -->
														<!-- ako je $pro=n, petlja se izvršava n puta -->
		<tr>   											<!-- $profile == row()-->
														<!-- $profile je JEDAN OBJEKT, nije niz objekata-->
														<!-- zato ne može: foreach($profile as $pro):  echo $pro->id -->

			<td>ID: <?php echo $weapon_profile->id ?></td> <!-- $profile->id == FETCH USER'S ID -->
		
												
		</tr>
		<tr><td>Oznaka: <?php echo $weapon_profile->name ?></td> </tr>
		<tr><td>Naziv: <?php echo $weapon_profile->puni_naziv ?></td> </tr>

		<tr><td>Vrsta: <?php echo $weapon_profile->vrsta ?></td> </tr>
		<tr><td>Marka: <?php echo $weapon_profile->marka ?></td> </tr>
		<tr><td>Tvornički broj: <?php echo $weapon_profile->serijski_broj ?></td> </tr>
		<tr><td>Kalibar: <?php echo $weapon_profile->kalibar ?> MM</td> </tr>
		<tr><td>Dodaci: <?php echo $weapon_profile->dodaci ?></td> </tr>

		<tr><td>Vlasnik: <?php echo anchor('admin/user/show/' . $weapon_profile->id_vlasnika, $weapon_profile->vlasnik); ?></td> </tr>
														<!-- potreban id vlasnika-->
		
		<tr><td>Stavka stvorena: <?php echo $weapon_profile->created ?></td> </tr>
		<tr><td>Zadnja izmjena stavke: <?php echo $weapon_profile->modified ?></td> </tr>

		<tr><td>Zadnji aktivni servis: <?php if($weapon_profile->pripadni_servis!=NULL){ echo anchor('admin/service/show/' . $weapon_profile->pripadni_servis, $weapon_profile->naziv_servisa);} ?></td> </tr>

		<tr>
			<td>Servisi: <?php 

						foreach($services as $service_profile): ?>

							|<?php echo anchor('admin/service/show/' . $service_profile->id, $service_profile->naziv);?>|&nbsp
						
						<?php 
						endforeach;
							?>
			</td> 
		</tr>


<?php else: ?>
		<tr>
			<td colspan="3">Nismo uspjeli pronaći nijedno oružije.</td>
		</tr>

<?php endif; ?>	

		</tbody>

	</table>