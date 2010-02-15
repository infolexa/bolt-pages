<?php defined('SYSPATH') or die('404 Not Found.');?>

<h3>Parameters</h3>

<?php foreach ($params as $key => $param): 
		$default = (isset($defaults[$key])) ? $defaults[$key] : '';
		$label = ucwords(Inflector::humanize($key));
?>
	<p>
		<label><?php echo $label ?></label><br />
		<?php echo Form::input('params['.$key.']', $default) ?>
	</p>
<?php endforeach ?>
