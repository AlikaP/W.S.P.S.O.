<h2>Stanje sustava</h2>  <!-- ubacuje se $profile -profil jednog korisnika (row()) -->
<br>
	

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Korisnici</th>
				
			</tr>
		</thead>

		<tbody>
		
		<tr><td>Broj korisnika u sustavu: <?php echo $num_users ?></td> </tr>									
		<tr><td>Administratori: <?php echo $num_admins  ?></td> </tr>
		<tr><td>Serviseri: <?php echo  $num_mechanics ?></td></tr>
		<tr><td>Klijenti: <?php echo $num_clients ?></td> </tr>
		<tr><td>Zaposlenici: <?php echo $num_emplo . ' + Šef'?></td> </tr>
		<tr><td>Bivši zaposlenici: <?php echo $num_ex ?></td> </tr>

		</tbody>

	</table>


	<table class="table table-striped">
		<thead>
			<tr>
				<th>Servisi</th>
				
			</tr>
		</thead>

		<tbody>
		
		<tr><td>Broj oružja upisanih u sustav: <?php echo $num_weapons ?></td> </tr>									
		<tr><td>Broj servisa: <?php echo $num_services  ?></td> </tr>
		<tr><td>Servisi u tijeku: <?php echo $num_pending ?></td></tr>
		<tr><td>Servisi koji zahtijevaju obradu: <?php echo $num_p ?></td></tr>
		<tr><td>Završeni servisi: <?php echo $num_over ?></td> </tr>

		</tbody>

	</table>