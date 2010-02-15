<?php defined('SYSPATH') or die('404 Not Found.');?>

<h3>Meta Information</h3>
<p>
	<label>Page Title</label><br />
	<?php echo Form::input('meta[title]') ?>
</p>
<p>
	<label>Keywords</label><br />
	<?php echo Form::input('meta[keywords]') ?>
</p>

<p>
	<label>Description</label><br />
	<?php echo Form::input('meta[description]') ?>
</p>

<p>
	<label>Author</label><br />
	<?php echo Form::input('meta[author]') ?>
</p>

<p>
	<label>Robots</label><br />
	<?php echo Form::input('meta[robots]') ?>
</p>
