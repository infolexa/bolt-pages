<?php defined('SYSPATH') or die('404 Not Found.');?>

<?php if (count($pages)): ?>
    
<ul>
<?php foreach ($pages as $page): ?>
    <li><?php echo html::aroute($page['route'], $page['params'], $page['title'], $page['attributes']); ?></li>
<?php endforeach ?>
</ul>


<?php endif ?>