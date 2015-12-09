<?php

class My_Controller extends CI_Controller
{
	
	public $data = array();  //podaci koje prenosimo na view


	function __construct()
	{
		parent::__construct();

		$this->data['errors']=array();
		$this->data['site_name']=config_item('site_name');

		$this->data['meta_title']='W.S.P.S.O.'; //W.S.P.S.O.
	}
}