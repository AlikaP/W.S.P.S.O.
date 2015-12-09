<h2>Dobrodošli</h2>
<br>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>VAŠI SERVISI</th>
				
			</tr>
		</thead>

		<tbody>

<table class="table table-striped">
<tbody>

<?php
foreach($klijent_result as $klijent_row):
if($klijent_row->preuzeto != TRUE): ?>
<tr><td> <?php
	if($klijent_row->status == 'U TIJEKU'): ?>
		<p> 
			Servisirano oružje: <?php echo $klijent_row->oruzije ?><br><br>

			Vaš servis je u tijeku i trajati će od <?php echo dateform($klijent_row->pocetak_servisa) ?> do <?php echo dateform($klijent_row->kraj_servisa) ?>.
			
			<br>
			NAPOMENA: krajnji datum servisa nije konačan i može se ažurirati.
		</p>
	<?php

	elseif($klijent_row->status == 'GOTOVO'): ?>
		<p> 
			Servisirano oružje: <?php echo $klijent_row->oruzije ?><br><br>
			
			Vaš servis je završen, možete doći po oružje.

		</p>
	<?php

	elseif($klijent_row->status == ''): ?>
		<p> 
			Servisirano oružje: <?php echo $klijent_row->oruzije ?><br><br>

			Vaš zahtjev za servisom je u fazi obrade, uskoro će biti postavljene informacije o njegovom trajanju.

		</p>
	<?php

	
	endif; ?>
	</td></tr>
<?php 
else: ?>
		<p>
			Trenutno nemate oružja predanih na servisiranje.
		</p>
	
<?php
endif;	
endforeach; ?>


</tbody>
</table>