<?php
/**
 * Adds critical styles to the header of the website.
 *
 * @link       https://striventa.com
 * @since      1.0.0
 *
 * @package    THMBlocksyChild
 */
class THMBlocksyChild_Critical_Assets {
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {
			
	}
	
	/* Add critical CSS to the <head> of the site.
	 *
	 * @link https://www.sitelocity.com/critical-path-css-generator
	 * @link https://www.namehero.com/startup/how-to-inline-and-defer-css-on-wordpress-without-plugins/
	 */
	public function thm_critical_css() {
		$css = file_get_contents( get_stylesheet_directory() . '/assets/css/thm-blocksy-critical.css' );
		echo '<style id="thm-blocksy-critical-css" type="text/css">'.$css.'</style>';
	}
	
	/* Add rel="preload" to stylesheets loaded by wp_enqueue_scripts()
	 *
	 * @param string $html: The link tag for the enqueued style.
	 * @param string $handle: The style's registered handle.
	 * @param string $href: The stylesheet's source URL.
	 * @param string $media: The stylesheet's media attribute.
	 */
	public function thm_add_rel_preload($html, $handle, $href, $media) {
		if( is_admin() ):
			return $html;
		endif;
	
		$html = <<<EOT
<link rel='preload' as='style' id='$handle' href='$href' type='text/css' media='all' />
<link rel='stylesheet' as='style' id='$handle' href='$href' type='text/css' media='all' />
EOT;
		return $html;
	}
	
	/**
	 * Convert Hex to RGB
	 */
	public function thm_hex2rgb( $color ) {
		(strlen($color) === 4) ? list($r, $g, $b) = sscanf($color, "#%1x%1x%1x") : list($r, $g, $b) = sscanf($color, "#%2x%2x%2x");
		return array( 'r' => $r, 'g' => $g, 'b' => $b );
	}
	
}
