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

		$this->data['subview'] = 'admin/my_profile/index'; //view

		$this->data['subview_2'] = 'admin/menu/index';

		$this->data['profile'] = $this->my_profile_m->profile();
		$this->load->view('login/_layout_main', $this->data);

	} 
}