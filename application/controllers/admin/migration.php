<?php

class Migration extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('migration');

		if( ! $this->migration->current())  			//pokreće migraciju s oznakom 001 (u postavkama je $config['migration_version'] = 1;)
		{														//ili migraciju s oznakom 002 (u postavkama je $config['migration_version'] = 2;)
			show_error($this->migration->error_string());			 //za 'izbacivanje' tablice 002, postaviti $config ponovno na 1
		}
		else
		{
		 	echo 'MIGRATION WORKED!'; 
		} 
	}
}