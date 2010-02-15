<?php defined('SYSPATH') or die('404 Not Found.');

class Controller_Pages_Config extends Admin_Controller {
	public function action_meta()
	{
		$this->request->response = View::factory('pages/config/meta')->render();
	}
}