<?php
// Define paths
define('MAIN', dirname(__FILE__) . '/');

if (isset($_GET['action']) && $_GET['action'] === 'login') {

  // If no password given
  if ( $_POST['password'] === '') {
    $error = 'Please enter a password.';
  }

  if ( $_POST['username'] === '') {
    $error = 'Please enter a username.';
  }

  if ( $_POST['username'] === '' && $_POST['password'] === '') {
    $error = 'Please enter a username and a password.';
  }

  $users = get_field('board_users', 'Options');
  echo '<pre style="color: #fff;">';
  var_dump($_POST);
  echo '<br>';
  echo !isset($_POST['password']);
  echo '<br>';
  var_dump($users);
  echo '</pre>';
  /* foreach ($users as $user) {
    if ( true ) {

    }
  } */
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

  <title>Clare Housing Board</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    
	<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_url'); ?>">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/reset.css"> 
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/clare.css">      
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/board.css">      
    
    <!--[if lt IE 9]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->  
    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->
  
  <?php wp_head(); ?>  	
</head>

<body <?php body_class(); ?>>

<header class="contentbox">
        
    <a href="<?php echo home_url(); ?>">
		<img src="<?php echo bloginfo('template_url'); ?>/images/logo.png" id="logo" alt="Clare Housing - Partners in AIDS Care">
    </a>
        
    <div class="banner">
        <?php 
        // No custom post types here, unlike on main site. Just choose from 4 random banner images
        $num = rand(1, 4);  

        $url = get_bloginfo('template_url'); ?>
        <img src="<?php echo get_bloginfo('template_url'); ?>/images/banner-home<?php echo $num; ?>.jpg">
    </div>

</header>

<div id="container" class="clearfix contentbox">
    
    <div id="main" role="main" class="clearfix gradient">
      
      <div class="callout"></div>
      <?php if (is_front_page()) { ?>
      <h2 class="entry-title" style="margin-bottom: 10px;">Welcome to the Clare Housing Board Website</h2>
      <?php } ?>

      <?php 
      if (is_user_logged_in()) { 

        $menu = wp_get_nav_menu_items('Primary Menu');
        echo '<select id="select-nav" onchange="location=this.options[this.selectedIndex].value;">';
        echo '<option disabled selected>Select a page:</option>';
        foreach ($menu as $menu_item) {
          echo '<option value="'.$menu_item->url.'">'.$menu_item->title.'</option>';
        }
        echo '</select>';
      }
      ?>