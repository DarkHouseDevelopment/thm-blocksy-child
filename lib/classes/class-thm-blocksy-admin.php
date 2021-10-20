<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://striventa.com
 * @since      1.0.0
 *
 * @package    THMBlocksyChild
 * @subpackage THMBlocksyChild/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    THMBlocksyChild
 * @subpackage THMBlocksyChild/admin
 * @author     Striventa <brett@striventa.com>
 */
class THMBlocksyChild_Admin {


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {

		$this->error = '';
		
		if(!empty($this->error)){
			add_action( 'admin_notices', array( $this, 'thm_blocksy_validation_error_notice' ) );
		}

	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function thm_enqueue_styles() {
	
		wp_enqueue_style( 'thm_blocksy_child', get_stylesheet_directory_uri() . '/admin/css/thm-blocksy-admin.css', array(), null, 'all' );
	
	}
	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function thm_enqueue_scripts() {
	
		wp_enqueue_script( 'thm_blocksy_child', get_stylesheet_directory_uri() . '/admin/js/thm-blocksy-admin.js', array( 'jquery' ), null, false );
	
	}

	/**
	 * Register reusable blocks menu.
	 */
	public function thm_add_reusable_blocks_menu() {
		add_menu_page(
			__( 'Reusable Blocks', 'evt' ),
			'Reusable Blocks',
			'edit_posts',
			'edit.php?post_type=wp_block',
			'',
			'data:image/svg+xml;base64,'.base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="black" d="M5 7v3l-2 1.5V5h11V3l4 3.01L14 9V7H5zm10 6v-3l2-1.5V15H6v2l-4-3.01L6 11v2h9z"></path></svg>'),
			59
		);
	}

	/**
	 * Validate the license with LM and ensure that the license has not expired
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function thm_blocksy_validation_error_notice() {
		
		echo "<div class='error notice'><p>".$this->error."</p></div>";

	}

	/**
	 * Activates the Gutenberg Block Editor on Woo Products
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function thm_activate_gutenberg_products($can_edit, $post_type){
		if($post_type == 'product'){
			$can_edit = true;
		}
		
		return $can_edit;
	}

}
