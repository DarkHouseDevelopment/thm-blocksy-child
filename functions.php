<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
});


/**
 * Theme Setup/Functions
 *
 * The $theme_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 */
$theme_includes = [
	// classes
	'/lib/classes/class-thm-blocksy-critical-assets.php', // Load Critical Assets
	'/lib/classes/class-thm-blocksy-duplicate-post.php', // Duplicate Post

	// custom functions
	'/lib/functions/custom-functions.php',
	'/lib/functions/helpers.php',

];

foreach ( $theme_includes as $file ) {

	if( !$filepath = locate_template( $file ) ):
		trigger_error( sprintf( __('Error locating %s for inclusion', 'hfw'), $file ), E_USER_ERROR );
	endif;

	require_once $filepath;
}
unset( $file, $filepath );