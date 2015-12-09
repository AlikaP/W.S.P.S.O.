<?php

class Migration_create_clients extends CI_Migration
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

				
				'name_client'=>array(
					'type'=>'TEXT',
					'constraint'=>'128'),

				'servis_client'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				'oruzije_client'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),
				
				//........................
				

				)

			);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('clients');

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
		$this->dbforge->drop_table('clients');
	}
}