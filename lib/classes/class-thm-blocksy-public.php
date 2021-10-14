<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://striventa.com
 * @since      1.0.0
 *
 * @package    THMBlocksyChild
 * @subpackage THMBlocksyChild/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    THMBlocksyChild
 * @subpackage THMBlocksyChild/public
 * @author     Striventa <zach@striventa.com>
 */
class THMBlocksyChild_Public {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {
		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function thm_enqueue_styles() {

		wp_enqueue_style( 'thm-blocksy-child', get_stylesheet_directory_uri() . '/assets/css/thm-blocksy-styles.css', array(), null, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function thm_enqueue_scripts() {
		
		wp_enqueue_script( 'thm-blocksy-child', get_stylesheet_directory_uri() . '/assets/js/thm-blocksy-scripts.js', array( 'jquery' ), null, false );

	}
	
	/* Append browser specific classes to the body class as well as the page slug
	 *
	 * @param array $classes: array of classes to add to the <body> tag
	 */
	function thm_custom_body_classes( $classes ){
		global $post;
		
		if(!empty( $post )):
			$slug = $post->post_name;
			$classes[] .= $slug;
			// the list of WordPress global browser checks
			// @link https://codex.wordpress.org/Global_Variables#Browser_Detection_Booleans
			$browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
			// check the globals to see if the browser is in there and return a string with the match
			$classes[] .= join(' ', array_filter($browsers, function ($browser) {
				return $GLOBALS[$browser];
			}));
		endif;
		
		return $classes;
	}
	
	/**
	 * Filter the except length to 20 words.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
	function thm_custom_excerpt_length( $length ) {
		return 30;
	}
	
	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more "Read more" excerpt string.
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
	function thm_excerpt_more( $more ) {
		$more = '...';
		return $more;
	}

}
