<?php

class My_profile extends Login_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	//---------------------------------------------------------------------------------------------


	public function index()
	{
		$this->load->model('my_profile_m');

		$this->data['subview'] = 'mech/my_profile/index'; //view

		$this->data['subview_2'] = 'mech/menu/index';

		$this->data['profile'] = $this->my_profile_m->profile();

			//posebne informacije o servisima za mehaničara
			$id = $this->session->userdata('id');

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
		
		$this->load->view('login/_layout_main', $this->data);

	} 

	//---------------------------------------------------------------------------------------------


	public function edit($id)
	{
		//if($id==$this->session->userdata('id'))
		//{
			$rules = $this->my_profile_m->rules;  

			$this->form_validation->set_rules($rules);

			if($this->form_validation->run()==TRUE)
			{
				$podaci = $this->user_m->array_from_post(array('password'));

				//password hashiranje
				$podaci['password'] = $this->login_m->hash($podaci['password']);

				$this->user_m->save($podaci, $id);


				redirect('admin/my_profile'); 
			}

			//load view-a
			$this->data['subview'] = 'mech/my_profile/edit'; //view
			$this->data['subview_2'] = 'mech/menu/index';
			$this->load->view('login/_layout_main', $this->data);
		//}

	}
}