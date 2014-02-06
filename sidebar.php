<div id="sidebar">
<?php
if (get_field('sidebar')) {

	while (has_sub_field('sidebar')) {
		$type = get_sub_field('type');

		switch ($type) {

			case 'pdf':
				$target = get_sub_field('file');
				break;

			case 'in-link':
				$target = get_sub_field('in-link');
				if ( get_sub_field('past_meetings') ) {
					$target .= '?pastmeetings=true';
				}
				break;

			case 'ex-link':
				$target = get_sub_field('ex-link');
				break;

		} ?>
		<p><a href="<?php echo $target; ?>" <?php if ($type == 'ex-link') { echo 'target="_blank"'; } ?>><?php the_sub_field('label'); ?></a></p>
	<?php
	}
}
?>
</div>