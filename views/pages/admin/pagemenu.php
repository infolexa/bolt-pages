<?php defined('SYSPATH') or die('404 Not Found.');?>
<div id="pagemenu">
	<p style="text-align:right"><?php echo HTML::aroute('pages', array('group' => $group, 'action' => 'create'), 'New Page') ?></p>
	<?php if (count($modules)): ?>
	<div style="border:1px solid #cecece;width:200px;float:right;padding:10px">
			<h4>Apps</h4>
		<?php foreach ($modules as $module): ?>
			<h5><?php 
			$title = ($module->title) ? $module->title: $module->name;
			echo HTML::aroute('pages', array('group' => $group, 'action' => 'create', 'type' => 'app', 'id' => $module->name), $title);
			?></h5>
			
			<?php if (count($module->routes)): ?>
				<ul>
					<?php foreach ($module->routes as $key => $route): ?>
						<?php
						$name = ($route->meta('name')) ? $route->meta('name') : $key;
						$segments = explode('/', $key);
						echo '<li>' . HTML::aroute('pages', array('group' => $group, 'action' => 'create', 'type' => 'route', 'id' => $key), $name ) .'</li>';
						?>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
			
		<?php endforeach ?>
			<h5>External Links</h5>
			<ul>
				<li><?php echo HTML::aroute('pages', array('group' => $group, 'action' => 'create', 'type' => 'external', 'id' => 'redirect'), 'Redirect'); ?></li>
				<li><?php echo HTML::aroute('pages', array('group' => $group, 'action' => 'create', 'type' => 'external', 'id' => 'direct'), 'Direct Link');?></li>
			</ul>
	</div>
	
	<?php endif ?>
</div>