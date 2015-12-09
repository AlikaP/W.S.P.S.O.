<?php

class User extends Login_Controller
{
	public function __construct()
	{
		parent::__construct();

	}

	//------------------------------------------------------------------------

	public function index() //ispis korisnika
	{	
			
		$this->data['users'] = $this->user_m->get(); //result()

		$this->data['type_options'] = array('Administrator', 'Mehaničar', 'Klijent', 'Zaposlenici', 'Bivši zaposlenici');

			//filtriranje (potrebna pravila)
			$rules_2 = $this->user_m->rules_2; //dohvat varijable 'rules' (koja je array) iz 'user_m'
			$this->form_validation->set_rules($rules_2);

			if ($this->input->post('submit') == 'Filtriraj')     //stranica se refresha klikom na 'save' ali
			{													 // je run() sada TRUE pa vrijedi izraz u {} 
				//pravila ispunjena (save gumb) - filtriranje
				if($this->form_validation->run()==TRUE)
				{

					$this->data['users'] = $this->user_m->filtriranje_1();

					$this->data['type_options'] = array('Administrator', 'Mehaničar', 'Klijent', 'Zaposlenici', 'Bivši zaposlenici');

					//$this->session->set_flashdata('my_super_array', $this->data['users_filtr']); 

					//redirect('admin/user/index', 'refresh');
				}
			}

			//pretrazivanje (potrebna pravila)
			$rules_3 = $this->user_m->rules_3; //dohvat varijable 'rules' (koja je array) iz 'user_m'
			$this->form_validation->set_rules($rules_3);


			if ($this->input->post('submit') == 'Pretraži')
			{
				//pravila ispunjena (save gumb) - filtrirnanje
				if($this->form_validation->run()==TRUE)
				{	

					$this->data['users'] = $this->user_m->pretrazivanje_1();

					//$this->session->set_flashdata('my_super_array_2', $this->data['users_search']);

					//redirect('admin/user/pretrazivanje');
				}
			}



		$this->data['subview'] = 'admin/user/index'; //view

		$this->data['subview_2'] = 'admin/menu/index';


		$this->load->view('login/_layout_main', $this->data);

		

	}

	//------------------------------------------------------------------------

	public function edit($id=NULL) //za edit postojećeg ili stvaranje novog korisnika
	{
		//dohvat korisnika iz tablice ili stvaranje novog (za preliminarni ispis kod edit-a)
		if($id!=NULL)
		{
			$this->data['user'] = $this->user_m->get($id);
			//count($this->data['user']) || $this->data['errors'][] = 'User could not be found'; //ako korisnik nije pronađen, dodati error poruku u error array
				
				/*spremanje trenutnog imena za provjeru pri editiranju (callback username...)
				$url = array('admin/user/edit/'.$id);
				if(in_array(uri_string(), $url)==TRUE) //
				{
					$trenutno_ime = array('trenutno_ime'=>$this->data['user']->name);
					$this->user_m->save($trenutno_ime, $id);	
				}*/

				
		}
		else
		{
			$this->data['user'] = $this->user_m->get_new();
		}

		//pravila forme
		$rules = $this->user_m->rules; //dohvat varijable 'rules' (koja je array) iz 'user_m'

		//password, stavi neka je required ako se pravi novi profil
		if($id==NULL){ $rules['password']['rules'] .= '|required';}    //$rules['password']['rules'] = $rules['password'] . '|required';

		//$id==NULL || $rules['password']['rules'] .= '|required';   //NE RADI  

		$this->form_validation->set_rules($rules);

		//drop-down menu
		$this->data['type_options'] = array('Administrator', 'Mehaničar', 'Klijent');

		if($id==NULL) //ne smije biti 'Bivši zaposlenik' kao opcija pri stvaranju novg korisnika...
		{
			$this->data['type_options_2'] = array('Zaposlenik', 'Nije zaposlenik');
		}
		else
		{
			$this->data['type_options_2'] = array('Zaposlenik', 'Bivši zaposlenik', 'Nije zaposlenik');
		}
		

		//procesiranje forme
		if($this->input->post('submit') == 'Spremi')
		{
			if($this->form_validation->run()==TRUE)
			{
				/* ne radi ako se stavi PRIJE 119. linije $podaci = ... jer array još nije definiran

				$now = date('Y-m-d H:i:s');
				if($id==NULL)
				{$podaci['created'] = $now;}
				elseif($id!=NULL)
				{$podaci['modified'] = $now;}
				*/

				$podaci = $this->user_m->array_from_post(array('ime', 'prezime', 'email', 'password', 'user_type', 'status', 'adresa', 'datum_rodjenja', 'JMBG', 'oruzani_broj', 'kontakt_broj'));
				
				//originalna lozinka - za privremeni ispis pri kreaciji novog profila
				$password_original = $podaci['password'];

				//password hashiranje (kako admin ne bi vidio)
				$podaci['password'] = $this->login_m->hash($podaci['password']);

				//kada se editira Šef, on je automatski admin i zaposlenik (UVIJEK)
				if($id!=NULL)
				{
					if($this->data['user']->nadleznost == 'Šef')
					{
						//$type = array('user_type'=> 'admin'); //ne radi jer se naknadno sprema preko $podaci
						//$this->user_m->save($type, $id);

						$podaci['user_type'] = 'admin';
						$podaci['status'] = 'Zaposlenik';
					}
				}

				
				
				//kada se editira profil, upisuje se stara šifra
				if($id!=NULL)
				{
					$podaci['password'] = $this->data['user']->password;
				}

				//datum format
				$podaci['datum_rodjenja'] = dateform_($podaci['datum_rodjenja']);

				//stvaranje korisničkog imena
				//$prvo_slovo_ime = substr($podaci['ime'], 0,1);
				$username = $podaci['ime'] . $podaci['prezime'];

					$user_result = $this->user_m->get();

					$najveci = 0;

					//$trenutno_ime = $this->data['user']->name;
					//$trenutno_ime_broj = preg_replace('/[^0-9]+/', ' ', $trenutno_ime);

					foreach($user_result as $user_row):

						//$user_name = explode('_', $user_row->name);
						//$name = $user_name['0'] . '_';

						$name= preg_replace("/[^a-zA-ZčćđžšČĆŽŠĐ]+/", '', $user_row->name); //zamijeni sve osim slova u $user_row->name sa ''
						//$name = str_replace($numbers, '', $user_row->name); 

						//ako to NIJE redak korisnika kojeg upravo uređujemo
						if($user_row->id != $id)
						{
							if ($username == $name)
							{
								//$rastavljeni = explode("_", $user_row->name);
								//$broj_username = intval($rastavljeni['1']);

								//preg_match_all('!\d+!', $user_row->name, $broj);
								$broj = preg_replace('/[^0-9]+/', ' ', $user_row->name); //uzima $user_row->name string, zamjenjuje sve znakove sa prazninom osim brojki
								$broj_username = intval($broj);
								if($broj_username >= $najveci)
								{
									$najveci = $broj_username+1;
								}
							}
						}

					endforeach;

					$username = $username . $najveci;

				//spremanje korisničkog imena
				$podaci['name'] = $username;

					/*if($id!=NULL)
					{
						//brisanje vrijednosti 'trenutno_ime'
						$trenutno_ime = array('trenutno_ime'=>NULL);
						$this->user_m->save($trenutno_ime, $id);
					}*/

				//postavljanje tipa korisnika
	    		if($podaci['user_type']=='Administrator'){$podaci['user_type']='admin';}
	   			elseif($podaci['user_type']=='Mehaničar'){$podaci['user_type']='mech';}
	   			elseif($podaci['user_type']=='Klijent'){$podaci['user_type']='client';}
	   			

	   			//ako je client, automatski je 'Nije zaposlenik'
	   			if($podaci['user_type'] == 'client')
				{
					$podaci['status'] = 'Nije zaposlenik';
				}

				//ako se novi korisnik postavi na tip 'admin' ili 'mech', on je automatski zaposlenik
				if($id==NULL)
				{
					if($podaci['user_type'] == 'admin' || $podaci['user_type'] == 'mech')
					{
						$podaci['status'] = 'Zaposlenik';
					}
				}

				//ako se ažurirani korisnik postavi na admina ili mecha i stavi kao 'nije zaposlenik' - on je autoamtski bivši zaposlenik 
				if($id!=NULL)
				{
					if($podaci['user_type'] == 'admin' || $podaci['user_type'] == 'mech')
					{
						if($podaci['status'] == 'Nije zaposlenik')
						{
							$podaci['status'] = 'Bivši zaposlenik';
						}
					}
				}


				$this->user_m->save($podaci, $id);

				
					$novi_user = $this->user_m->get_by($podaci, TRUE); //dohvat novostvorenog korisnika

					//spremanje originalne lozinke (prije hasha)				
					/*	$novi_user->password_original = $password_original;
						$password_array = array('password_original'=> $novi_user->password_original);
						$this->user_m->save($password_array, $novi_user->id);
					*/

					//privremeno spremanje lozinke radi ispisa (za printanje)
					$this->session->set_flashdata('lozinka', $password_original);


					//ažuriranje (NE spremanje) klijenta (ako je klijent) u tablicu klijenata ('clients')
					if($podaci['user_type']=='client')
					{ 
						$klijent_ime = $podaci['name'];
					 	//$klijent_id = $this->data['user']->id;  -još nije stvoren id, izbacuje error
					 	$klijent_id = $novi_user->id; 

					 	$klijent_array = array('name_client'=>$klijent_ime, 'id_client'=>$klijent_id);
					 	
					 	//$novi_klijent_redak = $this->client_m->get_new();  //iz nekog razloga na ovo se ne izbacuje error
					 	//$id_2 = $novi_klijent_redak->id;					//a trebao bi...
					 														//ipak radi i sprema $id_2 = NULL
					 														//isto se dogodi i ako stavimo varijablu bilo kojeg drugog naziva (a nije id)
					 	
					 	$id_array = array('id_client'=>$klijent_id);

					 	$klijent_result = $this->client_m->get_by($id_array, FALSE); //id klijenta je nepromjenjen

					 	if(count($klijent_result))
					 	{	
						 	foreach($klijent_result as $klijent_row): 
						 		$id_clients = $klijent_row->id;
						 		$this->client_m->save($klijent_array, $id_clients);  //nema potrebe za get_new()
																				//save() automatski stvara novi redak ako nema prijenosa id-a
						 	endforeach;
					 	}


					 	//ažuriranje podataka klijenta u tablicama servisa ('services') i oružija ('weapons')

					 	$klijent_array_1 = array('vlasnik'=>$klijent_ime);
					 	$id_array_1 = array('id_vlasnika'=>$klijent_id);

					 	$weapon_result = $this->weapon_m->get_by($id_array_1, FALSE);
					 	$service_result = $this->service_m->get_by($id_array_1, FALSE);

					 	if(count($service_result))
					 	{	
						 	foreach($service_result as $service_row):
							 	$id_service = $service_row->id;
							 	$this->service_m->save($klijent_array_1, $id_service);
							endforeach;
						}

						if(count($weapon_result))
					 	{	
						 	foreach($weapon_result as $weapon_row):
							 	$id_weapon = $weapon_row->id;
					 			$this->weapon_m->save($klijent_array_1, $id_weapon);
							endforeach;
						}

					 	
					}

					//ažuriranje (NE spremanje) mehaničara (ako je mehaničar) u tablicama 'services' i 'mechanics'
					if($podaci['user_type']=='mech')
					{	
						$mehanicar_ime = $podaci['name'];
					 	$mehanicar_id = $novi_user->id; 

					 	$servicer_row = array('serviser'=>$mehanicar_ime, 'id_servisera'=>$mehanicar_id);
						$mechanic_row = array('name_mehanicar'=>$mehanicar_ime, 'id_mehanicar'=>$mehanicar_id);

						$id_array_s = array('id_servisera'=>$mehanicar_id);
						$id_array_m = array('id_mehanicar'=>$mehanicar_id);

						$stari_mehan_result_s = $this->service_m->get_by($id_array_s, FALSE); //ako nema, vraća NULL
						$stari_mehan_result_m = $this->mechanic_m->get_by($id_array_m, FALSE);

						foreach($stari_mehan_result_s as $row_s):  ////ako je stari_mehan = NULL, foreach se uopće ne izvrši,
							$id_services = $row_s->id;									//čak nema ni potrebe za if(count($stari_mehan))
							$this->service_m->save($servicer_row, $id_services);
						endforeach;

						foreach($stari_mehan_result_m as $row_m):
							$id_mechanics = $row_m->id;
							$this->mechanic_m->save($mechanic_row, $id_mechanics);
						endforeach;
											
					}


					//spremanje korisnika u tablicu 'zaposlenici' ukoliko je zaposlenik/bivši zaposlenik
		   			if($podaci['status'] == 'Zaposlenik' && $id==NULL) //ako je novi korisnik zaposlenik...
		   			{
		   				$datum_zaposlenja = date('Y-m-d');
		   				$zaposlenik_array = array('name'=>$username, 'pocetak_rada'=>$datum_zaposlenja);
		   				$this->zaposlenik_m->save($zaposlenik_array, $id);
		   			
		   			}
		   			elseif($podaci['status'] == 'Bivši zaposlenik' && $id!=NULL) //ako je postojeći korisnik bivši zaposlenik...
		   			{
		   				$zaposlenik = array('name'=>$username);
		   				$zaposlenici = $this->zaposlenik_m->get_by($zaposlenik, FALSE);
		   				foreach($zaposlenici as $zaposlen):
		   					if($zaposlen->kraj_rada == "0000-00-00")
		   					{
		   						$id_zaposlenik = $zaposlen->id;
		   					}
		   				endforeach;

		   				$datum_prestanka = date('Y-m-d');
		   				$zaposlenik_array = array('kraj_rada'=>$datum_prestanka);
		   				$this->zaposlenik_m->save($zaposlenik_array, $id_zaposlenik);
		   			}
		   			elseif($podaci['status'] == 'Zaposlenik' && $id!=NULL) //ako je postojeći korisnik zaposlenik... 
		   			{	
		   				$i=FALSE;

		   				$datum_zaposlenja = date('Y-m-d');
			   			$zaposlenik_array = array('name'=>$username);
			   			$zaposlenik_array_2 = array('name'=>$username, 'pocetak_rada'=>$datum_zaposlenja);
			   			$zaposlenik_result = $this->zaposlenik_m->get_by($zaposlenik_array, FALSE);
			   			foreach($zaposlenik_result as $zaposlen):
		   					if($zaposlen->pocetak_rada != "0000-00-00" && $zaposlen->kraj_rada == "0000-00-00") //ako postoji red s tim korisničkim imenom
		   					{																					//koji nema 'kraj_rada'	(nije popunjen)
		   						$i=TRUE;
		   						break;
		   					}
		   				endforeach;

		   				if($i==FALSE) //ako NE postoji barem jedan nepopunjen red...
		   				{
		   					$this->zaposlenik_m->save($zaposlenik_array_2, $id_zaposlenik); //stvori novi red s tim korisničkim imenom
		   				}
		   			}

		   		//redirect
		   		if($id==NULL)
					redirect('admin/printing/index/' . $novi_user->id);  //ako se prvi put pravi, ispiši info (za printanje)
				else
					redirect('admin/user'); //inače preusmjeri nazad na popis
				

			}
			else
			{
				$this->form_validation->set_message('rule', 'Error Message');
			}
		}

		//load view-a
		$this->data['subview'] = 'admin/user/edit'; //view
		$this->data['subview_2'] = 'admin/menu/index';
		$this->load->view('login/_layout_main', $this->data);

	}

	//------------------------------------------------------------------------

	public function delete($id) //brisanje korisnika u slučaju krajnje nužde
	{							//pretpostavlja se ipak da se želi zadržati popis svih korisnika (bivših i sadašnjih)

		

		//bisanje redaka iz tablica 'clients' i 'mechanics' u kojima se nalaze id-ovi korisnika koji smo obrisali s liste korisnika
		$user = $this->user_m->get($id, TRUE);

			if($user->user_type == 'client')
			{	
				$id_user_array = array('id_client'=>$id);
				$id_clients_result = $this->client_m->get_by($id_user_array, FALSE);

				foreach($id_clients_result as $id_clients_row):
					$this->client_m->delete($id_clients_row->id);
				endforeach;
			}

			if($user->user_type == 'mech')
			{
				$id_user_array = array('id_mehanicar'=>$id);
				$id_mechanics_result = $this->mechanic_m->get_by($id_user_array, FALSE);

				foreach($id_mechanics_result as $id_mechanics_row):
					$this->mechanic_m->delete($id_mechanics_row->id); //više redaka
				endforeach;
			}

			//brisanje korisnika iz tablice 'zaposlenici'
			$id_user_array = array('name'=>$user->name);
			$id_z_result = $this->zaposlenik_m->get_by($id_user_array, FALSE);

			foreach($id_z_result as $id_z):
				$this->zaposlenik_m->delete($id_z->id);
			endforeach;

		//dohvat korisnika iz tablice i brisanje istog
		$this->user_m->delete($id); //id retka (samo jednog) 
									//mora biti na kraju, inače nem adohvata id-a iz tablice korisnika za druge radnje 

		//dodatna opcija: brisanjem korisnika sa liste korisnika briše se i servis u kojem se nalazi ime tog korisnika
		// i briše se oružije obrisanog korisnika
		
		//s druge strane, admin to može i ručno (ima mogućnost brisanja redaka tablica servisa i oružija)	

		redirect('admin/user');
	}

	//------------------------------------------------------------------------

	public function show($id)
	{
		$this->data['user_profile'] = $this->user_m->get($id);

			// SLANJE POSEBNIH INFORMACIJA MEHANIČARA (servisi na kojima radi i brojevi)
			$id_m = array('id_mehanicar'=>$id);
			$this->data['mechanics'] = $this->mechanic_m->get_by($id_m, FALSE);

			$r = array('id_mehanicar'=>$id, 'status_servisa'=>'GOTOVO');
			$nr = array('id_mehanicar'=>$id, 'status_servisa'=>'U TIJEKU');
			$nr_2 = array('id_mehanicar'=>$id, 'status_servisa'=>'');

			$rjeseni = $this->mechanic_m->get_by($r, FALSE);
			$nerjeseni = $this->mechanic_m->get_by($nr, FALSE);
			$nerjeseni_2 = $this->mechanic_m->get_by($nr_2, FALSE);

			$this->data['num_services'] = count($this->mechanic_m->get_by($id_m, FALSE));
			$this->data['num_rjeseno'] = count($rjeseni);
			$this->data['num_nerjeseno'] = count($nerjeseni);
			$this->data['num_zahtjeva_pozornost'] = count($nerjeseni_2);  

			// SLANJE POSEBNIH INFORMACIJA KLIJENTA (oružija koja posjeduje i brojevi)
			$id_c = array('id_client'=>$id);
			$this->data['clients'] = $this->client_m->get_by($id_c, FALSE);

			$this->data['num_oruzija'] = count($this->client_m->get_by($id_c, FALSE));

			//PODACI ZAPOSLENIKA/BIVŠEG ZAPOSLENIKA
			$username = $this->data['user_profile']->name;
			$zaposleni = array('name'=>$username);
			$this->data['zaposlenici'] = $this->zaposlenik_m->get_by($zaposleni, FALSE);
		
		$this->data['subview'] = 'admin/user/show'; //view
		$this->data['subview_2'] = 'admin/menu/index';

		$this->load->view('login/_layout_main', $this->data);
	}

	//------------------------------------------------------------------------

	public function username_check($str)
	{	
		$check = TRUE;

		$user_result = $this->user_m->get();

		foreach($user_result as $user_row):

			$trenutno_ime = $user_row->trenutno_ime;

			$name = $user_row->name;

			if ($str == $name && $str != $trenutno_ime)
			{
				$this->form_validation->set_message('username_check', 'The user name field must be unique');
				$check = FALSE; break;
			}
			else //($str != $name && $str == $trenutno_ime)
			{
				$check = TRUE;
			}

		endforeach;

		return $check;
	}

	/*
	//------------------------------------------------------------------------

	public function filtriranje()
	{
		$this->data['users_filtr'] = $this->session->flashdata('my_super_array');
		//load view-a
		$this->data['subview'] = 'admin/user/index_filtr'; //view
		$this->data['subview_2'] = 'admin/menu/index';
		$this->load->view('login/_layout_main', $this->data);

		$rules_2 = $this->user_m->rules_2; //dohvat varijable 'rules' (koja je array) iz 'user_m'
		$this->form_validation->set_rules($rules_2);

		if ($this->input->post('submit') == 'Filtriraj')
		{
			//za ponovno filtriranje liste (cijele, ne filtrirane)
			if($this->form_validation->run()==TRUE)
			{
				$vrijednost = $this->user_m->array_from_post(array('vrijednost_filtra'));
				$tip_korisnika = array('user_type'=>$vrijednost['vrijednost_filtra']);
				$tip_korisnika_result = $this->user_m->get_by($tip_korisnika, FALSE);

				$this->data['users_filtr'] = $tip_korisnika_result;
				//$podaci = $this->data['users_filtr'];

				//redirect('admin/user/filtriranje/' . $this->data['users_filtr']); //ne može proslijediti niz (član niza data, koji sadrži niz objekata tj. redova)
																					//TREBA SPREMATI U SESSION
																					//flashdata - storage in cookies/session/database

				$this->session->set_flashdata('my_super_array', $this->data['users_filtr']);

				redirect('admin/user/filtriranje', 'refresh');
			}
		}

	}

	//------------------------------------------------------------------------

	public function pretrazivanje()
	{
		$this->data['users_search'] = $this->session->flashdata('my_super_array_2');
		//load view-a
		$this->data['subview'] = 'admin/user/index_search'; //view
		$this->data['subview_2'] = 'admin/menu/index';
		$this->load->view('login/_layout_main', $this->data);

		$rules_3 = $this->user_m->rules_3; //dohvat varijable 'rules' (koja je array) iz 'user_m'
		$this->form_validation->set_rules($rules_3);


		if ($this->input->post('submit') == 'Pretrazi')
		{
			//pravila ispunjena (save gumb) - filtrirnanje
			if($this->form_validation->run()==TRUE)
			{
				$search_rastavljeni = array();

					$vrijednost = $this->user_m->array_from_post(array('vrijednost_search'));
					$search_array = $vrijednost['vrijednost_search'];

					$str_trazimo = strstr($search_array, " ");

					if($str_trazimo != NULL)
					{
						$search_rastavljeni = explode(" ", $search_array); //rastavljanje imena i prezimena

						$ime = $search_rastavljeni['0'];
						$prezime = $search_rastavljeni['1'];
						
						$ime_prezime_korisnika = array('ime'=>$ime, 'prezime'=>$prezime);
						$i_p_korisnika_result = $this->user_m->get_by($ime_prezime_korisnika, FALSE);

						$this->data['users_search'] = $i_p_korisnika_result;
					}
					else
					{
						$ime_korisnika = array('ime'=>$search_array);
						$ime_korisnika_result = $this->user_m->get_by($ime_korisnika, FALSE);

						$prezime_korisnika = array('prezime'=>$search_array);
						$prezime_korisnika_result = $this->user_m->get_by($prezime_korisnika, FALSE);

						$name_korisnika = array('name'=>$search_array);
						$name_korisnika_result = $this->user_m->get_by($name_korisnika, FALSE);

						if(count($ime_korisnika_result))
						{
							$this->data['users_search'] = $ime_korisnika_result;
						}
						elseif(count($prezime_korisnika_result))
						{
							$this->data['users_search'] = $prezime_korisnika_result;
						}
						elseif(count($name_korisnika_result))
						{
							$this->data['users_search'] = $name_korisnika_result;
						}
					}
				$this->session->set_flashdata('my_super_array_2', $this->data['users_search']);

				redirect('admin/user/pretrazivanje', 'refresh');
			}
		}	
	}
	*/


	public function _unique_email()
	{
		//ako email već postoji... nemoj raditi validaciju
		//osim ako se radi o mailu trenutnog korisnika

		$id = $this->uri->segment(4); //4. segment iz URI-a (id)
		$this->db->where('email', $this->input->post('email')); //tamo gdje je mail jednak upravo unesenom mailu
		!$id || $this->db->where('id !=', $id); //OSIM ako se radi o mailu trenutnog korisnika (gdje NIJE aktualni id)
												//!id, ako nema id-a (TRUE), iza || se ne izvrši (FALSE) 
		$user = $this->user_m->get(); //dohvati tog korisnika

		if(count($user))
		{
			$this->form_validation->set_message('_unique_email', '%s mora biti jedinstven');
			return FALSE;
		}

		return TRUE;
	}

	//------------------------------------------------------------------------

	public function _unique_pass()
	{
		$id = $this->uri->segment(4);

		if($id == NULL)
		{
				$this->db->where('password', $this->login_m->hash($this->input->post('password'))); 
				$user = $this->user_m->get();
		
				if(count($user))
				{
					$this->form_validation->set_message('_unique_pass', '%s mora biti jedinstvena');
					return FALSE;
				}

				return TRUE;
		}
		else 
		{
			return TRUE;
		}
	}

	//------------------------------------------------------------------------
	/*
	public function testDate()   
	{   
		$value = $this->input->post('datum_rodjenja');
		$datum = preg_match( '^\d{1,2}-\d{1,2}-\d{4}$', $value);

		if($datum==FALSE)
		{
			$this->form_validation->set_message('testDate', '%s je pogrešnog formata');
			return FALSE;
		}  
		else 
		{
			return TRUE;
		} 
	}
	*/
	
}

