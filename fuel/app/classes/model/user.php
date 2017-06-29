<?php
class Model_User extends Orm\Model
{
	protected static $properties = array(
		'id',
		'username',
		'fullname',
		'email',
		'password',
		'address',
		'birthday',
		'sex',
		'active',
		'flag',
		'status',
	);
	
}