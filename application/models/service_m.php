<?php

class service_m extends My_Model
{

	protected $_table_name = 'services';
	protected $_order_by = 'created';

	

	//$rules također staviti u service.php kontroler mehaničara 
	//zbog callback funkcije za validaciju datuma...

	public $rules = array(   //pravila za unos korisnika
		
		
		'oruzije' => array(
			'field' => 'oruzije', 
			'label' => 'Oruzije', 
			'rules' => 'trim|required|xss_clean'
		),
		'serviser' => array(
			'field' => 'serviser', 
			'label' => 'Serviser', 
			'rules' => 'trim|required|xss_clean'
		),  

		/*
		'kraj_servisa' => array(
			'field' => 'kraj_servisa', 
			'label' => 'Kraj servisa', 
			'rules' => 'trim|required|callback_checkDateFormat'
		),

		'status' => array(
			'field' => 'status', 
			'label' => 'Status', 
			'rules' => 'trim|required|xss_clean'
		),

		'komentar' => array(
			'field' => 'komentar', 
			'label' => 'Komentar', 
			'rules' => 'trim|required|xss_clean'
		) 

		*/
		
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
		$service = new StdClass();
		$service->id_vlasnika='';
		$service->vlasnik='';
		$service->id_oruzija='';
		$service->oruzije='';
		$service->id_servisera='';
		$service->serviser='';
		$service->pocetak_servisa=date('Y-m-d'); //trenutno vrijeme
		$service->kraj_servisa=date('Y-m-d');

		return $service;
	}

	//------------------------------------------------------------------------
	
	public function filtriranje_1()
	{
					$vrijednost = $this->array_from_post(array('vrijednost_filtra'));
					$search_array = $vrijednost['vrijednost_filtra'];

					if($search_array == 'GOTOVO')
					{
						
						$gotovi = array('status'=>$search_array);
						$gotovi_result = $this->get_by($gotovi, FALSE);

						return $gotovi_result;
					}
					elseif($search_array == 'U TIJEKU')
					{
						
						$u_tijeku = array('status'=>$search_array);
						$u_tijeku_result = $this->get_by($u_tijeku, FALSE);

						return $u_tijeku_result;
					}
					elseif($search_array == 'U OBRADI')
					{
						
						$nema = array('status'=>'');  //ne može NULL
						$nema_result = $this->get_by($nema, FALSE);

						return $nema_result;
					}					

					
	}

	//------------------------------------------------------------------------

	public function pretrazivanje_1()
	{
					$vrijednost = $this->array_from_post(array('vrijednost_search'));
					$search_array = $vrijednost['vrijednost_search'];

					$ime_servisa_korisnika = array('id'=>$search_array);
					$i_servisa_result = $this->get_by($ime_servisa_korisnika, FALSE);

					$ime2_servisa_korisnika = array('naziv'=>$search_array);
					$ii_servisa_result = $this->get_by($ime2_servisa_korisnika, FALSE);

							$result = $this->get();

							$result_date = array();

							foreach($result as $key=>$row):
								$time = $row->created;
								//$date = date_format($time, 'Y-m-d H:i:s'); //datetime u string
								$search_rastavljeni = explode(" ", $time); 		//samo Y-m-d

								if(dateform_($search_array)==$search_rastavljeni[0])	
									{$result_date[$key] = $row;}
							endforeach;


					if(count($i_servisa_result))
					{
						return $i_servisa_result;
					}
					elseif(count($ii_servisa_result))
					{
						return $ii_servisa_result;
					}
					elseif(count($result_date))
					{
						return $result_date;
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

	//------------------------------------------------------------------------

	public function filtriranje_2($servisi)
	{
					$vrijednost = $this->array_from_post(array('vrijednost_filtra'));
					$search_array = $vrijednost['vrijednost_filtra'];

					$gotovi_result = array();
					$u_tijeku_result = array();
					$u_obradi_result = array();

					if($search_array == 'GOTOVO')
					{
						foreach($servisi as $key=>$servis):
							if($servis->status == $search_array)
							{
								$gotovi_result[$key] = $servis; 
							}
						endforeach;	

						return $gotovi_result;
					}
					elseif($search_array == 'U TIJEKU')
					{
						foreach($servisi as $key=>$servis):
							if($servis->status == $search_array)
							{
								$u_tijeku_result[$key] = $servis; 
							}
						endforeach;	

						return $u_tijeku_result;
					}
					elseif($search_array == 'U OBRADI')
					{
						foreach($servisi as $key=>$servis):
							if($servis->status == NULL)
							{
								$u_obradi_result[$key] = $servis; 
							}
						endforeach;	

						return $u_obradi_result;
					}					

					
	}

	//------------------------------------------------------------------------

	public function pretrazivanje_2($servisi)
	{
					$vrijednost = $this->array_from_post(array('vrijednost_search'));
					$search_array = $vrijednost['vrijednost_search'];

					$i_servisa_result = array();
					$ii_servisa_result = array();

					foreach ($servisi as $key => $servis) 
					{
						if($servis->naziv == $search_array)
						{
							$i_servisa_result[$key] = $servis;
						}
					}

					foreach ($servisi as $key => $servis) 
					{
						if($servis->id == $search_array)
						{
							$ii_servisa_result[$key] = $servis;
						}
					}

					if(count($i_servisa_result))
					{
						return $i_servisa_result;
					}

					if(count($ii_servisa_result))
					{
						return $ii_servisa_result;
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