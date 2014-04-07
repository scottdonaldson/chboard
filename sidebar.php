<div id="sidebar">

<?php 

function meta($key) {
	return get_post_meta(get_the_ID(), $key, true);
}
$i = 0;

while ( meta('sidebar_' . $i . '_type') ) {

	$type = meta('sidebar_' . $i . '_type');

	switch ($type) {

		case 'pdf':
			$target = meta('sidebar_' . $i . '_file');
			break;

		case 'in-link':
			$target = meta('sidebar_' . $i . '_in-link');
			$target = get_post($target)->guid;
			break;

		case 'ex-link':
			$target = meta('sidebar_' . $i . '_ex-link');
			break;

	} ?>
	<p><a href="<?= $target; ?>" <?php if ($type === 'ex-link') { echo 'target="_blank"'; } ?>><?= meta('sidebar_' . $i . '_label'); ?></a></p>

	<?php
	$i++;
}

?>

</div>