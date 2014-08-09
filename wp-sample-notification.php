<?php
/**
 * Plugin Name: Sample Notification
 * Plugin URI: 
 * Description: This is a sample wp admin notification taken from http://wptheming.com/2011/08/admin-notices-in-wordpress/
 * Version: 1.0
 * Author: Haris Ainur Rozak
 * Author URI: https://github.com/harisrozak
 */

/**
 * Standart notice
 */
add_action('admin_notices', 'standart_notice');
function standart_notice() {
    echo '<div class="updated"><p>I am a little notice.</p></div>';
}

/** 
 * Display a notice that can be dismissed 
 */
add_action('admin_notices', 'example_admin_notice');
function example_admin_notice() 
{
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'example_ignore_notice') ) 
	{
	        echo '<div class="updated"><p>';
	        printf(__('This is an annoying nag message.  Why do people make these? | <a href="%1$s">Hide Notice</a>'), '?example_nag_ignore=0');
	        echo "</p></div>";
	}
}
add_action('admin_init', 'example_nag_ignore');
function example_nag_ignore() 
{
	global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['example_nag_ignore']) && '0' == $_GET['example_nag_ignore'] ) {
             add_user_meta($user_id, 'example_ignore_notice', 'true', true);
	}
}

/**
 * Display notice in specific admin page
 */
add_action('admin_notices', 'on_page_notice');
function on_page_notice()
{
    global $pagenow;
    if ( $pagenow == 'plugins.php' ) {
         echo '<div class="updated"><p>This notice only appears on the plugins page.</p></div>';
    }
}
