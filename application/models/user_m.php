<?php

class user_m extends My_Model
{

	protected $_table_name = 'users';
	protected $_order_by = 'created';

	

	public $rules= array(   //pravila za unos korisnika
		'ime' => array(
			'field' => 'ime', 
			'label' => 'Ime', 
			'rules' => 'trim|required|xss_clean'
		), 
		'prezime' => array(
			'field' => 'prezime', 
			'label' => 'Prezime', 
			'rules' => 'trim|required|xss_clean'
		), 
	 
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|xss_clean'  //callback u login.php //valid_email|callback__unique_email
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Lozinka', 
			'rules' => 'trim|callback__unique_pass' 
		),
		'user_type' => array(
			'field' => 'user_type', 
			'label' => 'User type', 
			'rules' => 'trim|xss_clean'
		), 
		'status' => array(
			'field' => 'status', 
			'label' => 'Status', 
			'rules' => 'trim|xss_clean'
		),
		//....................................
		'adresa' => array(
			'field' => 'adresa', 
			'label' => 'Adresa', 
			'rules' => 'trim|xss_clean'
		),
		'datum_rodjenja' => array(
			'field' => 'datum_rodjenja', 
			'label' => 'Datum rođenja', 
			'rules' => 'trim|xss_clean'
		),
		'JMBG' => array(
			'field' => 'JMBG', 
			'label' => 'JMBG', 
			'rules' => 'trim|xss_clean'
		),
		'oruzani_broj' => array(
			'field' => 'oruzani_broj', 
			'label' => 'Oružani broj', 
			'rules' => 'trim|xss_clean'
		),
		'kontakt_broj' => array(
			'field' => 'kontakt_broj', 
			'label' => 'Kontakt broj', 
			'rules' => 'trim|xss_clean'
		),

				
	);

	public $rules_2= array(
		'vrijednost_filtra' => array(
			'field' => 'vrijednost_filtra', 
			'label' => 'Vrijednost filtra', 
			'rules' => 'trim|xss_clean'
			),
		);

	public $rules_3= array(
		'vrijednost_search' => array(
			'field' => 'vrijednost_search', 
			'label' => 'Vrijednost searcha', 
			'rules' => 'trim|xss_clean'
			)
		);

	function __construct()
	{
		parent::__construct();
	}
	//------------------------------------------------------------------------
	//------------------------------------------------------------------------

	public function get_new()
	{
		$user = new StdClass();
		$user->ime='';            //za preliminarni ''ispis'' 
		$user->prezime='';
		$user->name='';
		$user->password='';
		$user->email='';
		$user->user_type='';

		$user->nadleznost='';

		$user->adresa='';
		$user->datum_rodjenja=date('Y-m-d');
		$user->JMBG='';
		$user->oruzani_broj='';
		$user->kontakt_broj='';

		return $user;
	}

	//------------------------------------------------------------------------

	public function filtriranje_1()
	{
					$vrijednost = $this->array_from_post(array('vrijednost_filtra'));

					if($vrijednost['vrijednost_filtra']=='Administrator' || $vrijednost['vrijednost_filtra']=='Mehaničar' || $vrijednost['vrijednost_filtra']=='Klijent')
					{
						if($vrijednost['vrijednost_filtra']=='Administrator'){$tip='admin';}
						elseif($vrijednost['vrijednost_filtra']=='Mehaničar'){$tip='mech';}
						elseif($vrijednost['vrijednost_filtra']=='Klijent'){$tip='client';}

						$tip_korisnika = array('user_type'=>$tip);
						$tip_korisnika_result = $this->get_by($tip_korisnika, FALSE);
					}
					else
					{
						if($vrijednost['vrijednost_filtra']=='Zaposlenici'){$s='Zaposlenik';}
						elseif($vrijednost['vrijednost_filtra']=='Bivši zaposlenici'){$s='Bivši zaposlenik';}

						$tip_korisnika = array('status'=>$s);
						$tip_korisnika_result = $this->get_by($tip_korisnika, FALSE);
					}
					//$this->data['users_filtr'] = $tip_korisnika_result;
					//$podaci = $this->data['users_filtr'];

					//redirect('admin/user/filtriranje/' . $this->data['users_filtr']); //ne može proslijediti niz (član niza data, koji sadrži niz objekata tj. redova)
																						//TREBA SPREMATI U SESSION
																						//flashdata - storage in cookies/session/database

					return $tip_korisnika_result;
	}

	//------------------------------------------------------------------------

	public function pretrazivanje_1()
	{
					$search_rastavljeni = array();

					$vrijednost = $this->array_from_post(array('vrijednost_search'));
					$search_array = $vrijednost['vrijednost_search'];

					$str_trazimo = strstr($search_array, " ");

					if($str_trazimo != NULL)  //ime&prezime
					{
						$search_rastavljeni = explode(" ", $search_array); //rastavljanje imena i prezimena

						$ime = $search_rastavljeni['0'];
						$prezime = $search_rastavljeni['1'];
						
						$ime_prezime_korisnika = array('ime'=>$ime, 'prezime'=>$prezime);
						$i_p_korisnika_result = $this->get_by($ime_prezime_korisnika, FALSE);

						return $i_p_korisnika_result;
					}
					else //ime||prezime||korisničko ime||datum
					{
						$ime_korisnika = array('ime'=>$search_array);
						$ime_korisnika_result = $this->get_by($ime_korisnika, FALSE);

						$prezime_korisnika = array('prezime'=>$search_array);
						$prezime_korisnika_result = $this->get_by($prezime_korisnika, FALSE);

						$name_korisnika = array('name'=>$search_array);
						$name_korisnika_result = $this->get_by($name_korisnika, FALSE);

							
							$result = $this->get();

							$result_date = array();

							foreach($result as $key=>$row):
								$time = $row->created;
								//$date = date_format($time, 'Y-m-d H:i:s'); //datetime u string
								$search_rastavljeni = explode(" ", $time); 		//samo Y-m-d

								if(dateform_($search_array)==$search_rastavljeni[0])	
									{$result_date[$key] = $row;}
							endforeach;


						if(count($ime_korisnika_result))
						{
							return $ime_korisnika_result;
						}
						elseif(count($prezime_korisnika_result))
						{
							return $prezime_korisnika_result;
						}
						elseif(count($name_korisnika_result))
						{
							return $name_korisnika_result;
						}
						elseif(count($result_date))
						{
							return $result_date;
						}
					}
					/*
					elseif($vrijednost['opcija_search'] == 'Ime')
					{	
						$ime_korisnika = array('ime'=>$search_array);
						$ime_korisnika_result = $this->user_m->get_by($ime_korisnika, FALSE);

						$this->data['users_search'] = $ime_korisnika_result;
					}
					elseif($vrijednost['opcija_search'] == 'Prezime')
					{
						$prezime_korisnika = array('prezime'=>$search_array);
						$prezime_korisnika_result = $this->user_m->get_by($prezime_korisnika, FALSE);

						$this->data['users_search'] = $prezime_korisnika_result;
					}
					elseif($vrijednost['opcija_search'] == 'Korisničko ime')
					{
						$name_korisnika = array('name'=>$search_array);
						$name_korisnika_result = $this->user_m->get_by($name_korisnika, FALSE);

						$this->data['users_search'] = $name_korisnika_result;
					}
					*/

						
	}


	
	
}