<?php

class login_m extends My_Model
{

	protected $_table_name = 'users';
	protected $_order_by = 'name';

	public $rules = array(   //pravila za logiranje


    	'name' => array('field' => 'name',
     				 'label' => 'Name',
     				 'rules' => 'trim|required|xss_clean'),

     	'password' => array('field' => 'password',
     				 'label' => 'Password',
     				 'rules' => 'trim|required')
		);

	public $dash = '';

	function __construct()
	{
		parent::__construct();
	}
	//------------------------------------------------------------------------
	//------------------------------------------------------------------------

	public function login()
	{
		//odgovaraju li uneseni podaci (postoji li korisnik u tablici)?

		$user = $this->get_by(  //dohvat podataka iz login forme i spremanje u $user single object
									//provjera podataka (dohvaćanje korisnika iz tablice)
				array(
					'name'=>$this->input->post('name'),
					'password'=>$this->hash($this->input->post('password')) ), TRUE //TRUE = single user object, not array of objects
															    //$single			        		
			);

		if(count($user)!=NULL) //TRUE
		{
			$data = array(			// array of objects
				'name'=>$user->name,
				'email'=>$user->email,
				'id'=>$user->id,
				'user_type'=>$user->user_type,
				'status'=>$user->status,

				'loggedin'=>TRUE
				);


			//if($data->user_type == 'admin'){$dashboard = 'admin/dashboard';}
			//return $dashboard;
			if($data['status']=='Bivši zaposlenik')
			{
				return FALSE;
			}
			else
			{
				$this->session->set_userdata($data); 
			}

		}
		//else{return FALSE;}
	}

	//------------------------------------------------------------------------

	public function check_type()
	{
		$type = $this->session->userdata('user_type');

		if($type == "admin"){$this->dash = 'admin/dashboard';}
		elseif($type == "mech"){$this->dash = 'mech/dashboard';}
		elseif($type == "client"){$this->dash = 'client/dashboard';}
			
		return $this->dash;

	}
	

	//------------------------------------------------------------------------

	public function logout()
	{
		$this->session->sess_destroy(); //završava se sesija
	}

	//------------------------------------------------------------------------

	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin'); //vraća status: sesija u tijeku
	}

	//------------------------------------------------------------------------

	public function hash($string)
	{
		return hash('md5', $string . config_item('encryption_key')); 
	}

	
}