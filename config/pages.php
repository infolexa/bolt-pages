<?php defined('SYSPATH') or die('404 Not Found.');

return array(
	'mainmenu'	=> array(
		array(
			'title' 		=> 'Welcome',
			'route'			=> 'default',
			'params'		=> array('file' => 'welcome'),
			'attributes' 	=> array(
								'class' => 'home'
							),
			'usergroups'	=> 'all'
		),
		array(
			'title' 		=> 'Register',
			'route'			=> 'default',
			'params'		=> array('file' => 'register'),
			'attributes' 	=> array(),
			'usergroups'	=> '0'
		),
		array(
			'title' 		=> 'About Us',
			'route'			=> 'default',
			'params'		=> array('file' => 'about'),
			'attributes' 	=> array(
								'class' => 'login'
							),
			'usergroups'	=> '0'
		)
	)
);