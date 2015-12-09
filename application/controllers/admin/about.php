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
		$this->data['subview'] = 'admin/about/index'; //view
		$this->data['subview_2'] = 'admin/menu/index';
		$this->load->view('login/_layout_main', $this->data);

	}
}