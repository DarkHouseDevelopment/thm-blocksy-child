<?php
/**
 * Adds critical styles to the header of the website.
 *
 * @link       https://striventa.com
 * @since      1.0.0
 *
 * @package    Evertheme
 */
class Evertheme_Critical_Assets {
	
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
	
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		add_action( 'wp_head', [ $this, 'evt_critical_css' ] );
		add_filter( 'style_loader_tag', [ $this, 'evt_add_rel_preload' ], 10, 4 );
	
	}
	
	/* Add critical CSS to the <head> of the site.
	 *
	 * @link https://www.sitelocity.com/critical-path-css-generator
	 * @link https://www.namehero.com/startup/how-to-inline-and-defer-css-on-wordpress-without-plugins/
	 */
	public function evt_critical_css() {
		$css = file_get_contents( EVERTHEME_DIR_PATH . 'public/css/evertheme-critical.css' );
		echo '<style id="evertheme-critical-css" type="text/css">'.$css.'</style>';
	}
	
	/* Add rel="preload" to stylesheets loaded by wp_enqueue_scripts()
	 *
	 * @param string $html: The link tag for the enqueued style.
	 * @param string $handle: The style's registered handle.
	 * @param string $href: The stylesheet's source URL.
	 * @param string $media: The stylesheet's media attribute.
	 */
	public function evt_add_rel_preload($html, $handle, $href, $media) {
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
	public function evt_hex2rgb( $color ) {
		(strlen($color) === 4) ? list($r, $g, $b) = sscanf($color, "#%1x%1x%1x") : list($r, $g, $b) = sscanf($color, "#%2x%2x%2x");
		return array( 'r' => $r, 'g' => $g, 'b' => $b );
	}
	
}
