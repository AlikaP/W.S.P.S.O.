<?php

class Migration_create_users extends CI_Migration
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

				'email'=>array(
					'type'=>'VARCHAR',
					'constraint'=>'100'),

				'password'=>array(
					'type'=>'TEXT',
					'constraint'=>'128'),

				'name'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				'user_type'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				//........................

				

				)


			);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users');

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
		$this->dbforge->drop_table('users');
	}
}