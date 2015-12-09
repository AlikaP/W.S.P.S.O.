<?php

class Printing extends Login_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	//---------------------------------------------------------------------------------------------


	public function index($id)
	{

		$this->data['subview'] = 'admin/print/index'; //view

		$this->data['subview_2'] = 'admin/menu/index';

		$this->data['profile'] = $this->user_m->get($id);

		$this->load->view('login/_layout_main', $this->data);

	} 
}