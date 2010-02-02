<?php defined('SYSPATH') or die('404 Not Found.');?>

<?php if (count($pages)): ?>
    
<div class="horiz-menu">
<?php foreach ($pages as $page): ?>
    <?php echo html::aroute($page['route'], $page['params'], $page['title'], $page['attributes']); ?> &nbsp; | &nbsp;
<?php endforeach ?>
</div>


<?php endif ?>