<?php defined('SYSPATH') or die('404 Not Found.');?>

<h3>Defaults</h3>

<?php foreach ($defaults as $key => $param): 
		$default = (isset($params[$key])) ? $params[$key] : '';
		$label = ucwords(Inflector::humanize($key));
?>
	<p>
		<label><?php echo $label ?></label><br />
		<?php echo Form::input('defaults['.$key.']', $default) ?>
	</p>
<?php endforeach ?>