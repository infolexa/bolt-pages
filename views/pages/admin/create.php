<?php defined('SYSPATH') or die('404 Not Found.');?>

<form action="<?php echo URL::base().HTML::route('pages', array('group' => $group, 'action' => 'create')) ?>" method="post" accept-charset="utf-8">
	<div>
		<input type="submit" name="createbutton" value="Save and Go Back to List" />
		<input type="button" name="applybutton" value="Apply Changes" />
		<input type="button" name="cancelbutton" value="Cancel" />
	</div>

	<?php echo $fields?>
	<div>
		<input type="submit" name="createbutton" value="Save and Go Back to List" />
		<input type="button" name="applybutton" value="Apply Changes" />
		<input type="button" name="cancelbutton" value="Cancel" />
	</div>

</form>