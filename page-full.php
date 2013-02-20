<?php 
/*
Template Name: Full width (no siblings)
*/
get_header(); 
the_post(); ?>
      
<h2 class="callout clear"><?php the_field('callout'); ?></h2>      
      
<article <?php post_class(); ?>>      
    <h1 class="entry-title green"><?php the_title(); ?></h1>
    
    <div class="entry-content indented">
    	<?php the_content(); ?>
    </div>      
</article>

<?php get_footer(); ?>