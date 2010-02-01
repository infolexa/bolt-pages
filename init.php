<?php defined('SYSPATH') or die('404 Not Found.');


Route::set('widget/pages', '(<group>(/<layout>))')
	->defaults(array(
		'directory'  => 'pages',
		'controller' => 'pagegroup',
		'action'     => 'index',
		'id'		 => 'topmenu',
		'layout'	 => 'vertical'
	));