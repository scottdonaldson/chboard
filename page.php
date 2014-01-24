<?php get_header(); 
	  the_post(); ?>
      
<h2 class="callout clear"><?php the_field('callout'); ?></h2>      
      
<article <?php post_class('three-fourths'); ?>>      
    <h1 class="entry-title red"><?php the_title(); ?></h1>
    
    <div class="entry-content indented">
    	<?php
    	while (have_rows('pdf')) : the_row();
    		the_sub_field('issuu_embed_code');
    	endwhile;
    	?>
    </div>      
</article>

<div class="fourth clearfix leftnav">
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

<?php get_footer(); ?>