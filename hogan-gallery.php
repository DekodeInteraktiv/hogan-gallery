<?php
/**
 * Plugin Name: Hogan Module: Gallery
 * Plugin URI: https://github.com/dekodeinteraktiv/hogan-gallery
 * GitHub Plugin URI: https://github.com/dekodeinteraktiv/hogan-gallery
 * Description: Image Gallery Module for Hogan
 * Version: 1.2.3
 * Author: Dekode
 * Author URI: https://en.dekode.no
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * Text Domain: hogan-gallery
 * Domain Path: /languages/
 *
 * @package Hogan
 * @author Dekode
 */

declare( strict_types = 1 );
namespace Dekode\Hogan\Gallery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HOGAN_GALLERY_VERSION', '1.2.3' );

add_action( 'plugins_loaded', __NAMESPACE__ . '\\hogan_load_textdomain' );
add_action( 'hogan/include_modules', __NAMESPACE__ . '\\hogan_register_module', 10, 1 );

/**
 * Register module text domain
 *
 * @return void
 */
function hogan_load_textdomain() {
	\load_plugin_textdomain( 'hogan-gallery', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Register module in Hogan
 *
 * @param \Dekode\Hogan\Core $core Hogan Core instance.
 * @return void
 */
function hogan_register_module( \Dekode\Hogan\Core $core ) {
	require_once 'class-gallery.php';
	$core->register_module( new \Dekode\Hogan\Gallery() );
}
