<?php get_header(); 
if (have_posts()) : while (have_posts()) : the_post(); ?>

<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="entry-summary indented"><?php the_excerpt(); ?></div>

<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>