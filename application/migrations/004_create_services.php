<?php

class Migration_create_services extends CI_Migration
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

				'vlasnik'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				'oruzije'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				'serviser'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				'pocetak_servisa'=>array(
					'type'=>'DATE',
					),
				//...........................
				
				'kraj_servisa'=>array(
					'type'=>'DATE',
					),

				'status'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),
				
				'komentar'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				)


			);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('services');
	}

	public function down()
	{
		$this->dbforge->drop_table('services');
	}
}