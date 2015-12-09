<?php

class Status extends Login_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	//------------------------------------------------------------------------

	public function index() 
	{
		//korisnici
		$a_array = array('user_type'=>'admin');
		$m_array = array('user_type'=>'mech');
		$c_array = array('user_type'=>'client');
		$z_array = array('status'=>'Zaposlenik');
		$bz_array = array('status'=>'Bivši zaposlenik');

		$users = $this->user_m->get();
		$admin_users = $this->user_m->get_by($a_array, FALSE);
		$mech_users = $this->user_m->get_by($m_array, FALSE);
		$client_users = $this->user_m->get_by($c_array, FALSE);
		$em_users = $this->user_m->get_by($z_array, FALSE);
		$ex_users = $this->user_m->get_by($bz_array, FALSE); 

		$this->data['num_users'] = count($users);
		$this->data['num_admins'] = count($admin_users);
		$this->data['num_mechanics'] = count($mech_users);
		$this->data['num_clients'] = count($client_users);
		$this->data['num_emplo'] = count($em_users)-1;
		$this->data['num_ex'] = count($ex_users);

		//oružija
		$weapons = $this->weapon_m->get();
		$this->data['num_weapons'] = count($weapons);

		//servisi
		$g_array = array('status'=>'GOTOVO');
		$ut_array = array('status'=>'U TIJEKU');
		$p_array = array('status'=>'');  //ne radi ako je NULL

		$services = $this->service_m->get();
		$over_services = $this->service_m->get_by($g_array, FALSE);
		$pending_services = $this->service_m->get_by($ut_array, FALSE);
		$p_services = $this->service_m->get_by($p_array, FALSE);

		$this->data['num_services'] = count($services);
		$this->data['num_over'] = count($over_services);
		$this->data['num_pending'] = count($pending_services);
		$this->data['num_p'] = count($p_services);

		//load
		$this->data['subview'] = 'admin/status/index'; //view
		$this->data['subview_2'] = 'admin/menu/index';
		$this->load->view('login/_layout_main', $this->data);

	}
}