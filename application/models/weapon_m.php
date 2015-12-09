<?php

class weapon_m extends My_Model
{

	protected $_table_name = 'weapons';
	protected $_order_by = 'created';

	

	public $rules= array(   //pravila za unos korisnika
		'puni_naziv' => array(
			'field' => 'puni_naziv', 
			'label' => 'Puni naziv', 
			'rules' => 'trim|required|xss_clean'  
		), 
		'vlasnik' => array(
			'field' => 'vlasnik', 
			'label' => 'Vlasnik', 
			'rules' => 'trim|required|xss_clean'
		), 
		//....................................
		'vrsta' => array(
			'field' => 'vrsta', 
			'label' => 'Vrsta', 
			'rules' => 'trim|xss_clean'
		),
		'marka' => array(
			'field' => 'marka', 
			'label' => 'Marka', 
			'rules' => 'trim|xss_clean'
		), 
		'serijski_broj' => array(
			'field' => 'serijski_broj', 
			'label' => 'Serijski broj', 
			'rules' => 'trim|xss_clean'
		), 
		'kalibar' => array(
			'field' => 'kalibar', 
			'label' => 'Kalibar', 
			'rules' => 'trim|xss_clean'
		), 
		'dodaci' => array(
			'field' => 'dodaci', 
			'label' => 'Dodaci', 
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
		$weapon = new StdClass();
		$weapon->name='';
		$weapon->puni_naziv='';
		$weapon->id_vlasnika='';
		$weapon->vlasnik='';
		$weapon->pripadni_servis='';
		$weapon->vrsta='';
		$weapon->marka='';
		$weapon->serijski_broj='';
		$weapon->kalibar='';
		$weapon->dodaci='';

		return $weapon;
	}

	//------------------------------------------------------------------------
	
	

	//------------------------------------------------------------------------

	public function pretrazivanje_1()
	{

					$vrijednost = $this->array_from_post(array('vrijednost_search'));
					$search_array = $vrijednost['vrijednost_search'];

					$ime_oruzija_korisnika = array('name'=>$search_array);
					$i_oruzija_result = $this->get_by($ime_oruzija_korisnika, FALSE);

					$ime2_oruzija_korisnika = array('puni_naziv'=>$search_array);
					$ii_oruzija_result = $this->get_by($ime2_oruzija_korisnika, FALSE);

							$result = $this->get();

							$result_date = array();

							foreach($result as $key=>$row):
								$time = $row->created;
								//$date = date_format($time, 'Y-m-d H:i:s'); //datetime u string
								$search_rastavljeni = explode(" ", $time); 		//samo Y-m-d

								if(dateform_($search_array)==$search_rastavljeni[0])	
									{$result_date[$key] = $row;}
							endforeach;
					
					if(count($i_oruzija_result))
					{
						return $i_oruzija_result;
					}
					if(count($ii_oruzija_result))
					{
						return $ii_oruzija_result;
					}
					elseif(count($result_date))
					{
						return $result_date;
					}			
								
						
	}

	//------------------------------------------------------------------------

	public function pretrazivanje_2($oruzija)
	{
					$i_oruzija = array();
					$iii_oruzija = array();

					$vrijednost = $this->array_from_post(array('vrijednost_search'));
					$search_array = $vrijednost['vrijednost_search'];

						$ime_oruzija_korisnika = array('name'=>$search_array);
						$i_oruzija_result = $this->get_by($ime_oruzija_korisnika, FALSE);

						$ime2_oruzija_korisnika = array('puni_naziv'=>$search_array);
						$ii_oruzija_result = $this->get_by($ime2_oruzija_korisnika, FALSE);

					if(count($i_oruzija_result))
					{
						//foreach($i_oruzija_result as $oruzije_row):
							foreach($oruzija as $key=>$oruzije_row):
								if($oruzije_row->oruzije_mehanicar == $search_array)
								{
									$i_oruzija[$key] = $oruzije_row;
								} 

								
							endforeach;
						//endforeach;
						return $i_oruzija;
					}

					if(count($ii_oruzija_result))
					{
							foreach($oruzija as $key=>$oruzije_row):
								$naziv = array('name'=>$oruzije_row->oruzije_mehanicar);
								$weap = $this->get_by($naziv, TRUE); 	//dohvati iz tablice oružija puni naziv 
								$puni_naziv = $weap->puni_naziv;

								if($puni_naziv == $search_array)
								{
									$i_oruzija[$key] = $oruzije_row;
								} 

								
							endforeach;

						return $ii_oruzija_result;
					}

					if(count($oruzija))
					{
						//foreach($i_oruzija_result as $oruzije_row):
							foreach($oruzija as $key=>$oruzije_row):
								$time = $oruzije_row->created;
								//$date = date_format($time, 'Y-m-d H:i:s'); //datetime u string
								$search_rastavljeni = explode(" ", $time);

								if($search_rastavljeni['0'] == dateform_($search_array))
								{
									$iii_oruzija[$key] = $oruzije_row;
								} 

								
							endforeach;
						//endforeach;
						if(count($iii_oruzija))
						{
							return $iii_oruzija;
						}
					}			
						
	}
	
}

