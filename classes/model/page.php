<?php defined('SYSPATH') or die('404 Not Found.');

class Model_Page extends Sprig_MPTT {
		
	protected function _init()
	{
		$this->_fields += array(
			'id' => new Sprig_Field_Auto,
			'route' => new Sprig_Field_Char(array(
				'max_length' => 100,
				'unique' => FALSE,
				'label'	=> 'Route',
				'empty' => TRUE
			)),
			'title' => new Sprig_Field_Char(array(
				'max_length' => 100,
				'unique' => FALSE,
				'label'	=> 'Title',
				'empty' => FALSE
			)),
			'alias' => new Sprig_Field_Char(array(
				'max_length' => 100,
				'unique' => FALSE,
				'label'	=> 'Alias',
				'empty' => TRUE
			)),
			'description' => new Sprig_Field_Text(array(
				'label'	=> 'Description',
				'empty' => TRUE
			))
		);
	}
	
	public function group($group='root')
	{
		$group = DB::select('*')->from('pages')->where('pagegroup', '=', $group)->as_object()->execute();
		return $group->pagegroup;
	}
}
