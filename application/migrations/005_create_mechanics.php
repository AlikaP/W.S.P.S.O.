<?php

class Migration_create_mechanics extends CI_Migration
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

				
				'name_mehanicar'=>array(
					'type'=>'TEXT',
					'constraint'=>'128'),

				'servis_mehanicar'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				
				//........................
				

				)

			);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('mechanics');

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
		$this->dbforge->drop_table('mechanics');
	}
}