<?php 
get_header(); 
the_post(); ?>
      
<h2 class="callout clear red">404 - Page Not Found</h2>      
      
<article <?php post_class(); ?>>      
    
    <div class="entry-content indented">
    	<?php the_content(); ?>
    </div>      
</article>

<?php get_footer(); ?>