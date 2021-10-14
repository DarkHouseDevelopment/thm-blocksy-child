<?php

/**
 * The file that defines the core theme class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://striventa.com
 * @since      1.0.0
 *
 * @package    THMBlocksyChild
 * @subpackage THMBlocksyChild/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    THMBlocksyChild
 * @subpackage THMBlocksyChild/includes
 * @author     Striventa <zach@striventa.com>
 */
class THMBlocksyChild {

	/**
	 * Define the core functionality of the theme.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->load_dependencies();
		$this->define_critical_assets();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - THMBlocksyChild_Loader. Orchestrates the hooks of the plugin.
	 * - THMBlocksyChild_Admin. Defines all hooks for the admin area.
	 * - THMBlocksyChild_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		
		// Classes
		// The class responsible for orchestrating the actions and filters of the core plugin.
		require_once get_stylesheet_directory() . '/lib/classes/class-thm-blocksy-loader.php';
		// Adds critical styles to the header of the website
		require_once get_stylesheet_directory() . '/lib/classes/class-thm-blocksy-critical-assets.php';
		// The class responsible for defining all actions that occur in the admin area.
		require_once get_stylesheet_directory() . '/lib/classes/class-thm-blocksy-admin.php';
		// The class responsible for defining all actions that occur in the public-facing side of the site.
		require_once get_stylesheet_directory() . '/lib/classes/class-thm-blocksy-public.php';
		// Adds duplicate post support
		require_once get_stylesheet_directory() . '/lib/classes/class-thm-blocksy-duplicate-post.php';
		
		// Functions
		if( !is_admin() ):
			// Misc functions
			require_once get_stylesheet_directory() . '/lib/functions/custom-functions.php';
			// Misc helper functions
			require_once get_stylesheet_directory() . '/lib/functions/helpers.php';
		endif;
		
		$this->loader = new THMBlocksyChild_Loader();

	}

	/**
	 * Register all of the hooks related to the critical styles for the website.
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_critical_assets() {

		$theme_critical_assets = new THMBlocksyChild_Critical_Assets();
		
		$this->loader->add_action( 'wp_head', $theme_critical_assets, 'thm_critical_css' );
		$this->loader->add_filter( 'style_loader_tag', $theme_critical_assets, 'thm_add_rel_preload', 10, 4 );
		
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$theme_admin = new THMBlocksyChild_Admin();

		$this->loader->add_action( 'admin_enqueue_scripts', $theme_admin, 'thm_enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $theme_admin, 'thm_enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $theme_admin, 'thm_add_reusable_blocks_menu' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$theme_public = new THMBlocksyChild_Public();
		
		// theme option hooks
		$this->loader->add_filter( 'body_class', $theme_public, 'thm_custom_body_classes' );
		$this->loader->add_filter( 'excerpt_length', $theme_public, 'thm_custom_excerpt_length', 999 );
		$this->loader->add_filter( 'excerpt_more', $theme_public, 'thm_excerpt_more' );

		$this->loader->add_action( 'wp_enqueue_scripts', $theme_public, 'thm_enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $theme_public, 'thm_enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}
	
}
