<?php

class Login_Controller extends My_Controller
{
	function __construct()
	{
		parent::__construct();

		

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->library('session');
		

		$this->load->model('login_m');

		$this->load->model('user_m');

		$this->load->model('weapon_m');

		$this->load->model('service_m');

		$this->load->model('mechanic_m');

		$this->load->model('client_m');

		$this->load->model('zaposlenik_m');

		$this->load->model('my_profile_m');

		//..........................................

		//PROVJERA LOGINA
		//preusmjeravanje sa svih stranica ukoliko korisnik nije logiran u sustav
		$exception_uris = array(
			'login/log_in',
			'login/log_out'
			);

		if(in_array(uri_string(), $exception_uris)==FALSE) //ako u URL-u NE piše 'login/log_in' ili 'login/log_out'
		{
			if($this->login_m->loggedin() == FALSE) //i ako korisnik NIJE već logiran
			{
				redirect('login/log_in');
			}
		}

		//..........................................

		//sprječavanje izravnog pristupa

		//if ( ! defined('admin/')) exit('No direct script access allowed');
		//if ( ! defined('mech/')) exit('No direct script access allowed');
		//if ( ! defined('client/')) exit('No direct script access allowed');
		
		//..........................................
		

		//admin
		/*
			$exception_uris_2 = array(
				'mech/dashboard',
				'mech/my_profile',
				'mech/service',
				'mech/weapon',
				'mech/about',
				'client/dashboard',
				'client/about',
				'client/my_profile'

				);
		*/

			if(($this->uri->segment(1))=='mech' || ($this->uri->segment(1))=='client') //
			{
				if($this->login_m->loggedin() == TRUE && $this->session->userdata('user_type')=="admin") //
				{
					redirect('admin/dashboard');	
				}
			}

		//mech
		/*
			$exception_uris_3 = array(
				'admin/dashboard',
				'admin/migration',
				'admin/my_profile',
				'admin/service',
				'admin/user/',
				'admin/weapon',
				'admin/about',
				'admin/status',
				'client/dashboard',
				'client/about',
				'client/my_profile'				
				
				);
		*/
			

			if(($this->uri->segment(1))=='admin' || ($this->uri->segment(1))=='client') //
			{

				if($this->login_m->loggedin() == TRUE && $this->session->userdata('user_type')=="mech") //
				{
					redirect('mech/dashboard');	
				}
			}

		//client 
		/*
			$exception_uris_4 = array(
				'admin/dashboard',
				'admin/migration',
				'admin/my_profile',
				'admin/service',
				'admin/user',
				'admin/weapon',
				'admin/about',
				'admin/status',
				'mech/dashboard',
				'mech/my_profile',
				'mech/service',
				'mech/weapon',
				'mech/about',
				
				);
		*/

			if(($this->uri->segment(1))=='admin' || ($this->uri->segment(1))=='mech') //
			{
				if($this->login_m->loggedin() == TRUE && $this->session->userdata('user_type')=="client") //
				{
					redirect('client/dashboard');	
				}
			}

		//printing

			$exception_uris_printing = array(
				'admin/printing'
				);

			if(($this->uri->segment(2))=='printing') //
			{
				if($this->session->flashdata('lozinka')==NULL) //
				{
					redirect('login/log_in');	
				}
			}

			
			//ako je korisnik Šef ili ako je servis zaključan
			//onemogućavanje izravnog pristupa
			/*
			$id1=0;
			$id2=0;
			if(count($id1) || count($id2)){
				$exception_uris_5 = array(
					'admin/edit/' . $id1,   //servis zaključan
					'admin/delete/' . $id2,  //Šef
					
					);

				

					if(in_array(uri_string(), $exception_uris_5) == TRUE) //
					{
						if($this->login_m->loggedin() == TRUE)
						{
							$user = $this->user_m->get($id2);
							$service = $this->service_m->get($id1);
							if($service->preuzeto==TRUE || $user->nadleznost=='Šef') //
							{
								redirect('admin/dashboard');
							}
						}
					}
			} */
		
		//..........................................
			

		//onemogućavanje izravnog brisanja Šefa
		$nadleznost_array = array('nadleznost'=>'Šef');
		$users = $this->user_m->get_by($nadleznost_array, FALSE);

		foreach($users as $user):
			
				$exception_uris_5_1 = array(
					'admin/user/delete/' . $user->id,  //Šef
					
					);


					if(in_array(uri_string(), $exception_uris_5_1) == TRUE) //
					{
						if($this->login_m->loggedin() == TRUE)
						{
							
							redirect('login/log_in');
							
						}
					}
			
		endforeach;

		//onemogućavanje izravnog editiranja zaključanog servisa
		$preuzeto_array = array('preuzeto'=>TRUE);
		$services = $this->service_m->get_by($preuzeto_array, FALSE);

		foreach($services as $service):
			
				$exception_uris_5_2 = array(
					'admin/service/edit/' . $service->id,  //zaključani servis
					
					);


					if(in_array(uri_string(), $exception_uris_5_2) == TRUE) //
					{
						if($this->login_m->loggedin() == TRUE)
						{
							
							redirect('login/log_in');
							
						}
					}
			
		endforeach;

		

		//brisanje svih 'password_original' kada se napusti stranica za printanje
		/*
		$exception_uris_pass = array('admin/printing');

		if(in_array(uri_string(), $exception_uris_pass)==FALSE) //
		{
			$users = $this->user_m->get();


			foreach($users as $user):
				$originalna_lozinka = array('password_original'=>'-');
				$this->user_m->save($originalna_lozinka, $user->id);	
			endforeach;
		}
		*/
	}





}