<?php

class Dashboard extends Login_Controller
{
	public function __construc()
	{
		parent::__construct();
	}

	//------------------------------------------------------------------------

	public function index()
	{
												//'Welcome'
		$this->data['subview'] = 'mech/dashboard/index';  // važan je redosljed linija...

		$this->data['subview_2'] = 'mech/menu/index';
		
		$this->load->view('login/_layout_main', $this->data); //
															//otvara se naslovna (_layout_main)
															//svi podaci ($data['site_name']) se prebacuju u view 
	
		
	}

	//------------------------------------------------------------------------
	/*
	public function modal()
	{
		$this->load->view('login/_layout_modal', $this->data);
	}
	*/

	
}