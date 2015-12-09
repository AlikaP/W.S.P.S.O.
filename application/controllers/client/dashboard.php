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
		$id_klijenta = $this->session->userdata('id');

		$id_vlasnika = array('id_vlasnika'=>$id_klijenta); 

		$this->data['klijent_result']= $this->service_m->get_by($id_vlasnika, FALSE);

								
		$this->data['subview'] = 'client/dashboard/index';  
		

		$this->data['subview_2'] = 'client/menu/index';
		
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