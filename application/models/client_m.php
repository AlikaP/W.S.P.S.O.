<?php

class client_m extends My_Model
{

	protected $_table_name = 'clients';
	protected $_order_by = 'id';

	

	// public $rules = array();

	function __construct()
	{
		parent::__construct();
	}
	//------------------------------------------------------------------------
	//------------------------------------------------------------------------

	public function get_new()
	{
		$client = new StdClass();
		$client->name_client='';
		$client->id_client='';
		$client->servis_client='';
		$client->oruzije_client='';
		

		return $client;
	}

	//------------------------------------------------------------------------

	public function drop()
	{
		
	}

}