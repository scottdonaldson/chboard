<?php

// ----- User conditions
function user_conds() {
	return is_user_logged_in() || (chboard_logged_in() && chboard_has_permission());
}

// ----- Determine whether the user is logged in (our own cookie-ing system)
function chboard_logged_in() {
	if (isset($_COOKIE['chboard_logged_in']) && $_COOKIE['chboard_logged_in'] !== '') {
		return true;
	} else {
		return false;
	}
}

// ----- Determine whether the logged in user has permissions to view the page
function chboard_has_permission() {
	if ( chboard_logged_in() ) {
		$username = $_COOKIE['chboard_logged_in'];
		$users = get_field('board_users', 'Options');
		// loop through to find the current user
		foreach ($users as $user) {
			if ($user['username'] === $username) {
				$the_user = $user;
				break;
			}
		}
		// If 0 allowed pages, that actually means all, so always return true
		if ( !$the_user['access'] ) {
			return true;
		}
		foreach ($the_user['access'] as $access) {
			if (get_the_permalink() === $access) {
				return true;
			}
		}
	}
	return false;
}

// Navigation menus
register_nav_menus( array(
	'primary' => 'Primary Menu'
) );

// Editor style 
add_editor_style('css/editor-style.css');

// Admin style
function my_admin_head() {
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
	remove_menu_page('profile.php');
	remove_menu_page('customize.php');
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
add_action('admin_menu', 'remove_admin');

// Hide admin bar for non-admins
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}

// Editor can edit menu

function give_user_edit() {
	if(current_user_can('edit_others_posts')) {
		global $wp_roles;
		$wp_roles->add_cap('editor','edit_theme_options' );
	}
}
add_action('admin_init', 'give_user_edit', 10, 0);


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