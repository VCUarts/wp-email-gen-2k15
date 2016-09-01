<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. Updates to this page are coming soon.
It's turned off by default, but you can call it
via the functions file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

Special Thanks for code & inspiration to:
@jackmcconnell - http://www.voltronik.co.uk/
Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/


	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin


*/

/************* DASHBOARD WIDGETS *****************/
// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );    // Right Now Widget
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );        // Activity Widget
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] ); // Comments Widget
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );  // Incoming Links Widget
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );         // Plugins Widget

	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );    // Quick Press Widget
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );     // Recent Drafts Widget
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );           //
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );         //

	// remove plugin dashboard boxes
	unset( $wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget'] );           // Yoast's SEO Plugin Widget
	unset( $wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard'] );        // Gravity Forms Plugin Widget
	unset( $wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now'] );   // bbPress Plugin Widget
}

// removing the dashboard widgets
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );

function artsmail_custom_dashboard_widgets() {
  global $wp_meta_boxes;

  wp_add_dashboard_widget( 'artsmail_dashboard_widget', 'VCUarts Admissions Email Generator', 'artsmail_widget_content' );
}

function artsmail_widget_content() {
  echo '<h2 style="text-align:center; margin: 20px 0; color: #666; letter-spacing: 2px;"><span class="dashicons dashicons-email-alt" style="line-height: inherit;"></span> Make Email Great Again <span class="dashicons dashicons-thumbs-up" style="line-height: inherit;"></span></h2>';
}

add_action( 'wp_dashboard_setup', 'artsmail_custom_dashboard_widgets' );


/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function bones_login_css() {
	wp_enqueue_style( 'bones_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function bones_login_url() {
  return home_url(); }

// changing the alt text on the logo to show your site name
function bones_login_title() {
 return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'bones_login_css', 10 );
add_filter( 'login_headerurl', 'bones_login_url' );
add_filter( 'login_headertitle', 'bones_login_title' );


/************* CUSTOMIZE ADMIN *******************/

// Custom Backend Footer
function bones_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://arts.vcu.edu" target="_blank">VCUarts</a></span>';
}
// adding it to the admin area
add_filter( 'admin_footer_text', 'bones_custom_admin_footer' );


// Change Posts label to Email in Admin Panel
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Emails';
    $submenu['edit.php'][5][0] = 'All Emails';
    $submenu['edit.php'][10][0] = 'Add Email';
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
    remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    echo '';
}
function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Email';
	$labels->singular_name = 'Email';
	$labels->add_new = 'Add Email';
	$labels->add_new_item = 'Add Email';
	$labels->edit_item = 'Edit Email';
	$labels->new_item = 'Email';
	$labels->view_item = 'View Email';
	$labels->search_items = 'Search Email';
	$labels->not_found = 'No Emails found';
	$labels->not_found_in_trash = 'No Email found in Trash';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

?>
