<?php

class Service extends Login_Controller
{

	

	public function __construct()
	{
		parent::__construct();
	}

	//------------------------------------------------------------------------

	public function index() //ispis korisnika
	{	
			
		$this->data['services'] = $this->service_m->get(); //result()

		$this->data['type_options'] = array('GOTOVO', 'U TIJEKU', 'U OBRADI');

			//filtriranje (potrebna pravila)
			$rules_2 = $this->service_m->rules_2; //dohvat varijable 'rules' (koja je array) iz 'user_m'
			$this->form_validation->set_rules($rules_2);

			if ($this->input->post('submit') == 'Filtriraj')     //stranica se refresha klikom na 'save' ali
			{													 // je run() sada TRUE pa vrijedi izraz u {} 
				//pravila ispunjena (save gumb) - filtriranje
				if($this->form_validation->run()==TRUE)
				{

					$this->data['services'] = $this->service_m->filtriranje_1();

					$this->data['type_options'] = array('GOTOVO', 'U TIJEKU', 'U OBRADI');
					//$this->session->set_flashdata('my_super_array', $this->data['users_filtr']); 

					//redirect('admin/user/index', 'refresh');
				}
			}

			//pretrazivanje (potrebna pravila)
			$rules_3 = $this->service_m->rules_3; //dohvat varijable 'rules' (koja je array) iz 'user_m'
			$this->form_validation->set_rules($rules_3);

			if ($this->input->post('submit') == 'Pretraži')
			{
				//pravila ispunjena (save gumb) - filtrirnanje
				if($this->form_validation->run()==TRUE)
				{	

					$this->data['services'] = $this->service_m->pretrazivanje_1();

					//$this->session->set_flashdata('my_super_array_2', $this->data['users_search']);

					//redirect('admin/user/pretrazivanje');
				}
			}

		$this->data['subview'] = 'admin/service/index'; //view

		$this->data['subview_2'] = 'admin/menu/index';

		$this->load->view('login/_layout_main', $this->data);

	}

	//------------------------------------------------------------------------

	public function edit($id=NULL) //za edit postojećeg ili stvaranje novog korisnika
	{
		//dohvat korisnika iz tablice ili stvaranje novog
		if($id!=NULL)
		{
			$this->data['service'] = $this->service_m->get($id);
			//count($this->data['user']) || $this->data['errors'][] = 'User could not be found'; //ako korisnik nije pronađen, dodati error poruku u error array
		}
		else
		{
			$this->data['service'] = $this->service_m->get_new();
		}

		//pravila forme
		$rules = $this->service_m->rules; //dohvat varijable 'rules' (koja je array) iz 'user_m'
		$this->form_validation->set_rules($rules);


		$user_type_client = array('user_type'=>'client');
		$user_type_mech = array('user_type'=>'mech');

		//slanje liste korisnika (drop-down menu)
		$this->data['clients_options'] = $this->user_m->get_by($user_type_client, FALSE);

		//slanje liste oružija (drop-down menu)
		$this->data['weapons_options'] = $this->weapon_m->get();

		//slanje liste mehaničara (drop-down menu)
		$this->data['mechs_options'] = $this->user_m->get_by($user_type_mech, FALSE); //vraća nekoliko redova

		//$id || $rules['password']['rules'] .= '|required';    //$rules['password']['rules'] = $rules['password'] . '|required';

		//procesiranje forme
		if($this->form_validation->run()==TRUE)
		{
			$podaci = $this->service_m->array_from_post(array('oruzije', 'serviser', 'pocetak_servisa', 'kraj_servisa'));
			//$data['password'] = $this->user_m->hash(data['password']);
			$podaci['preuzeto'] = FALSE;
			$podaci['kraj_servisa'] = date('Y-m-d');

			//date format
			$podaci['pocetak_servisa'] = dateform_($podaci['pocetak_servisa']);

				$mehanicar = array('name'=>$podaci['serviser']); //dohvat  servisera
				$mech_row = $this->user_m->get_by($mehanicar, TRUE); //dohvat retka tog mehaničara iz tablice 'users'
				$id_mehanicara = $mech_row->id; //dohvat  tog mehaničara
													//TREBAO BI BITI ID MEHANICARA!!!!
				$ime_mehanicara = $mech_row->name; //dohvat imena mehanicara


				$oruzije = array('name'=>$podaci['oruzije']); //dohvat  
				$oruz_row = $this->weapon_m->get_by($oruzije, TRUE); 
				$id_oruzija = $oruz_row->id; //dohvat tog oružija  
													//TREBAO BI BITI ID ORUŽIJA!!
				$naziv_oruzija = $oruz_row->name; //dohvat naziva oruzija

			//naziv_servisa 
			/*
			$br_servisa = count($this->service_m->get())+1;
			$naziv_servisa_osnovno = 'Servis_' . $br_servisa;
			$postojeci_servisi = $this->service_m->get();
			$ii = 0;
			foreach($postojeci_servisi as $servis)
			{
				if($naziv_servisa_osnovno == $servis->naziv_servisa)
				{$i++;}
			}

			if($i!=0)
			{
				$naziv_servisa = 'Servis_' . $br_servisa . '_';
			}
			*/

			//naziv servisa
			!$id || $this->db->where('id !=', $id);   //preskače se naziv aktualnog servisa, (ukoliko se ažurira)
			$postojeci_servisi = $this->service_m->get();
			$najveci = 0;
			foreach($postojeci_servisi as $servis): //ako nema servisa, nema foreach-a...
				$rastavljeni = explode("_", $servis->naziv);
				$broj_servisa = intval($rastavljeni['1']);
				if($broj_servisa >= $najveci)
				{
					$najveci = $broj_servisa+1;
				}
			endforeach;

			$naziv_servisa = 'Servis_' . $najveci;

			//
			$podaci_update = array(
									'id_vlasnika'=>$oruz_row->id_vlasnika,
			 						'id_oruzija'=>$id_oruzija,
			 						 'id_servisera'=>$id_mehanicara,
			 						 'naziv'=>$naziv_servisa
			 						 ); 


			$id_servisa = $this->service_m->save($podaci, $id);
			$this->service_m->save($podaci_update, $id_servisa); //dodatno spremanje 


				$mechanics_array = array(
											'id_mehanicar'=>$id_mehanicara,
											'name_mehanicar'=>$ime_mehanicara,
											'servis_mehanicar'=>$id_servisa,
											'id_oruzije_mehanicar'=>$id_oruzija,
											'naziv_servisa'=>$naziv_servisa,
											'oruzije_mehanicar'=>$naziv_oruzija
											); //

				//$novi_mech_servis = $this->mechanic_m->get_new(); //stvaranje novog retka u tablici 'mechanics'

				//$id_2 = $novi_mech_servis->id; //dohvat id-a novostvorenog retka -NO

				//za dvije gornje linije, iz nekog razloga, ne javlja error kada se stavi $id_2 u save()

				$this->mechanic_m->save($mechanics_array); //za spremanje id servisa i imena mehanicara
																// u tablicu 'mechanics' u odgovarajuće atribute

				
				
				//zapis id servisa u tablicu 'clients'
				$klijent = array('id_client'=>$oruz_row->id_vlasnika, //TREBAO BI BITI ID KLIJENTA!!!
										'id_oruzija_client'=>$id_oruzija);//DODATI JOŠ ID ORUŽIJA KAO UVJET PRETRAGE
				$client_row = $this->client_m->get_by($klijent, TRUE);	//JER ISTI KLIJENT MOŽE IMATI VIŠE ORUŽIJA	
																			// = JEDAN SERVIS
				$id_2 = $client_row->id;
				$client_array = array('servis_client'=>$id_servisa, 'naziv_servisa'=>$naziv_servisa);
				$this->client_m->save($client_array, $id_2);
				
				//zapis id servisa u tablicu oružija 
				$id_oruzija_ = array('id'=>$id_oruzija); //TREBAO BI BITI ID ORUŽIJA!!!
				$weapon_row = $this->weapon_m->get_by($id_oruzija_, TRUE); //izvlači se nešto što se već ima...

				$id_3 = $weapon_row->id;
				$weapon_array = array('pripadni_servis'=>$id_servisa, 'naziv_servisa'=>$naziv_servisa);
				$this->weapon_m->save($weapon_array, $id_3); 


				$ime_vlasnika = $client_row->name_client; //dohvat imena vlasnika

			//spremanje pojedinih naziva u tablicu servisa
			$podaci_2 = array('serviser'=>$ime_mehanicara, 'oruzije'=>$naziv_oruzija, 'vlasnik'=>$ime_vlasnika);
			$this->service_m->save($podaci_2, $id_servisa);

			redirect('admin/service');
		}

		//load view-a
		$this->data['subview'] = 'admin/service/edit'; //view
		$this->data['subview_2'] = 'admin/menu/index';
		$this->load->view('login/_layout_main', $this->data);

	}

	//------------------------------------------------------------------------

	public function delete($id) //argument je $id retka u tablici 'services' - id servisa
	{
		$this->service_m->delete($id); //brisanje retka iz baze servisa 'services'

		$servis_mehanicar_id = array('servis_mehanicar'=>$id);	
		$redak = $this->mechanic_m->get_by($servis_mehanicar_id, TRUE); //dohvati redak gdje je servis_mechanicar==$id 

		$id_2 = $redak->id;

		$this->mechanic_m->delete($id_2); //brisanje retka iz baze 'mechanics'

		redirect('admin/service');
	}

	//------------------------------------------------------------------------

	public function show($id)
	{
		$this->data['service_profile'] = $this->service_m->get($id);

		//format prikaza datuma
		$this->data['datum_pocetka'] = $this->dateform_1($this->data['service_profile']->pocetak_servisa);
		$this->data['datum_kraja'] = $this->dateform_1($this->data['service_profile']->kraj_servisa);

		$this->data['subview'] = 'admin/service/show'; //view
		$this->data['subview_2'] = 'admin/menu/index';

		$this->load->view('login/_layout_main', $this->data);
	}
	
	//------------------------------------------------------------------------

	public function dateform_1($retrieved) //YYYY-MM-DD u DD-MM-YYYY
	{
		$date = DateTime::createFromFormat('Y-m-d', $retrieved);
		return $date->format('d-m-Y');
	}

	//------------------------------------------------------------------------

	public function dateform_2($retrieved) //DD-MM-YYYY u YYYY-MM-DD
	{
		$date = DateTime::createFromFormat('d-m-Y', $retrieved);
		return $date->format('Y-m-d');
	} 

	//------------------------------------------------------------------------

	public function end_service($id)
	{
		$datum_preuz = date('d-m-Y');

		$podaci = array('preuzeto'=>TRUE, 'datum_preuzimanja'=>$datum_preuz);
		$this->service_m->save($podaci, $id);

		redirect('admin/service');

	}
	
}