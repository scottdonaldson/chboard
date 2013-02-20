<?php 
/*
Template Name: All Meetings
*/
get_header();  
the_post(); ?>
      
<?php
$meetings = new WP_Query(array(
    'posts_per_page' => -1
    )
);
$output = array();
while ($meetings->have_posts()) : $meetings->the_post();

    if (get_field('meeting')) {
        while (has_sub_field('meeting')) {
            if (get_sub_field('date') >= date('Ymd')) {
                array_push($output, 
                    array(
                        get_sub_field('date'), 
                        get_the_title(), 
                        get_permalink(),
                        get_sub_field('time'),
                        get_sub_field('location')
                    )
                );
            }
        }
    }

endwhile;
wp_reset_postdata();

?>

<article <?php post_class('row'); ?>>      

    <div class="third">
        <?php get_sidebar(); ?>
    </div>

    <div class="two-thirds">
        <h2 class="red">All Upcoming Meetings</h2>
        <?php 
        $today = date('Ymd');

        asort($output);
        foreach ($output as $meeting) {
            // Set vars
            $date = $meeting[0];
            $name = $meeting[1];
            $link = $meeting[2];
            $time = $meeting[3];
            $location = $meeting[4];

            $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

            if ($meeting[0] >= $today) {

                $month = substr($date, 4, 2);
                $day = substr($date, 6, 2);
                // If $day starts with a 0, chop it off
                substr($day, 0, 1) == 0 ? $day = substr($day, 1, 1) : $day = $day; ?>

                <a class="entry clearfix" href="<?php echo $link; ?>/#<?php echo $date; ?>">
                    <p class="alignleft"><?php echo $months[$month - 1]; ?>&nbsp;<?php echo $day; ?>, <?php echo $time; ?>&nbsp;<?php if ($location) { echo '('.$location.')'; } ?></p>
                    <p class="alignright"><strong><?php echo $name; ?></strong></p>
                </a>
                <?php
            }
        }
        ?>
        
    </div>   

</article>

<?php get_footer(); ?>