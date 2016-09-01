<?php
/*
Author: Cody Whitby
URL: http://arts.vcu.edu

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // Custom Chunks Post Type
  require_once( 'library/chunks-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* THEME CUSTOMIZE *********************/
function bones_theme_customizer( $wp_customize ) {
  $wp_customize->remove_section( 'colors' );
  $wp_customize->remove_section( 'background_image' );
  $wp_customize->remove_section( 'static_front_page' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/*
we_are_live() is a function for testing our environment. 
@returns true if on production server false if not
*/
function we_are_live() {
  $host = home_url();
  if ( preg_match( '/\.dev/', $host ) ) {
    return false;
  }
  return true;
}

/*
** Removing Admin Bar
*/
show_admin_bar( false );


/*
** Removing emoji support
*/
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/*
** Clean up all the things
*/
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
function remove_api() {
  remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'remove_api' );

/*
** Strip Image Width / Height Attributes from Post Editor
*/
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
    return $html;
}


add_filter( 'gform_disable_notification', 'gf_disable_notification', 10, 4 );
function gf_disable_notification( $is_disabled, $notification, $form, $entry ) {
  return true;
}

/*
** Adding VCUarts Red to TinyMCE colors
*/
function emailgen_change_tinymce_colors( $init ) {
    $default_colours = '
        "000000", "Black",
        "993300", "Burnt orange",
        "333300", "Dark olive",
        "003300", "Dark green",
        "003366", "Dark azure",
        "000080", "Navy Blue",
        "333399", "Indigo",
        "333333", "Very dark gray",
        "800000", "Maroon",
        "FF6600", "Orange",
        "808000", "Olive",
        "008000", "Green",
        "008080", "Teal",
        "0000FF", "Blue",
        "666699", "Grayish blue",
        "808080", "Gray",
        "FF0000", "Red",
        "FF9900", "Amber",
        "99CC00", "Yellow green",
        "339966", "Sea green",
        "33CCCC", "Turquoise",
        "3366FF", "Royal blue",
        "800080", "Purple",
        "999999", "Medium gray",
        "FF00FF", "Magenta",
        "FFCC00", "Gold",
        "FFFF00", "Yellow",
        "00FF00", "Lime",
        "00FFFF", "Aqua",
        "00CCFF", "Sky blue",
        "993366", "Brown",
        "C0C0C0", "Silver",
        "FF99CC", "Pink",
        "FFCC99", "Peach",
        "FFFF99", "Light yellow",
        "CCFFCC", "Pale green",
        "CCFFFF", "Pale cyan",
        "99CCFF", "Light sky blue",
        "CC99FF", "Plum",
        "FFFFFF", "White"
        ';
    $custom_colours = '
        "ee2c42", "VCUarts Red"
        ';
    $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
    $init['textcolor_rows'] = 6; // expand colour grid to 6 rows
    return $init;
}
add_filter( 'tiny_mce_before_init', 'emailgen_change_tinymce_colors' );


/**
 * Loading CssToInlineStyles
 */
require_once __DIR__ . '/vendor/autoload.php';
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;


/**
 * Output Buffering
 *
 * Buffers the entire WP process, capturing the final output for manipulation.
 */

ob_start();

add_action( 'shutdown', function() {

    if ( is_admin() || in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
        return;
      }

    $final = '';

    // We'll need to get the number of ob levels we're in, so that we can iterate over each, collecting
    // that buffer's output into the final output.
    $levels = count( ob_get_level() );

    for ( $i = 0; $i < $levels; $i++ )
    {
        $final .= ob_get_clean();
    }

    // Apply any filters to the final output
    echo apply_filters( 'final_output', $final );
}, 0);

// Buffered Output into cssToInlineStyles
add_filter( 'final_output', function( $output ) {
  // create instance
  $cssToInlineStyles = new CssToInlineStyles();
  $css = file_get_contents( __DIR__ . '/library/css/style.css' );
  $cssToInlineStyles->setHTML( $output );
  $cssToInlineStyles->setCSS( $css );
  // output
  echo $cssToInlineStyles->convert();
});
