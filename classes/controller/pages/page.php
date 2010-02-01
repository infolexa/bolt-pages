<?php defined('SYSPATH') or die('404 Not Found.');

class Controller_Pages_Page extends Controller {

	public function action_index($id = '')
	{
		$this->request->response =  'this is a menu - '.$id;
	}

} // End Menus_Menu