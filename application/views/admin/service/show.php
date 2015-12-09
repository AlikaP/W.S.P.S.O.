<h2>Servis</h2>  <!-- ubacuje se $profile -profil jednog korisnika (row()) -->

	
	<tbody>
		<tr>
			<td>
			<div class="row"> 
				<div class="span4" style="margin-bottom:20px;" >    
					<?php if($service_profile->preuzeto != TRUE): ?>		
						<?php echo anchor('admin/service/end_service/' . $service_profile->id, '<button class="btn btn-inverse"> Zaključaj servis </button>', array('onClick' => "return confirm('Jeste li sigurni?');")); ?>	
					<?php else: echo 'SERVIS ZAKLJUČAN'; 
						endif; ?>
				</div>
			   
  			</div>
			</td>
		</tr>
	</tbody>



	<table class="table table-striped">
		<thead>
			<tr>
				<th>PODACI:</th>
				
			</tr>
		</thead>

		<tbody>

<?php if(count($service_profile)):  ?>  <!-- za svakog korisnika (redak) - sve vrijednosti (članove niza) -->
														<!-- ako je $pro=n, petlja se izvršava n puta -->
		<tr>   											<!-- $profile == row()-->
														<!-- $profile je JEDAN OBJEKT, nije niz objekata-->
														<!-- zato ne može: foreach($profile as $pro):  echo $pro->id -->

			<td>ID: <?php echo $service_profile->id ?></td> <!-- $profile->id == FETCH service'S ID -->
		
												
		</tr>					
		<tr><td>Vlasnik: <?php echo anchor('admin/user/show/' . $service_profile->id_vlasnika, $service_profile->vlasnik); ?></td> </tr>									
		<tr><td>Oružje: <?php echo anchor('admin/weapon/show/' . $service_profile->id_oruzija, $service_profile->oruzije); ?></td> </tr>
		<tr><td>Serviser: <?php echo anchor('admin/user/show/' . $service_profile->id_servisera, $service_profile->serviser); ?></td> </tr>

		<tr><td>Početak servisa: <?php echo $datum_pocetka ?></td> </tr>
		<tr><td>Kraj servisa: <?php echo $datum_kraja ?></td> </tr>
		<tr><td>Status: <?php echo $service_profile->status ?></td> </tr>
		
		<tr><td>Stavka stvorena: <?php echo $service_profile->created ?></td> </tr>
		<tr><td>Zadnja izmjena stavke: <?php echo $service_profile->modified ?></td> </tr>


		<tr><td>Komentar: <?php echo $service_profile->komentar ?></td> </tr>

<?php else: ?>
		<tr>
			<td colspan="3">We could not find any services.</td>
		</tr>

<?php endif; ?>	

		</tbody>

	</table>