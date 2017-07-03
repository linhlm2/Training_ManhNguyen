<?php

namespace Fuel\Migrations;

class Create_profiles
{
	public function up()
	{
		\DBUtil::create_table('profiles', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'firstname' => array('constraint' => 50, 'type' => 'varchar', 'null' => true),
			'lastname' => array('constraint' => 50, 'type' => 'varchar', 'null' => true),
			'birthday' => array('type' => 'date', 'null' => true),
			'avatar' => array('type' => 'text', 'null' => true),
			'address' => array('type' => 'text', 'null' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'department_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'position_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'phone' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'gender' => array('constraint' => 1, 'type' => 'int', 'null' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('profiles');
	}
}