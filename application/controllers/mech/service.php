<?php

class Service extends Login_Controller
{

	public $rules = array(   //pravila za unos korisnika
		/*
		'vlasnik' => array(
			'field' => 'vlasnik', 
			'label' => 'Vlasnik', 
			'rules' => 'trim|required|xss_clean'
		), 
		'oruzije' => array(
			'field' => 'oruzije', 
			'label' => 'Oruzije', 
			'rules' => 'trim|required|xss_clean'
		),
		'serviser' => array(
			'field' => 'serviser', 
			'label' => 'Serviser', 
			'rules' => 'trim|required|xss_clean'
		),  
		
		*/

		'kraj_servisa' => array(
			'field' => 'kraj_servisa', 
			'label' => 'Kraj servisa', 
			'rules' => 'trim|required|exactlength[10]|xss_clean|regex_match[/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/]'
		), 
		
		'status' => array(
			'field' => 'status', 
			'label' => 'Status', 
			'rules' => 'trim|required|xss_clean'
		),

		'komentar' => array(
			'field' => 'komentar', 
			'label' => 'Komentar', 
			'rules' => 'trim|required|xss_clean'
		)
	);

	public function __construct()
	{
		parent::__construct();
	}

	//------------------------------------------------------------------------

	public function index() //ispis korisnika
	{	
		
		$id = $this->session->userdata('id'); //dohvat id-a prijavljenog mehaničara iz aktualne sesije

		$id_mehanicar = array('id_servisera'=>$id);

		$this->data['services'] = $this->service_m->get_by($id_mehanicar, FALSE); //result(), FALSE - moguće više redova

		//$this->data['services_2'] = $this->service_m->get_by($, FALSE); //za dohvat id-a iz tablice 'services'

		$this->data['type_options'] = array('GOTOVO', 'U TIJEKU', 'U OBRADI');

			//filtriranje (potrebna pravila)
			$rules_2 = $this->service_m->rules_2; //dohvat varijable 'rules' (koja je array) iz 'user_m'
			$this->form_validation->set_rules($rules_2);

			if ($this->input->post('submit') == 'Filtriraj')     //stranica se refresha klikom na 'save' ali
			{													 // je run() sada TRUE pa vrijedi izraz u {} 
				//pravila ispunjena (save gumb) - filtriranje
				if($this->form_validation->run()==TRUE)
				{
					$id = $this->session->userdata('id'); //dohvat id-a prijavljenog mehaničara iz aktualne sesije

					$id_mehanicar = array('id_servisera'=>$id);

					$servisi = $this->service_m->get_by($id_mehanicar, FALSE);

					$this->data['services'] = $this->service_m->filtriranje_2($servisi);

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
					$id = $this->session->userdata('id'); //dohvat id-a prijavljenog mehaničara iz aktualne sesije

					$id_mehanicar = array('id_servisera'=>$id);

					$servisi = $this->service_m->get_by($id_mehanicar, FALSE);

					$this->data['services'] = $this->service_m->pretrazivanje_2($servisi);

					$this->data['type_options'] = array('GOTOVO', 'U TIJEKU', 'U OBRADI');

					//$this->session->set_flashdata('my_super_array_2', $this->data['users_search']);

					//redirect('admin/user/pretrazivanje');
				}
			}


		$this->data['subview'] = 'mech/service/index'; //view

		$this->data['subview_2'] = 'mech/menu/index';

		$this->load->view('login/_layout_main', $this->data);

	}

	//------------------------------------------------------------------------

	public function edit($id) 
	{
		//dohvat iz tablice
		$this->data['service_2'] = $this->service_m->get($id, TRUE);
			//count($this->data['user']) || $this->data['errors'][] = 'User could not be found'; //ako korisnik nije pronađen, dodati error poruku u error array
		
		$this->data['options'] = array('U TIJEKU', 'GOTOVO');

		//pravila forme
		//$rules = $this->service_m->rules; //dohvat varijable 'rules' (koja je array) iz 'user_m'
		$this->form_validation->set_rules($this->rules);

		
		//procesiranje forme
		if($this->form_validation->run()==TRUE)
		{
			$podaci = $this->service_m->array_from_post(array('kraj_servisa', 'status', 'komentar'));
			//$data['password'] = $this->user_m->hash(data['password']);

			$this->data['options'] = array('U TIJEKU', 'GOTOVO');

			//datum format
			$podaci['kraj_servisa'] = dateform_($podaci['kraj_servisa']);
	
			$id_servisa = $this->service_m->save($podaci, $id);


				//zapis statusa servisa u tablicu 'mechanics'
				$mechanics_array = array('status_servisa'=>$podaci['status']); //
				$id_serv = array('servis_mehanicar'=>$id_servisa);
				$mechanic_row = $this->mechanic_m->get_by($id_serv, TRUE);

				$this->mechanic_m->save($mechanics_array, $mechanic_row->id); 


			redirect('mech/service');
		}

		//load view-a
		$this->data['subview'] = 'mech/service/edit'; //view
		$this->data['subview_2'] = 'mech/menu/index';
		$this->load->view('login/_layout_main', $this->data);
	}

	//------------------------------------------------------------------------

	public function delete($id)
	{
		
	}

	//------------------------------------------------------------------------

	public function show($id)
	{
		$this->data['service_profile'] = $this->service_m->get($id);

		//format prikaza datuma
		$this->data['datum_pocetka'] = $this->dateform_1($this->data['service_profile']->pocetak_servisa);
		$this->data['datum_kraja'] = $this->dateform_1($this->data['service_profile']->kraj_servisa);
		
		$this->data['subview'] = 'mech/service/show'; //view
		$this->data['subview_2'] = 'mech/menu/index';

		$this->load->view('login/_layout_main', $this->data);
	}

	//------------------------------------------------------------------------
	/*
	public function checkDateFormat($date)
	{
		if (preg_match("/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/", $date)) //regex
		{
			//if(checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)))
			return TRUE;
			
		}
		else 
		{
			return FALSE;
		}
	}
	*/
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
	
	
}