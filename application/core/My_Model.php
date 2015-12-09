<?php

class My_Model extends CI_Model
{

	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules = array();       //validation rules
	protected $_timestamps = TRUE;


	function __construct()
	{
		parent::__construct();
	}

	//------------------------------------------------------------------------
	//------------------------------------------------------------------------

	public function get($id=NULL, $single=FALSE)
	{
		if($id!=NULL) 
		{
			$filter = $this->_primary_filter;
			$id = $filter($id); //intval($id)   //pridruživanje vrijednostima id niza int vrijednost (filtriranje) 

			$this->db->where($this->_primary_key, $id);

			$method = 'row'; 
		}
		elseif($single==TRUE)
		{
			$method='row';
		}
		else //$id=NULL, $single=FALSE    
		{ 
			$method='result'; //pošalji sve - $single=FALSE, šalje se niz objekata 
		}

		if(!count($this->db->ar_orderby))       //If an order is not already set by db library when this method was called, use this.
		{$this->db->order_by($this->_order_by, 'desc');}      //descending


		return $this->db->get($this->_table_name)->$method();	//row() ili result()
	}

	//------------------------------------------------------------------------

	public function get_by($where, $single = FALSE)  //$where- neki parametri po kojima tražimo po tablici
	{												
		$this->db->where($where);

		/* $where = array(

					'email'=>$this->input->post('email'),   // sa post() se dohvaća korisnik iz login forme
					'password'=>$this->hash($this->input->post('password'))

					)
		
		traži se korisnik prema mailu i lozinki:

			WHERE email='serfa@efwe.com' 
				  password='kek'

		 $where -poslan je niz sa članovima 'email' i 'password' te njihovim vrijednostima
		    	-kao da imamo where('email', 'serfa@efwe.com')...
		*/

		return $this->get(NULL, $single);
	}
	//------------------------------------------------------------------------

	public function save($data, $id=NULL) //$data = array('atribut'=>'vrijednost')
	{
			//datetime
			$now = date('Y-m-d H:i:s');
			if($id==NULL)
			{$data['created'] = $now;}
	
			$data['modified'] = $now;


		if($id===NULL) //novi redak
		{
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key]=NULL;  //postavljanje primarnog ključa na NULL (ukoliko nije postavljen)

			$this->db->set($data); //podaci koje smo unijeli (novi redak)
			$this->db->insert($this->_table_name); //ubacuju se u tablicu _table_name

			$id = $this->db->insert_id(); //dohvaća se id tog novog retka
		}
		else //update nekog redka
		{
			$filter = $this->_primary_filter;
			$id = $filter($id);

			$this->db->set($data);                      //podaci koje smo unijeli
			$this->db->where($this->_primary_key, $id);  //za neki određeni redak (prema id-u)
			$this->db->update($this->_table_name);     //ažuriraju se u tablici _table_name
		}

		return $id;
	}

	//------------------------------------------------------------------------

	public function delete($id)
	{
		
			$filter = $this->_primary_filter;
			$id = $filter($id);

			if(!$id)   //ako nema tog id-a
			{
				return FALSE;
			}

			$this->db->where($this->_primary_key, $id); //tamo gdje je pripadajuci id
			$this->db->limit(1);						//(samo jedan!)
			$this->db->delete($this->_table_name);		//briše se red (u tablici _table_name)
		
	}

	//------------------------------------------------------------------------

	public function array_from_post($fields)    // za edit korisnika u user.php (i stranica u page.php)
	{											// premosi se array podataka iz forme - $fields

		$podaci = array(); //prazan niz za popuniti

		foreach ($fields as $field) 
		{
			$podaci[$field] = $this->input->post($field);  //puni se niz $podaci sa dahvaćenim (post) vrijednostima iz forme
		}

		return $podaci;
	}
}