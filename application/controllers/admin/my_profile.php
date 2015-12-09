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

		$this->data['subview'] = 'admin/my_profile/index'; //view

		$this->data['subview_2'] = 'admin/menu/index';

		$this->data['profile'] = $this->my_profile_m->profile();

			//tablica 'zaposlenici'
			$name = $this->session->userdata('name');

			$name_z = array('name'=>$name);
			$this->data['zaposlenici'] = $this->zaposlenik_m->get_by($name_z, FALSE);

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
			$this->data['subview'] = 'admin/my_profile/edit'; //view
			$this->data['subview_2'] = 'admin/menu/index';
			$this->load->view('login/_layout_main', $this->data);
		//}

	}  
}