<?php

class Weapon extends Login_Controller
{	
	//public $servis_result = array();

	public function __construct()
	{
		parent::__construct();
	}

	//------------------------------------------------------------------------

	public function index() //ispis oružija       //'mechanics'-->'services'-->'weapons'
	{	
		//ispis oružija za čiji je popravak odgovoran logirani mehaničar

		/*
		$user = $this->session->userdata('name'); //dohvat imena prijavljenog mehaničara iz aktualne sesije

		if(count($user)!=NULL) //TRUE
		{
			$name = array(

				'name_mehanicar'=>$user
				
				);
		}
																//result, niz objekata
		$servisiranje = $this->mechanic_m->get_by($name, FALSE); //dohvat redaka svih servisa tog mehaničara
		
		foreach($servisiranje as $servis):  //trebaju nam pojedini objekti

			if(count($servisiranje)!=NULL) //TRUE
			{
				$servis_id = array(
						
					//2D NIZ????

					'id'=>$servis->servis_mehanicar  //id servisa
					
					); 
			}

			$servis_result[] = $this->service_m->get_by($servis_id, FALSE); //spremamo pojedinačno svaku grupu redova
																			//gdje je 
																			// 'id' = $servis->servis_mehanicar (id servisa iz tablice 'mechanics')
																			// u prazan niz

		endforeach;


		//servis_result[] -niz nizova objekata


		if(count($servis_result)!=NULL) //TRUE
		{foreach($servis_result as $serv):
			$naziv_oruzija = array(

				'name'=>$serv->oruzije  //ime oružija
				
				);
			endforeach;
		}


		$this->data['weapons'] = $this->weapon_m->get_by($naziv_oruzija, FALSE); //result()

		//NE VALJA - bez foreach() ispiše samo zadnju vrijednost u nizu (bazuka) - 

		*/

		$user = $this->session->userdata('name'); //dohvat imena prijavljenog mehaničara iz aktualne sesije

		if(count($user)!=NULL) //TRUE
		{
			$imena_oruzija = array(

				'name_mehanicar'=>$user
				
				);
		}

		/*
		$oruzija = array(); //prazan niz koji će biti niz objekata
		$imena_oruzija_2 = array(); //niz u koji spremamo imena svih oružija pod tim mehaničarom iz tablice 'mehanics'

		$oruzija_result = $this->mechanic_m->get_by($imena_oruzija, FALSE);

		//oružija se ne smiju ponavljati
		foreach($oruzija_result as $key=>$oruzije_row):
			$imena_oruzija_2[$key] = $oruzije_row->oruzije_mehanicar;  //sprema jedno po jedno ime oružija u niz
		endforeach;
		
		foreach($oruzija_result as $key=>$oruzije_row):  //za svaki red
		$i = 0;
			foreach($imena_oruzija_2 as $vrijednost): 
				if($oruzije_row->oruzije_mehanicar == $vrijednost)		//uspoređuje se ime oružija iz tog reda sa svim imenima iz niza $imena_oruzija_2
				{									//ako se 1 poklapa... 	
					$oruzija[$key] = $oruzije_row; //ime tog oružija se sprema u drugi niz, $oruzija 
					$i = 1;									//brojač odbroji 1 
				}

				if($i == 1)	//ako je brojač odbrojao 1, znači da je ime oružija već pronađeno
					break;	//izlaz iz foreach
			endforeach;
		endforeach;			//i opet sve za idući red...
		*/
		//$oruzija_2 = array('test');
		$oruzija = array(); //prazan niz koji će biti niz objekata
		$imena_oruzija_2 = array('test'); //niz u koji jedno po jedno spremamo imena svih oružija pod tim mehaničarom iz tablice 'mehanics'
										  //NIZ NE SMIJE BITI PRAZAN JER SE TADA foreach NI NE IZVRŠI

		$oruzija_result = $this->mechanic_m->get_by($imena_oruzija, FALSE);
		/*
		foreach($oruzija_result as $key=>$oruzije_row):
			$trenutna_vrijednost = $oruzije_row->oruzije_mehanicar;  //ime oruzija iz aktualnog retka je trenutna vrijednost
			
			foreach($imena_oruzija_2 as $key2=>$vrijednost):	//trenutna vrijednost se uspoređuje sa svim članovima niza
				if($trenutna_vrijednost != $vrijednost && $trenutna_vrijednost != $oruzija_2[$key2])
				{   //ako nema takvih imena...
					$oruzija[$key] = $oruzije_row; 			//taj redak se sprema u niz $oruzija
					$oruzija_2[$key] = $oruzije_row->oruzije_mehanicar;
					$imena_oruzija_2[$key2] = $trenutna_vrijednost;} //ime oruzija se sprema u niz $imena_oruzija_2 (čije članove koristimo za provjeru)
				else break; //ako pak postoji član s istim imenom, izlaz iz petlje
			endforeach;

		endforeach;
		*/

		foreach($oruzija_result as $glavni_key=>$oruzije_row):
			$i=0;
			$trenutna_vrijednost = $oruzije_row->oruzije_mehanicar;  //ime oruzija iz aktualnog retka je trenutna vrijednost
			
			foreach($imena_oruzija_2 as $key=>$vrijednost):	//trenutna vrijednost se uspoređuje sa svim članovima niza
				if($trenutna_vrijednost == $vrijednost)
				{   $i++;}
			endforeach;

			if($i==0)
			{
				$oruzija[$glavni_key] = $oruzije_row; 			//taj redak se sprema u niz $oruzija
					
				$imena_oruzija_2[$glavni_key] = $trenutna_vrijednost;//ime oruzija se sprema u niz $imena_oruzija_2 (čije članove koristimo za provjeru)
			}		

		endforeach;

		$this->data['weapons'] = $oruzija;


		//pretrazivanje (potrebna pravila)
			$rules_3 = $this->weapon_m->rules_3; 
			$this->form_validation->set_rules($rules_3);


			if ($this->input->post('submit') == 'Pretraži')
			{
				//pravila ispunjena (save gumb) - filtrirnanje
				if($this->form_validation->run()==TRUE)
				{	
						$user = $this->session->userdata('name'); //dohvat imena prijavljenog mehaničara iz aktualne sesije

							if(count($user)!=NULL) //TRUE
							{
								$imena_oruzija = array(

									'name_mehanicar'=>$user
									
									);
							}

							$oruzija = array(); //prazan niz koji će biti niz objekata
							$imena_oruzija_2 = array('test'); //niz u koji jedno po jedno spremamo imena svih oružija pod tim mehaničarom iz tablice 'mehanics'
															  //NIZ NE SMIJE BITI PRAZAN JER SE TADA foreach NI NE IZVRŠI

							$oruzija_result = $this->mechanic_m->get_by($imena_oruzija, FALSE);


							foreach($oruzija_result as $glavni_key=>$oruzije_row):
								$i=0;
								$trenutna_vrijednost = $oruzije_row->oruzije_mehanicar;  //ime oruzija iz aktualnog retka je trenutna vrijednost
								
								foreach($imena_oruzija_2 as $key=>$vrijednost):	//trenutna vrijednost se uspoređuje sa svim članovima niza
									if($trenutna_vrijednost == $vrijednost)
									{   $i++;}
								endforeach;

								if($i==0)
								{
									$oruzija[$glavni_key] = $oruzije_row; 			//taj redak se sprema u niz $oruzija
										
									$imena_oruzija_2[$glavni_key] = $trenutna_vrijednost;//ime oruzija se sprema u niz $imena_oruzija_2 (čije članove koristimo za provjeru)
								}		

							endforeach;



					$this->data['weapons'] = $this->weapon_m->pretrazivanje_2($oruzija);

					//$this->session->set_flashdata('my_super_array_2', $this->data['users_search']);

					//redirect('admin/user/pretrazivanje');
				}
			}


		
		$this->data['subview'] = 'mech/weapon/index'; //view

		$this->data['subview_2'] = 'mech/menu/index';

		$this->load->view('login/_layout_main', $this->data);

	}

	//------------------------------------------------------------------------

	public function edit($id=NULL) //za edit postojećeg ili stvaranje novog oružja
	{
		

	}

	//------------------------------------------------------------------------

	public function delete($id)
	{
		
	}

	//------------------------------------------------------------------------

	public function show($id)
	{
		//$naziv_oruzija = array('id'=>$naziv);

		$this->data['weapon_profile'] = $this->weapon_m->get($id); //u tablici oružija izvaditi redak sa nazivom tog oružija

			// SLANJE POSEBNIH INFORMACIJA ORUŽIJA (servisi u kojima se nalazi)
			$id_w = array('id_oruzija'=>$id);
			$this->data['services'] = $this->service_m->get_by($id_w, FALSE);

		$this->data['subview'] = 'mech/weapon/show'; //view
		$this->data['subview_2'] = 'mech/menu/index';

		$this->load->view('login/_layout_main', $this->data);
	}
	
}