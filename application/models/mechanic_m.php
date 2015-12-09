<?php

class mechanic_m extends My_Model
{

	protected $_table_name = 'mechanics';
	protected $_order_by = 'id';

	

	public $rules = array(   //pravila za unos korisnika
		'name_mehanicar' => array(
			'field' => 'name_mehanicar', 
			'label' => 'Ime mehanicara', 
			'rules' => 'trim|required|xss_clean'
		), 
		'servis_mehanicar' => array(
			'field' => 'servis_mehanicar', 
			'label' => 'Servis mehanicara', 
			'rules' => 'trim|required|xss_clean'
		),		
	);

	function __construct()
	{
		parent::__construct();
	}
	//------------------------------------------------------------------------
	//------------------------------------------------------------------------

	public function get_new()
	{
		$mechanic = new StdClass();
		$mechanic->name_mehanicar='';
		$mechanic->servis_mehanicar='';
		$mechanic->oruzije_mehanicar='';

		return $mechanic;
	}

	//------------------------------------------------------------------------

	public function drop()
	{
		
	}

}