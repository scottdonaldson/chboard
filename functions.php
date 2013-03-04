<?php

// Navigation menus
register_nav_menus( array(
	'primary' => 'Primary Menu'
) );

// Editor style 
add_editor_style('css/editor-style.css');

// Admin style

function my_admin_head() {
    echo '<link rel="stylesheet" type="text/css" href="' .get_bloginfo('template_url').'/css/admin-style.css">';
    echo '<script src="'.get_bloginfo('template_url').'/js/admin.js"></script>';
}

add_action('admin_head', 'my_admin_head');


// Excerpt length and "more"
function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/* ------ Remove a few admin pages ----- */

function remove_admin() {
	remove_menu_page('link-manager.php');
	remove_menu_page('upload.php');
	remove_menu_page('tools.php');
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_admin');

// Hide admin bar for non-admins
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}


// Admin footer

add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = 'Site developed by <a href="http://parsleyandsprouts.com" target="_blank">Parsley &amp Sprouts</a>.';
    return $text;
}
 
add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
function right_admin_footer_text_output($text) {
    $text = '&copy '.date('Y').'.';
    return $text;
}


// Custom login screen

function my_login_head() {
	echo "<link rel='stylesheet' href='".get_bloginfo('template_url')."/css/login-style.css' type='text/css'>";
}
add_action('login_head', 'my_login_head');

function loginpage_custom_link() {
	return 'http://www.clarehousing.org';
}
add_filter('login_headerurl','loginpage_custom_link');

function change_title_on_logo() {
	return 'Clare Housing';
}
add_filter('login_headertitle', 'change_title_on_logo');

?>