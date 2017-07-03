<?php
return array(
	'_root_'  => 'user/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	'login'  => 'user/login',
    'logout' => 'user/logout',
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
