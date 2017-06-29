<?php

class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group_id',
		'email',
		'last_login',
		'previous_login',
		'login_hash',
		'user_id',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'users';

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('username', 'Username', 'required|valid_string[alpha,lowercase,numeric]|max_length[50]');
		// $val->add_field('address', 'Address', 'required');
		// $val->add_field('phone', 'Phone', 'required|max_length[255]');
		// $val->add_field('description', 'Description', 'required');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');

		return $val;
	}
}
