<?php defined('SYSPATH') or die('404 Not Found.');

class Controller_Pages_Pagegroup extends Controller {

	public function action_index()
	{
		$pagegroup = Kohana::config('pages')->get($this->request->param('group'));
		$pages = array();

		foreach ($pagegroup as $page) 
		{
			if (User::belongsto($page['usergroups'])) 
			{
				$pages[] = $page;
			}
		}
		
		if (count($pages)) 
		{
			$this->request->response = View::factory('pagegroup/'.$this->request->param('layout', 'vertical'))
				->set('pages', $pages);
		}else
		{
			$this->request->response = '';
		}
		
	}

} // End Menus_Menu