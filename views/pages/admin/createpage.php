<?php defined('SYSPATH') or die('404 Not Found.');?>

<p>
<label>Route</label> <br />
<?php echo $page->input('route') ?>
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
	foreach ($groups as $group):
		$options[$group->id] = str_repeat('-', ( $group->lvl - 2)) . $group->title;
	endforeach;
	
	echo Form::select('parent', $options);
	?>
</p>