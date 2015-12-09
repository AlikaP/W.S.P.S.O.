<?php

class Migration_create_weapons extends CI_Migration
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

				'vlasnik'=>array(
					'type'=>'TEXT',
					'constraint'=>'100'),

				)


			);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('weapons');
	}

	public function down()
	{
		$this->dbforge->drop_table('weapons');
	}
}