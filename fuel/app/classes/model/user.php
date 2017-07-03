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

	protected static $_has_one = array(
	    'profile' => array(
	        'key_from' => 'id',
	        'model_to' => 'Model_Profile',
	        'key_to' => 'user_id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    ),
	    // 'deparment' => array(
	    //     'key_from' => 'id',
	    //     'model_to' => 'Model_Department',
	    //     'key_to' => 'deparment_id',
	    //     'cascade_save' => true,
	    //     'cascade_delete' => false,
	    // ),
	    // 'position' => array(
	    //     'key_from' => 'id',
	    //     'model_to' => 'Model_Position',
	    //     'key_to' => 'position_id',
	    //     'cascade_save' => true,
	    //     'cascade_delete' => false,
	    // ),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		// $val->add_field('username', 'Username', 'required|valid_string[alpha,lowercase,numeric]|max_length[50]');
		// $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		// $val->add_field('password', 'Password', 'required|min_length[6]|max_length[12]');
		$val->add_field('firstname', 'First Name', 'max_length[255]');
		$val->add_field('lastname', 'Last Name', 'max_length[255]');
		$val->add_field('birthday ', 'Birthday', 'max_length[255]');
		$val->add_field('address', 'Address', 'max_length[255]');
		$val->add_field('department ', 'Department', 'max_length[255]');
		$val->add_field('position ', 'Position', 'max_length[255]');
		$val->add_field('phone', 'Phone', 'max_length[20]');
		$val->add_field('gender', 'Gender', 'match_collection[M,F]');

		return $val;
	}
}
