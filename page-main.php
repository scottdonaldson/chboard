<?php 
/*
Template Name: Main Page
*/
get_header(); 


if (is_user_logged_in()) {
    
$meetings = new WP_Query(array(
    'posts_per_page' => -1
    )
);
$output = array();
$i = 0;
while ( $meetings->have_posts() ) : $meetings->the_post();
    
    $these_meetings = get_field('meeting');

    foreach ($these_meetings as $this_meeting) {
        $y = substr($this_meeting['date'], 0, 4);
        $m = substr($this_meeting['date'], 4, 2);

        // this or next month
        if ( ($m == date('m') || $m == date('m') + 1) && $y == date('Y') ) {
            $output[$i] = array(
                $this_meeting['date'], 
                get_the_title(), 
                get_permalink(),
                $this_meeting['time'],
                $this_meeting['location']
            );
        }
        $i++;
    }
endwhile;
wp_reset_postdata();
?>

<section class="row">
	
    <div class="third">
        <?php get_sidebar(); ?>
    </div>

    <div class="two-thirds">

        <h2>Calendar</h2>
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
                        
                        // If it's the correct day, month, and year, output the meeting name
                        if (substr($date, 6, 2) == $i - $start && substr($date, 4, 2) == date('m') && substr($date, 0, 4) == date('Y')) { ?>
                            <p><a href="<?php echo $link; ?>/#<?php echo $date; ?>"><?php echo $name; ?></a>
                            </p>
                        <?php
                        }
                        
                    } 
                    if ($i == $start + $last) { // set the start date for the next month
                        $nextstart = $i % 7 > 0 ? $i % 7 : ($i % 7) + 7;
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
                    echo '<small class="day">'.($i - $nextstart).'</small>';
                    foreach ($output as $meeting) {
                        // Set vars
                        $date = $meeting[0];
                        $name = $meeting[1];
                        $link = $meeting[2];
                        
                        // If it's the correct day and the correct month, output the meeting name
                        if (substr($date, 6, 2) == $i - $nextstart && substr($date, 4, 2) == date('m') + 1) { ?>
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

    </div>

</section>

<?php } else { include( MAIN .'login.php'); } ?>

<?php get_footer(); ?>