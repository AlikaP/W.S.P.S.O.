<?php

class Weapon extends Login_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	//------------------------------------------------------------------------

	public function index() //ispis korisnika
	{	
			
		$this->data['weapons'] = $this->weapon_m->get(); //result()


			//pretrazivanje (potrebna pravila)
			$rules_3 = $this->weapon_m->rules_3; 
			$this->form_validation->set_rules($rules_3);


			if ($this->input->post('submit') == 'Pretraži')
			{
				//pravila ispunjena (save gumb) - filtrirnanje
				if($this->form_validation->run()==TRUE)
				{	

					$this->data['weapons'] = $this->weapon_m->pretrazivanje_1();

					//$this->session->set_flashdata('my_super_array_2', $this->data['users_search']);

					//redirect('admin/user/pretrazivanje');
				}
			}

		$this->data['subview'] = 'admin/weapon/index'; //view

		$this->data['subview_2'] = 'admin/menu/index';

		$this->load->view('login/_layout_main', $this->data);

	}

	//------------------------------------------------------------------------

	public function edit($id=NULL) //za edit postojećeg ili stvaranje novog oružja
	{
		//dohvat korisnika iz tablice ili stvaranje novog
		if($id!=NULL)
		{
			$this->data['weapon'] = $this->weapon_m->get($id);
			//count($this->data['user']) || $this->data['errors'][] = 'User could not be found'; //ako korisnik nije pronađen, dodati error poruku u error array
			
				/*spremanje trenutnog imena za provjeru pri editiranju (callback username...)
				$trenutno_ime = array('trenutno_ime'=>$this->data['weapon']->name);
				$this->weapon_m->save($trenutno_ime, $id); */
		}
		else
		{
			$this->data['weapon'] = $this->weapon_m->get_new();
		}

		//pravila forme
		$rules = $this->weapon_m->rules; //dohvat varijable 'rules' (koja je array) iz 'user_m'
		$this->form_validation->set_rules($rules);

		//slanje liste korisnika (drop-down menu)
		$user_type_client = array('user_type'=>'client');
		$this->data['users_options'] = $this->user_m->get_by($user_type_client, FALSE);

		//$id || $rules['password']['rules'] .= '|required';    //$rules['password']['rules'] = $rules['password'] . '|required';

		//procesiranje forme
		if($this->form_validation->run()==TRUE)
		{
			$podaci = $this->weapon_m->array_from_post(array('puni_naziv', 'vlasnik', 'vrsta', 'marka', 'serijski_broj', 'kalibar', 'dodaci'));
			//$data['password'] = $this->user_m->hash(data['password']);

			//stvaranje korisničkog imena
			$weaponname = $podaci['puni_naziv'] . '#';

				$weapon_result = $this->weapon_m->get();

				$najveci = 0;

				foreach($weapon_result as $weapon_row):

					//$trenutno_ime = $weapon_row->trenutno_ime;

					$weapon_name = explode('#', $weapon_row->name);
					$name = $weapon_name['0'] . '#';

					//$name= preg_replace("/[^a-zA-Zčćđžš]+/", '', $user_row->name); //zamijeni sve osim slova u $user_row->name sa ''
					//$name = str_replace($numbers, '', $user_row->name); 

					if($weapon_row->id != $id)
					{
						if ($weaponname == $name)
						{
							$rastavljeni = explode("#", $weapon_row->name);
							$broj_weaponname = intval($rastavljeni['1']);

							//preg_match_all('!\d+!', $user_row->name, $broj);
							//$broj = preg_replace('/[^0-9]+/', ' ', $user_row->name); //uzima $user_row->name string, zamjenjuje sve znakove sa prazninom osim brojki
							//$broj_username = intval($broj);
							if($broj_weaponname >= $najveci)
							{
								$najveci = $broj_weaponname+1;
							}
						}
					}

				endforeach;

				$weaponname = $weaponname . $najveci;

			$podaci['name'] = $weaponname;

				/*if($id!=NULL)
					{
						//brisanje vrijednosti 'trenutnog imena'
						$trenutno_ime = array('trenutno_ime'=>NULL);
						$this->weapon_m->save($trenutno_ime, $id);
					}*/
			
			$id_oruzija = $this->weapon_m->save($podaci, $id); //save() vraća id retka

				$naziv_oruzija = $podaci['name'];
				$ime_vlasnika = $podaci['vlasnik'];

				$ime_vlasnika_array = array('name'=>$ime_vlasnika);
				$klijent_row = $this->user_m->get_by($ime_vlasnika_array, TRUE);
				$klijent_id = $klijent_row->id;

					/* NE RADI JER SE NAZIV ORUŽIJA PROMIJENIO TE SE NE MOŽE DOHVATITI
					$naziv_oruzija_array = array('oruzije_client'=>$naziv_oruzija);
					$clients_row = $this->client_m->get_by($naziv_oruzija_array, TRUE);
					$clients_id = $clients_row->id;
					*/

					$id_oruzija_array = array('id_oruzija_client'=>$id_oruzija);
					$clients_row = $this->client_m->get_by($id_oruzija_array, TRUE);
					$clients_id = $clients_row->id;

					//spremanje novog klijenta u tablicu klijenata ('clients') 
				 	$klijent = array('name_client'=>$ime_vlasnika, 'id_client'=>$klijent_id,
				 						'oruzije_client'=>$naziv_oruzija, 'id_oruzija_client'=>$id_oruzija);
					 	
				 	$this->client_m->save($klijent, $clients_id);  //nema potrebe za get_new()
					 									//save() automatski stvara novi redak ako nema prijenosa id-a


				 	//update naziva oružija u tablici mehanicara 'mechanics'
				 	$id_oruzija_array_2 = array('id_oruzije_mehanicar'=>$id_oruzija);
				 	$oruzije = array('oruzije_mehanicar'=>$naziv_oruzija);
				 	$mechanic_result = $this->mechanic_m->get_by($id_oruzija_array_2, FALSE);

				 	if(count($mechanic_result))
				 	{
					 	foreach ($mechanic_result as $mechanic_row)
					 	{
					 		$mechanic_id = $mechanic_row->id;
					 		$this->mechanic_m->save($oruzije, $mechanic_id);
					 	}
				 	}

				 	//update naziva oružija u tablici servisa 'services'
				 	$id_oruzija_array_3 = array('id_oruzija'=>$id_oruzija);
				 	$oruzije = array('oruzije'=>$naziv_oruzija);
				 	$oruzije_result = $this->service_m->get_by($id_oruzija_array_3, FALSE);

				 	if(count($oruzije_result))
				 	{
					 	foreach ($oruzije_result as $oruzije_row)
					 	{
					 		$oruz_id = $oruzije_row->id;
					 		$this->service_m->save($oruzije, $oruz_id);
					 	}
				 	}


			//automatsko spremanje imena vlasnika oružija ('vlasnik') u tablicu oružija, prema id-u	
			//$podaci_2 = array('name'=>$podaci['name'], 'vlasnik'=>$ime_vlasnika,);	
			$podaci_2 = array('id_vlasnika'=>$klijent_id);
			$this->weapon_m->save($podaci_2, $id_oruzija);

				/*								
				//spremanje oružija u tablicu klijenata ('clients')
				$id_vlasnika = array('id_client'=>$klijent_id); //TREBAO BI BITI ID VLASNIKA!!!!
				$vlasnik_row = $this->client_m->get_by($id_vlasnika, FALSE); 
				$id_2 = $vlasnik_row->id; //dohvat id-a tog retka

				$oruzije = array('oruzije_client'=>$podaci['name'],
									'id_oruzija_client'=>$id_oruzija); //TREBAO BI BITI ID ORUŽIJA!!!

				$this->client_m->save($oruzije, $id_2);

				*/
							

			redirect('admin/weapon');
		}

		//load view-a
		$this->data['subview'] = 'admin/weapon/edit'; //view
		$this->data['subview_2'] = 'admin/menu/index';
		$this->load->view('login/_layout_main', $this->data);

	}

	//------------------------------------------------------------------------

	public function delete($id)
	{	
		//obriše li se oružije, brišu se i redovi iz tablica 'clients' i 'mechanics' s tim oružijem

			//tablica 'clients'
				$id_weapon_array_c = array('id_oruzija_client'=>$id);
				$id_clients_result = $this->client_m->get_by($id_weapon_array_c, FALSE);

				foreach($id_clients_result as $id_clients_row):
					$this->client_m->delete($id_clients_row->id);
				endforeach;
			

			//tablica 'mechanics'
				$id_weapon_array_m = array('id_oruzije_mehanicar'=>$id);
				$id_mechanics_result = $this->mechanic_m->get_by($id_weapon_array_m, FALSE);

				foreach($id_mechanics_result as $id_mechanics_row):
					$this->mechanic_m->delete($id_mechanics_row->id); //više redaka
				endforeach;
			

		//dohvat oružija iz tablice i brisanje istog
		$this->weapon_m->delete($id);

		redirect('admin/weapon');
	}

	//------------------------------------------------------------------------

	public function show($id)
	{
		$this->data['weapon_profile'] = $this->weapon_m->get($id);

			// SLANJE POSEBNIH INFORMACIJA ORUŽIJA (servisi u kojima se nalazi)
			$id_w = array('id_oruzija'=>$id);
			$this->data['services'] = $this->service_m->get_by($id_w, FALSE);
		
		$this->data['subview'] = 'admin/weapon/show'; //view
		$this->data['subview_2'] = 'admin/menu/index';

		$this->load->view('login/_layout_main', $this->data);
	}

	//------------------------------------------------------------------------

	public function weapon_check($str)   //|callback_weapon_check
	{
		$check = TRUE;

		$weapon_result = $this->weapon_m->get();

		foreach($weapon_result as $weapon_row):

			$trenutno_ime = $weapon_row->trenutno_ime;

			$weapon = $weapon_row->name;

			if ($str == $weapon && $str != $trenutno_ime)
			{
				$this->form_validation->set_message('weapon_check', 'The wepon name field must be unique');
				$check = FALSE; break;
			}
			else
			{
				$check = TRUE;
			}

		endforeach;

		return $check;
	}
	
}