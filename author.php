<?php get_header(); ?>
<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<div class="row">

    <div class="clearfix" style="margin-top:30px;">
        <div class="entry-meta alignleft">
            <?php the_author_image(); ?>
        </div>
        <h1 class="callout red">
            Posts by <?php echo $curauth->display_name; ?>
        </h1>
    </div>
    

	<div class="entry-content three-fourths">

		<?php query_posts('post_type=front-door&posts_per_page=10');
		
		$prev = get_previous_posts_link('Newer &uarr;',0); 
		$next = get_next_posts_link('Older &darr;',0); 
		
		echo '<strong>'.$prev.'</strong>'; 
		
		while (have_posts()) : the_post(); ?>
        
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>&nbsp;&mdash;&nbsp;<small class="entry-date"><?php echo get_the_date(); ?></small></h2>
        <div class="entry-summary indented"><?php the_excerpt(); ?></div>
        
        <?php endwhile; 
			  echo '<strong>'.$next.'</strong>'; ?>
        
        <?php wp_reset_query(); ?>
        
    </div>
    
    <div class="fourth leftnav">
        <ul>
            <li><strong><a href="<?php echo home_url(); ?>/news">Recent News</a></strong></li>
        <?php 
		query_posts('posts_per_page=5');
		while ( have_posts() ) : the_post(); ?>
            <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                
            <?php endwhile; ?>
        <?php wp_reset_query(); ?>
        </ul>
    </div>

</div><!-- .row -->

<?php get_footer(); ?>