<?php

class my_profile_m extends My_Model
{
	protected $_table_name = 'users';
	protected $_order_by = 'name';

	public $rules= array(   
		'password' => array(
			'field' => 'password', 
			'label' => 'Lozinka', 
			'rules' => 'trim|matches[password_confirm]|required'
		), 
		'password_confirm' => array(
			'field' => 'password_confirm', 
			'label' => 'Potvrda lozinke', 
			'rules' => 'trim|matches[password]'
		));
	
	function __construct()
	{
		parent::__construct();
	}
	//------------------------------------------------------------------------
	//------------------------------------------------------------------------

	public function profile()
	{
		$log = array( 'id'=>$this->session->userdata('id') );
		$user = $this->get_by($log, TRUE);

		return $user;
	}

}