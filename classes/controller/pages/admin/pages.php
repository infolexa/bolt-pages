<?php defined('SYSPATH') or die('404 Not Found.');

class Controller_Pages_Admin_Pages extends Admin_Controller {

	public function action_list()
	{
		$group = strtolower($this->request->param('group'));
		if ($group == 'root') 
		{
			$this->request->response = 'Nothing Here...';
		}
		
		$group = Sprig::factory('page', array('alias' => $group))->load();
		if ($group->loaded()) 
		{
			$pages = $group->descendants;
		}

		
		$ordering = $this->request->param('ordering');
		$sort_by = $this->request->param('sort_by');
		
		$this->request->response = View::factory('pages/admin/list')
			->set('sort_by', $sort_by)
			->set('ordering', $ordering)
			->set('group', $group->alias)
			->set('pages', $pages);
	}
	
	public function action_create()
	{
		$page = Sprig::factory('page');
		$group = $this->request->param('group');
		
		if ($_POST) 
		{
			if (strtolower($group) == 'root')
			{
				$root = Sprig::factory('page')->load();
				if ( ! $root->loaded()) 
				{
					$root->title = 'Root';
					$root->insert_as_new_root(1);
				}
								
				$page->values($_POST);

				try
				{
					$page->pagegroup = 0;
					$page->alias = preg_replace('/[^a-z0-9_\-]/', '-', strtolower($page->title));
					$page->insert_as_last_child($root);
					$this->request->redirect(Apps::aliasof('admin').'/pages/'.$group);
					return;
				}
				catch( Validate_Exception $e)
				{
					echo Kohana::debug($e);
					die();
				}

			}

			if (isset($_POST['parent'])) 
			{
				$page->values($_POST);
				$parent = Sprig::factory('page', array('id' => $_POST['parent']))->load();
				$page->insert_as_last_child($parent);
				$this->request->redirect(Apps::aliasof('admin').'/pages/'.$group);
			}else
			{
				$group = Sprig::factory('page', array('alias' => $group))->load();
				if ($group->loaded()) 
				{
					$page->values($_POST);
					$page->pagegroup = $group->id;
					$page->insert_as_last_child($group);
					$this->request->redirect(Apps::aliasof('admin').'/pages/'.$group->alias);
					return;
				}else{
					echo Kohana::debug($group);
					die();
				}
			}

		}
		
		$group = Sprig::factory('page', array('alias' => $group))->load();

		$this->request->response = View::factory('pages/admin/create')
			->set('group', $group->alias)
			->set('parent', $group)
			->set('groups', $group->descendants)
			->set('page', $page)
			->render();
		return;
	}
	
}