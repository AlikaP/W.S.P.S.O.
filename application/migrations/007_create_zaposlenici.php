<?php

class Migration_create_zaposlenici extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(

			array(

				'id'=>array(
					'type'=>'INT',
					'constraint'=>11,
					'unsigned'=>TRUE,
					'auto_increment'=>TRUE),

				'name'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				'pocetak_rada'=>array(
					'type'=>'DATE'),

				'kraj_rada'=>array(
					'type'=>'DATE'),	

				//........................

				

				)


			);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('zaposlenici');

/*
		$fields = array(
                        'nadleznost'=>array(      //sprema id-ove servisa na kojima radi- za mehaničare
										'type'=>'TEXT',
										'constraint'=>'100'),

						'status'=>array(          //je li mehaničar zauzet sa servisom
										'type'=>'TEXT',
										'constraint'=>'100'),
						);

		$this->dbforge->add_column('users', $fields);
*/
	}

	public function down()
	{
		$this->dbforge->drop_table('zaposlenici');
	}
}