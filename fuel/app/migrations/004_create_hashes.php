<?php

namespace Fuel\Migrations;

class Create_hashes
{
	public function up()
	{
		\DBUtil::create_table('hashes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'hash' => array('constraint' => 255, 'type' => 'varchar'),
			'hash_type' => array('constraint' => 2, 'type' => 'int'),
			'expired_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('hashes');
	}
}