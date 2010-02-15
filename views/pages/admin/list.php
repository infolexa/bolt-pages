<?php defined('SYSPATH') or die('404 Not Found.');?>
<div id="pageslist">
	
	<table class="list">
		<tr>
			<th width="5"><input type="checkbox" name="check_all" value="0" /></th>
			<th>Title</th>
			<th>URL</th>
		</tr>
		<?php 
		$row = 'odd';
		foreach ($pages as $page): 
			$row = ($row == 'odd') ? 'even' : 'odd';
		?>
		<tr class="<?php echo $row ?>">
			<td><input type="checkbox" name="pages[]" value="<?php echo $page->id ?>" /></td>
			<td><?php echo str_repeat('&nbsp&nbsp&nbsp;&nbsp&nbsp;', ( $page->lvl - 2)). HTML::aroute('pages', array('group' => $group, 'action' => 'edit', 'id' => $page->id), $page->title) ?></td>
			<td><?php echo $page->lvl ?></td>
		</tr>
		<?php endforeach ?>
		
	</table>
	<div>
		<?php echo $pagemenu ?>	
	</div>
</div>