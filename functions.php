<?php
/*
Author: VCUarts
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
remove_action( 'after_plugin_row_gwlimitchoices/gwlimitchoices.php', 'after_perk_plugin_row' );
remove_action( 'after_plugin_row_gwlimitcheckboxes/gwlimitcheckboxes.php', 'after_perk_plugin_row' );
remove_action( 'after_plugin_row_gwwordcount/gwwordcount.php', 'after_perk_plugin_row' );
remove_action( 'after_plugin_row_gravityperks/gravityperks.php', 'GWPerks::after_plugin_row' );

/*
** Strip Image Width / Height Attributes from Post Editor
*/
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
    return $html;
}


// Custom Image Sizes
add_action( 'after_setup_theme', 'artsmail_image_sizes' );
function artsmail_image_sizes() {
    add_image_size( 'chunks-thumb', 600, 600, true );
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
 * Minify HTML
 */
/**
 * ----------------------------------------------------------------------------------------
 * Based on `https://github.com/mecha-cms/mecha-cms/blob/master/engine/plug/converter.php`
 * ----------------------------------------------------------------------------------------
 */
// Helper function(s) ...
define( 'X', "\x1A" ); // a placeholder character
$SS = '"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'';
$CC = '\/\*[\s\S]*?\*\/';
$CH = '<\!--[\s\S]*?-->';
function __minify_x( $input ) {
    return str_replace( array( "\n", "\t", ' ' ), array( X . '\n', X . '\t', X . '\s' ), $input );
}
function __minify_v( $input ) {
    return str_replace( array( X . '\n', X . '\t', X . '\s' ), array( "\n", "\t", ' ' ), $input );
}
/**
 * =======================================================
 *  HTML MINIFIER
 * =======================================================
 * -- CODE: ----------------------------------------------
 *
 *    echo minify_html(file_get_contents('test.html'));
 *
 * -------------------------------------------------------
 */
function _minify_html( $input ) {
    return preg_replace_callback('#<\s*([^\/\s]+)\s*(?:>|(\s[^<>]+?)\s*>)#', function( $m ) {
        if ( isset( $m[2] ) ) {
            return '<' . $m[1] . preg_replace(
                array(
                    // From `defer="defer"`, `defer='defer'`, `defer="true"`, `defer='true'`, `defer=""` and `defer=''` to `defer` [^1]
                    '#\s(checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)(?:=([\'"]?)(?:true|\1)?\2)#i',
                    // Remove extra white-space(s) between HTML attribute(s) [^2]
                    '#\s*([^\s=]+?)(=(?:\S+|([\'"]?).*?\3)|$)#',
                    // From `<img />` to `<img/>` [^3]
                    '#\s+\/$#',
                ),
                array(
                    // [^1]
                    ' $1',
                    // [^2]
                    ' $1$2',
                    // [^3]
                    '/',
                ),
            str_replace( "\n", ' ', $m[2] )) . '>';
        }
        return '<' . $m[1] . '>';
    }, $input);
}
function minify_html( $input ) {
    if ( ! $input = trim( $input ) ) { return $input; }
    global $CH;
    // Keep important white-space(s) after self-closing HTML tag(s)
    $input = preg_replace( '#(<(?:img|input)(?:\s[^<>]*?)?\s*\/?>)\s+#i', '$1' . X . '\s', $input );
    // Create chunk(s) of HTML tag(s), ignored HTML group(s), HTML comment(s) and text
    $input = preg_split( '#(' . $CH . '|<pre(?:>|\s[^<>]*?>)[\s\S]*?<\/pre>|<code(?:>|\s[^<>]*?>)[\s\S]*?<\/code>|<script(?:>|\s[^<>]*?>)[\s\S]*?<\/script>|<style(?:>|\s[^<>]*?>)[\s\S]*?<\/style>|<textarea(?:>|\s[^<>]*?>)[\s\S]*?<\/textarea>|<[^<>]+?>)#i', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );
    $output = '';
    foreach ( $input as $v ) {
        if ( $v !== ' ' && trim( $v ) === '' ) { continue; }
        if ( $v[0] === '<' && substr( $v, -1 ) === '>' ) {
            if ( $v[1] === '!' && strpos( $v, '<!--' ) === 0 ) { // HTML comment ...
                // Remove if not detected as IE comment(s) ...
                if ( substr( $v, -12 ) !== '<![endif]-->' ) { continue; }
                $output .= $v;
            } else {
                $output .= __minify_x( _minify_html( $v ) );
            }
        } else {
            // Force line-break with `&#10;` or `&#xa;`
            $v = str_replace( array( '&#10;', '&#xA;', '&#xa;' ), X . '\n', $v );
            // Force white-space with `&#32;` or `&#x20;`
            $v = str_replace( array( '&#32;', '&#x20;' ), X . '\s', $v );
            // Replace multiple white-space(s) with a space
            $output .= preg_replace( '#\s+#', ' ', $v );
        }
    }
    // Clean up ...
    $output = preg_replace(
        array(
            // Remove two or more white-space(s) between tag [^1]
            '#>([\n\r\t]\s*|\s{2,})<#',
            // Remove white-space(s) before tag-close [^2]
            '#\s+(<\/[^\s]+?>)#',
        ),
        array(
            // [^1]
            '><',
            // [^2]
            '$1',
        ),
    $output);
    $output = __minify_v( $output );
    // Remove white-space(s) after ignored tag-open and before ignored tag-close (except `<textarea>`)
    return preg_replace( '#<(code|pre|script|style)(>|\s[^<>]*?>)\s*([\s\S]*?)\s*<\/\1>#i', '<$1$2$3</$1>', $output );
}



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
    for ( $i = 0; $i < $levels; $i++ ) {
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
  $converted = $cssToInlineStyles->convert();
  echo minify_html( $converted );
});
