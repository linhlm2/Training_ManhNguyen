<?php
return array(
	'_root_'  => 'login/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
    'logout' => 'login/logout',
    'register' => 'login/register',
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
