<?php

class Model_Profile extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'firstname',
		'lastname',
		'avatar',
		'address',
		'birthday',
		'user_id',
		'department_id',
		'position_id',
		'phone',
		'gender',
		'flag',
		'active',
		'deleted_at',
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

	protected static $_soft_delete = array(
		'mysql_timestamp' => false,
	);

	protected static $_table_name = 'profiles';

	protected static $_primary_key = array('user_id');

	protected static $_has_one = array(
	    'department' => array(
	        'key_from' => 'department_id',
	        'model_to' => 'Model_Department',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    ),
	    'position' => array(
	        'key_from' => 'position_id',
	        'model_to' => 'Model_Position',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    ),
	);


}
