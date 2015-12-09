<?php

class About extends Login_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	//------------------------------------------------------------------------

	public function index() 
	{
		
		

		//load
		$this->data['subview'] = 'mech/about/index'; //view
		$this->data['subview_2'] = 'mech/menu/index';
		$this->load->view('login/_layout_main', $this->data);

	}
}