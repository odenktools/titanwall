<?php

return [

	'cms_route' 	=> true,
	
	'cms_auth'		=> true,
	
	'identified_by' 	=> ['username', 'email'],

	'default_role' 		=> 'trial',
	
	'super_admin'		=> 'admin',
	
	// DB prefix for tables
	'prefix' => 'odk_',
	
	// Table Usage (prefix will be automatic generated on the fly)
	'tables' => [
		'user' 					=> 'users',
		'user_fields' 			=> 'user_fields',
		'role' 					=> 'role',
		'role_profile_fields' 	=> 'role_profilefields'
	]

];
