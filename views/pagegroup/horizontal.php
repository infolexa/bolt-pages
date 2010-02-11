<?php defined('SYSPATH') or die('404 Not Found.');?>

<?php if (count($pages)): ?>
    
<div class="horiz-menu">
<?php foreach ($pages as $page): 
		$route = ($page['route'] == 'frontpage') ? '' : $page['route'];
?>
    <?php echo html::aroute($route, $page['params'], $page['title'], $page['attributes']); ?> &nbsp; | &nbsp;
<?php endforeach ?>
</div>


<?php endif ?>