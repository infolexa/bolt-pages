<?php defined('SYSPATH') or die('404 Not Found.');?>

<?php if (count($pages)): ?>
    
<ul>
<?php foreach ($pages as $page): 
		$route = ($page['route'] == 'frontpage') ? '' : $page['route'];
?>
    <li><?php echo html::aroute($route, $page['params'], $page['title'], $page['attributes']); ?></li>
<?php endforeach ?>
</ul>


<?php endif ?>