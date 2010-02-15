<?php defined('SYSPATH') or die('404 Not Found.');

Route::set('admin/pages', 'pages(/<group>(/<action>(:<type>)(/<id>)))', array('action' => 'list|create|edit|save', 'type' => 'app|route|group|external', 'id' => '.*$'))
	->defaults(array(
		'group'		 => 'root',
		'controller' => 'pages',
		'action'     => 'list',
		'id'		 => NULL
	));
	
Route::set('admin/pages/list', 'pages/<group>/sort(/<sort_by>(:<ordering>))', array('sort_by' => '[a-z0-9]*+', 'ordering' => 'ASC|DESC'))
	->defaults(array(
		'controller' => 'pages',
		'action'     => 'list',
		'sort_by'	 => 'title',
		'ordering'	 => 'ASC',
	));

Route::set('widget/pages', '(<group>(/<layout>))')
	->defaults(array(
		'directory'  => 'pages',
		'controller' => 'pagegroup',
		'action'     => 'index',
		'id'		 => 'topmenu',
		'layout'	 => 'vertical'
	));
