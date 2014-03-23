<?php 
get_header(); 

if (is_user_logged_in()) {
    
the_post(); ?>
      
<h2 class="callout clear"><?php the_field('callout'); ?></h2>      
      
<article <?php post_class('three-fourths'); ?>>      
    <h1 class="entry-title red"><?php the_title(); ?></h1>
    
    <div class="entry-content indented">
    	<?php
    	while (have_rows('pdf')) : the_row();
    		the_sub_field('embed_code');
    	endwhile;
    	?>
    </div>      
</article>

<div class="fourth clearfix leftnav">
	<?php get_sidebar(); ?>
</div>

<?php } else { include( MAIN .'login.php'); } ?>

<?php get_footer(); ?>