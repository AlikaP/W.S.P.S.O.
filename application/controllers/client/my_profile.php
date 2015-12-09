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

		$this->data['subview'] = 'client/my_profile/index'; //view

		$this->data['subview_2'] = 'client/menu/index';

		$this->data['profile'] = $this->my_profile_m->profile();

			//ispis i broj oružija u vlasništvu
			$id = $this->session->userdata('id');
			$id_c = array('id_client'=>$id);
			$this->data['clients'] = $this->client_m->get_by($id_c, FALSE);

			$this->data['num_oruzija'] = count($this->client_m->get_by($id_c, FALSE));



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
			$this->data['subview'] = 'client/my_profile/edit'; //view
			$this->data['subview_2'] = 'client/menu/index';
			$this->load->view('login/_layout_main', $this->data);
		//}

	}
}