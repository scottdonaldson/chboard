<?php 
/*
Template Name: Main Page
*/
get_header(); 
?>

<?php if (is_user_logged_in()) { ?>
<h2 class="entry-title">Welcome to the Clare Housing Board Website</h2>
<?php
$meetings = new WP_Query(array(
    'posts_per_page' => -1
    )
);
$output = array();
while ($meetings->have_posts()) : $meetings->the_post();

    if (get_field('meeting')) {
        while (has_sub_field('meeting')) {
            $m = get_sub_field('date');
            $m = substr($m, 4, 2);
            if ($m == date('m') || $m == date('m') + 1) {
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
<section class="row">
	
    <div class="third">
        <?php get_sidebar(); ?>
    </div>

    <div class="two-thirds">
        <?php if ($_GET['view'] == 'list') { ?>
        <h2>Upcoming Meetings <small>(<a href="<?php echo home_url(); ?>">View as Calendar &raquo;</a>)</small></h2>
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

        <?php } else { ?>

        <h2>Calendar <small>(<a href="<?php echo home_url(); ?>?view=list">View as List &raquo;</a>)</small></h2>
        <div class="calendar clearfix">
            <?php 
            $month = date('F');
            $weekdates = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
            
            $l = date('l'); // get day of week
            $d = date('j'); // get numeric day of month
            
            // What day of the week is the first of the month?
            $start = array_search($l, $weekdates) - ($d - 1);
            $start = $start % 7 + 7;

            // Set last day of the month
            $thirtyones = array('January', 'March', 'May', 'July', 'August', 'October', 'December');
            $thirties = array('April', 'June', 'September', 'November');
            if (in_array($month, $thirtyones)) {
                $last = 31;
            } elseif (in_array($month, $thirties)) {
                $last = 30;
            } else {
                // unlikely that this will be around for the next two leap years, but just in case...
                date('Y') == 2016 || date('Y') == 2020 ? $last = 29 : $last = 28;
            }

            echo '<h3 class="red">'.$month.'</h3>';
            
            for ($i = 1; $i <= 42; $i++) { 
                if ($i <= $start || $i > $start + $last) { 
                    echo '<div class="date empty"></div>';
                } else { ?>
                <div class="date <?php if ($i - $start == date('j')) { echo 'today'; } ?>">
                    <?php 
                    echo '<small class="day">'.($i - $start).'</small>';
                    foreach ($output as $meeting) {
                        // Set vars
                        $date = $meeting[0];
                        $name = $meeting[1];
                        $link = $meeting[2];
                        
                        // If it's the correct day and the correct month, output the meeting name
                        if (substr($date, 6, 2) == $i - $start && substr($date, 4, 2) == date('m')) { ?>
                            <p><a href="<?php echo $link; ?>/#<?php echo $date; ?>"><?php echo $name; ?></a>
                            </p>
                        <?php
                        }
                        
                    } 
                    if ($i == $start + $last) { // set the start date for the next month
                        $nextstart = $i % 7;
                    } ?>
                </div>
                <?php 
                }
            } ?>
        </div><!-- .calendar -->
        <div class="calendar clearfix">
            <?php
            $nextmonth = date('F', strtotime("+1 months"));
            echo '<h3 class="red">'.$nextmonth.'</h3>';

            if (in_array($nextmonth, $thirtyones)) {
                $last = 31;
            } elseif (in_array($nextmonth, $thirties)) {
                $last = 30;
            } else {
                // unlikely that this will be around for the next two leap years, but just in case...
                date('Y') == 2016 || date('Y') == 2020 ? $last = 29 : $last = 28;
            }

            for ($i = 1; $i <= 42; $i++) { 
                if ($i <= $nextstart || $i > $nextstart + $last) { 
                    echo '<div class="date empty"></div>';
                } else { ?>
                <div class="date">
                    <?php 
                    echo '<small class="day">'.($i - $start).'</small>';
                    foreach ($output as $meeting) {
                        // Set vars
                        $date = $meeting[0];
                        $name = $meeting[1];
                        $link = $meeting[2];
                        
                        // If it's the correct day and the correct month, output the meeting name
                        if (substr($date, 6, 2) == $i - $start && substr($date, 4, 2) == date('m') + 1) { ?>
                            <p><a href="<?php echo $link; ?>/#<?php echo $date; ?>"><?php echo $name; ?></a>
                            </p>
                        <?php
                        }
                        
                    } ?>
                </div>
                <?php 
                }
            } 
            ?>
        </div>

        <?php } ?>

        <h2><a href="<?php echo home_url(); ?>/all">View all upcoming meetings &raquo;</a></h2>
    </div>

</section>

<?php } else { include( MAIN .'login.php'); } ?>

<?php get_footer(); ?>