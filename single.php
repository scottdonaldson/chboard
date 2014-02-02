<?php 
get_header();  
the_post(); ?>
      
<article <?php post_class('row'); ?>>      
    
    <div class="third">
        <?php get_sidebar(); ?>
    </div>

    <div class="two-thirds">
        <h2 class="red">
            <?php 
            if (!isset($_GET['pastmeetings']) || $_GET['pastmeetings'] !== 'true') {
                the_title(); ?> <small>- Upcoming Meetings (<a href="<?php the_permalink(); ?>?pastmeetings=true">View Past Meetings</a>)</small>
            <?php } elseif (isset($_GET['pastmeetings']) && $_GET['pastmeetings'] === 'true') {
                the_title(); ?> <small>- Past Meetings (<a href="<?php the_permalink(); ?>">View Upcoming Meetings</a>)</small>
            <?php } ?>
        </h2>
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

            if (!isset($_GET['pastmeetings']) || $_GET['pastmeetings'] !== 'true') {
                if ($date >= $today) {

                    $month = substr($date, 4, 2);
                    $day = substr($date, 6, 2);
                    $year = substr($date, 0, 4);
                    // If $day starts with a 0, chop it off
                    substr($day, 0, 1) == 0 ? $day = substr($day, 1, 1) : $day = $day; ?>

                    <div class="entry clearfix" id="<?php echo $date; ?>">
                        <p><?php echo $months[$month - 1]; ?>&nbsp;<?php echo $day; ?>, <?php echo $year; ?>, <?php echo $time; ?>&nbsp;<?php if ($location) { echo '('.$location.')'; } ?></p>
                        <?php if ($info) { echo '<p><em>'.$info.'</em></p>'; } ?>
                    </div>
                    <?php
                }
            } elseif (isset($_GET['pastmeetings']) && $_GET['pastmeetings'] === 'true') {
                if ($date < $today) {

                    $month = substr($date, 4, 2);
                    $day = substr($date, 6, 2);
                    $year = substr($date, 0, 4);
                    // If $day starts with a 0, chop it off
                    substr($day, 0, 1) == 0 ? $day = substr($day, 1, 1) : $day = $day; ?>

                    <div class="entry clearfix" id="<?php echo $date; ?>">
                        <p><?php echo $months[$month - 1]; ?>&nbsp;<?php echo $day; ?>, <?php echo $year; ?>, <?php echo $time; ?>&nbsp;<?php if ($location) { echo '('.$location.')'; } ?></p>
                        <?php if ($info) { echo '<p><em>'.$info.'</em></p>'; } ?>
                    </div>
                    <?php
                }
            }
        }
        ?>
        
    </div>   

</article>

<?php get_footer(); ?>