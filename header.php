<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="date=no">
		<meta name="format-detection" content="telephone=no">
		<title><?php get_field( 'email_title' ) ? the_field( 'email_title' ) : the_title(); ?></title>
		<?php
		wp_head();
		if ( is_single() ) :
			echo '<style>' . esc_html( file_get_contents( get_stylesheet_directory_uri() . '/library/css/head.css' ) ) . '</style>';
		endif;
		?>
	</head>
	<body <?php body_class(); ?>>
