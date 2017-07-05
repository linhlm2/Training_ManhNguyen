<?php
return array(
	'_root_'  => 'login/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	// 'login'  => 'user/login',
 //    'logout' => 'user/logout',
 //    'register' => 'user/register',
    'logout' => 'login/logout',
    'register' => 'login/register',
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
