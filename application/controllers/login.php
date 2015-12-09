<?php

class Login extends Login_Controller
{
	protected $status1 = FALSE;
	protected $status2 = FALSE;
	protected $status3 = FALSE;

	public function __construct()
	{
		parent::__construct();
	}


	//---------------------------------------------------------------------------------------------




	//------------------------------------------------------------------------

	public function log_in()
	{
		$dashboard1 = 'admin/dashboard'; //kontroler
		$dashboard2 = 'mech/dashboard';
		$dashboard3 = 'client/dashboard';

		if($this->login_m->loggedin() == TRUE && $this->session->userdata('user_type')=="admin"){ redirect($dashboard1); }
		if($this->login_m->loggedin() == TRUE && $this->session->userdata('user_type')=="mech"){ redirect($dashboard2); }
		if($this->login_m->loggedin() == TRUE && $this->session->userdata('user_type')=="client"){ redirect($dashboard3); }

		$rules = $this->login_m->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE) //&& $this->session->userdata('status')!='Bivši zaposlenik';
		{
			if($this->login_m->login()==TRUE) //ako je login (iz user_m modela) ispravan...
			{
				if($this->login_m->check_type() == $dashboard1)
				{redirect($dashboard1);}   
				elseif($this->login_m->check_type() == $dashboard2)
				{redirect($dashboard2); }
				elseif($this->login_m->check_type() == $dashboard3)
				{redirect($dashboard3); }
				else{redirect('welcome');}
			}
			else
			{
				$this->session->set_flashdata('error', 'Wrong email/password');
				redirect('login/log_in', 'refresh');

				//stavi li se redirect('index');  error
				//stavi li se redirect('login/log_in', 'refresh');  nema errora
				//logiran u oba slučaja
			}
		}
		

		$this->data['subview'] = 'login/login'; //view file login.php (forma)
		$this->load->view('login/_layout_modal', $this->data);  //šalje se login forma u _layout_modal i podiže
		
	}


	//------------------------------------------------------------------------

	public function log_out()
	{
		$this->login_m->logout(); //poziva se logout() metoda iz user_m
		//$this->status1 = FALSE;
		//$this->status1 = FALSE;
		//$this->status1 = FALSE;
		redirect('login/log_in'); //klikom na 'logout' preusmjerava se na stranicu za logiranje
	}

	//------------------------------------------------------------------------

	
}