<?php get_header(); 
	  the_post(); ?>
      
<h2 class="callout clear"><?php the_field('callout'); ?></h2>      
      
<article <?php post_class('three-fourths'); ?>>      
    <h1 class="entry-title red"><?php the_title(); ?></h1>
    
    <div class="entry-content indented">
    	<?php the_content(); ?>
    </div>      
</article>

<div class="fourth clearfix leftnav">
	<?php if ($post->post_parent) { 
			  $children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0'); 
			  $parent_link = get_permalink($post->post_parent); 
			  $parent = get_the_title($post->post_parent); 
		} else { 
			  $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0'); 
			  $parent_link = get_permalink($post->ID); 
			  $parent = get_the_title($post->ID); }
    	if ($children) { 
			
			if (is_page($parent)) { 
				echo '<ul><li class="current_page_item"><strong>'; 
			} else { 
				echo '<ul><li><strong>'; 
			} ?>
            	<a href="<?php echo $parent_link; ?>">
                	<?php echo $parent; ?>
                </a>
            	</strong></li>
          	<?php echo $children; ?>
      	</ul>
    <?php } ?>
</div>

<?php get_footer(); ?>