<?php

class zaposlenik_m extends My_Model
{

	protected $_table_name = 'zaposlenici';
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
		$zaposlenik = new StdClass();
		$zaposlenik->name_client='';
		$zaposlenik->id_client='';
		$zaposlenik->servis_client='';
		$zaposlenik->oruzije_client='';
		

		return $zaposlenik;
	}

	//------------------------------------------------------------------------

	public function drop()
	{
		
	}

}