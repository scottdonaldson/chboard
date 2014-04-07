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
if ( $meetings->have_posts()) : while ( $meetings->have_posts() ) : $meetings->the_post();
    
    $these_meetings = get_field('meeting');

    if ($these_meetings) {
        foreach ($these_meetings as $this_meeting) {
            $y = substr($this_meeting['date'], 0, 4);
            $m = substr($this_meeting['date'], 4, 2);

            $output[$i] = array(
                $this_meeting['date'], 
                get_the_title(), 
                get_permalink(),
                $this_meeting['time'],
                $this_meeting['location']
            );

            $i++;
        }
    }
endwhile; endif;
wp_reset_postdata();
?>

<section class="row">
	
    <div class="fourth">
        <?php get_sidebar(); ?>
    </div>

    <div class="three-fourths">

        <h2 class="alignleft">Calendar</h2>
        <form class="alignright">
            <p>View another month:</p>
            <select name="month">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <select name="yr">
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
            </select>
            <input type="submit" value="Update">
        </form>
        <div class="calendar clearfix">
            <?php

            $months = array(
                '01' => 'January',
                '02' => 'February',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'August',
                '09' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December'
            );

            $month_num = isset($_GET['month']) ? $_GET['month'] : date('m');
            $month_name = $months[$month_num];

            $year = isset($_GET['yr']) ? $_GET['yr'] : date('Y');

            $is_current = intval($month_num) == date('m') && intval($year) == date('Y') ? true : false;

            $weekdates = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
            
            $l = date('l'); // get day of week
            $d = date('j'); // get numeric day of month
            
            // What day of the week is the first of the month?
            $start = $is_current ? 
                ( array_search($l, $weekdates) - ($d - 1) ) % 7 + 7 : 
                array_search( strftime( '%A', strtotime($month_name . ' 1 ' . $year) ), $weekdates );

            // Set last day of the month
            $thirtyones = array('January', 'March', 'May', 'July', 'August', 'October', 'December');
            $thirties = array('April', 'June', 'September', 'November');

            if ( in_array( $month_name, $thirtyones ) ) {
                $last = 31;
            } elseif ( in_array( $month_name, $thirties ) ) {
                $last = 30;
            } else {
                // leap years!
                $last = intval($year) % 4 === 0 ? 29 : 28;
            }

            echo '<h3 class="red">' . $month_name . ' ' . $year . '</h3>';
            
            for ($i = 1; $i <= 42; $i++) { 
                if ($i <= $start || $i > $start + $last) { 
                    echo '<div class="date empty"></div>';
                } else { ?>
                <div class="date <?php if ( $i - $start == date('j') && $is_current ) { echo 'today'; } ?>">
                    <?php 
                    echo '<small class="day">'.($i - $start).'</small>';
                    foreach ($output as $meeting) {
                        // Set vars
                        $date = $meeting[0];
                        $name = $meeting[1];
                        $link = $meeting[2];
                        
                        // If it's the correct day, month, and year, output the meeting name
                        if (substr($date, 6, 2) == $i - $start && substr($date, 4, 2) == $month_num && substr($date, 0, 4) == $year) { ?>
                            <p><a href="<?php echo $link; ?>/#<?php echo $date; ?>"><?php echo $name; ?></a>
                            </p>
                        <?php
                        }
                        
                    } ?>
                </div>
                <?php 
                }
            } ?>
        </div><!-- .calendar -->

        <div class="entry-content indented">
            <?php
            while (have_rows('pdf')) : the_row();
                the_sub_field('embed_code');
            endwhile;
            ?>
        </div>

    </div>

</section>

<?php } else { include( MAIN .'login.php'); } ?>

<?php get_footer(); ?>