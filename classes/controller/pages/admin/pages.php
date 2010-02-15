<?php defined('SYSPATH') or die('404 Not Found.');

class Controller_Pages_Admin_Pages extends Admin_Controller {

	public function pagemenu()
	{
		$group = $this->request->param('group');
		$modules = array();
		foreach (Apps::all() as $module) 
		{
			if ($module->type == 'app' AND $module->name != 'pages') 
			{
				$module->routes = array();
				//get the routes for this app
				foreach (Route::all() as $key => $route) 
				{
					if (preg_match('/^site\/'.$module->name.'/', $key)) 
					{
						$module->routes[$key] = $route;
					}	
				}
				$modules[] = $module; 
			}
		}
		return View::factory('pages/admin/pagemenu')
			->set('modules', $modules)
			->set('group', $group)
			->render();
	}
	
	public function create()
	{
		$page = Sprig::factory('page');
		$group = $this->request->param('group');
		
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
				$page->alias = preg_replace('/[^a-z0-9_\-]/', '-', strtolower($page->title));
				$page->insert_as_last_child($root);
				$this->request->redirect(Apps::aliasof('admin').'/pages/'.$page->alias);
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
				$page->insert_as_last_child($group);
				$this->request->redirect(Apps::aliasof('admin').'/pages/'.$group->alias);
				return;
			}else{
				echo Kohana::debug($group);
				die();
			}
		}
	}

	public function action_list()
	{
		
		$group = Sprig::factory('page', array('alias' => $this->request->param('group')))->load();
		if ($group->loaded()) 
		{
			$pages = $group->descendants;
		}else
		{
			$this->request->redirect(Apps::aliasof('admin'));
		}

		$ordering = $this->request->param('ordering');
		$sort_by = $this->request->param('sort_by');
		
		$this->request->response = View::factory('pages/admin/list')
			->set('sort_by', $sort_by)
			->set('ordering', $ordering)
			->set('group', $group->alias)
			->set('pagemenu', $this->pagemenu())
			->set('pages', $pages);
	}
	
	public function action_create()
	{
		$type = $this->request->param('type');
		$func = 'create_'.$type;
		$this->$func();
	}
	
	public function create_app()
	{
		$app = Apps::get($this->request->param('id'));
		if ( ! $app) 
		{
			$this->messages('error', 'App does not exist');
			$this->request->redirect(Apps::aliasof('admin').'/pages/'.$groupname);
		}
		
		$groupname = $this->request->param('group');
		$url = URL::base(TRUE, 'url').$app->alias;
		
		$route = '';
		//get the first route for the app
		foreach (Route::all() as $key => $route) 
		{
			if (preg_match('/^site\/'.$app->name.'/', $key)) 
			{
				$route = $route->meta('key', $key);
				break;
			}
		}
	}
	
	public function create_group()
	{
		# code...
	}
	
	public function action_creates()
	{
		$page = Sprig::factory('page');
		$group = $this->request->param('group');

		if ($_POST) 
		{
			$this->create();
		}
		
		$group = Sprig::factory('page', array('alias' => $group))->load();
		$type = $this->request->param('type');
		$config = '';
		switch ($type) 
		{
			case 'app':
				$app = Apps::get($this->request->param('id'));
				$url = URL::base(TRUE, 'http').$app->alias;
				foreach (Route::all() as $key => $route) 
				{
					if (preg_match('/^site\/'.$app->name.'/', $key)) 
					{
						$route = $key;
						break;
					}
				}
				$route = '';
			break;

			case 'route':
				$route = Route::get($this->request->param('id'));
				$segments = explode('/', $this->request->param('id'));
				$app = Apps::get($segments[1]);
				$url = URL::base(TRUE, 'http').$route->uri(array('app' => $app->alias));
				$config_token = Route::get('config')->meta('token');
				foreach ($route->meta('config')	as $config_route) 
				{
					$config .= Request::factory($config_token.'/'.$config_route)->execute()->response;
				}
			break;
			
			default:
				$app = Apps::get('pages');
				$route = Route::get('pages');
				$url = URL::base(TRUE, 'http');
			break;
		}
		
		if (strtolower($group) == 'root')
		{
			$fields = View::factory('pages/admin/groupform')->set('page', $page)->render();
		}else
		{
			$fields = View::factory('pages/admin/pageform')
				->set('page', $page)
				->set('parent', $group)
				->set('groups', $group->descendants)
				->set('route', $route)
				->set('app', $app)
				->set('config', $config)
				->set('url', $url)
				->render();
		}
		$this->request->response = View::factory('pages/admin/create')
			->set('group', $group->alias)
			->set('fields', $fields)
			->render();
		return;
	}
	
	public function action_edit()
	{
		$group = $this->request->param('group', 'root');
		$page = Sprig::factory('page', array('id' => $this->request->param('id')))->load();
		$group = Sprig::factory('page', array('alias' => $group))->load();
		
		if ($_POST) 
		{
			//now save the page
			$page->values($_POST);
			$page->update();
			
			//if the parent is changed
			if ($page->parent->id != $_POST['parent']) 
			{
				//get the proposed parent
				$parent = Sprig::factory('page', array('id' => $_POST['parent']))->load();
				//sprig mptt is already checking if the node is being moved to its child
				$page->move_to_last_child($parent);
			}
			
			$this->request->redirect(Apps::aliasof('admin').'/pages/'.$group->alias);
		}

		$this->request->response = View::factory('pages/admin/edit')
			->set('group', $group->alias)
			->set('parent', $group)
			->set('groups', $group->descendants)
			->set('page', $page)
			->render();
		return;
	}
	
	public function save()
	{
		# code...
	}
	
}