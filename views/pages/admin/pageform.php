<?php defined('SYSPATH') or die('404 Not Found.');?>

<p>
<label>URL</label> <br />
<?php echo $url ?>
</p>
<p>
<label>Title</label> <br />
<?php echo $page->input('title') ?>
</p>
<p>
<label>Description</label> <br />
<?php echo $page->input('description') ?>
</p>

<p>
	<label>Parent</label>
	
	<?php
	$options = array($parent->id => '--'.$parent->title.'--');
	foreach ($groups as $group)
	{
		if ($group->lft < $page->lft OR $group->rgt > $page->rgt) 
		{
			$options[$group->id] = str_repeat('-', ( $group->lvl - 2)) . $group->title;
		}
	}
	
	echo Form::select('parent', $options, $page->parent->id);
	?>
</p>

<?php 
