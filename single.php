<?php 
get_header();  
the_post(); ?>
      
<article <?php post_class('row'); ?>>      
    
    <div class="third">
        <?php get_sidebar(); ?>
    </div>

    <div class="two-thirds">
        <h2 class="red"><?php the_title(); ?> <small>- Upcoming Meetings</small></h2>
        <?php 
        $today = date('Ymd');

        $meetings = get_field('meeting');
        foreach ($meetings as $meeting) {
            // Set vars
            $date = $meeting['date'];
            $time = $meeting['time'];
            $location = $meeting['location'];
            $info = $meeting['info'];

            $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

            if ($date >= $today) {

                $month = substr($date, 4, 2);
                $day = substr($date, 6, 2);
                // If $day starts with a 0, chop it off
                substr($day, 0, 1) == 0 ? $day = substr($day, 1, 1) : $day = $day; ?>

                <div class="entry clearfix" id="<?php echo $date; ?>">
                    <p><?php echo $months[$month - 1]; ?>&nbsp;<?php echo $day; ?>, <?php echo $time; ?>&nbsp;<?php if ($location) { echo '('.$location.')'; } ?></p>
                    <?php if ($info) { echo '<p><em>'.$info.'</em></p>'; } ?>
                </div>
                <?php
            }
        }
        ?>

        <?php 
        /* if (get_field('meeting')) {
            while (has_sub_field('meeting')) { ?>
                <p id="<?php the_sub_field('date'); ?>"><?php the_sub_field('date'); ?></p>
            <?php
            }
        } */
        ?>
        
    </div>   

</article>

<?php get_footer(); ?>