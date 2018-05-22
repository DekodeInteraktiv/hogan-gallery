<?php
/**
 * Gallery module class.
 *
 * @package Hogan
 */

declare( strict_types = 1 );
namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( '\\Dekode\\Hogan\\Gallery' ) && class_exists( '\\Dekode\\Hogan\\Module' ) ) {

	/**
	 * Gallery module class.
	 *
	 * @extends Modules base class.
	 */
	class Gallery extends Module {

		/**
		 * Gallery items
		 *
		 * @var array $items;
		 */
		public $items;

		/**
		 * Module constructor.
		 */
		public function __construct() {

			$this->label    = __( 'Gallery', 'hogan-gallery' );
			$this->template = __DIR__ . '/assets/template.php';

			add_filter( 'hogan/module/outer_wrapper_classes', [ $this, 'add_wrapper_classname' ], 10, 2 );

			parent::__construct();
		}

		/**
		 * Load photoswipe template
		 */
		public function photoswipe_template() {
			include __DIR__ . '/assets/photoswipe-template.php';
		}

		/**
		 * Enqueue module assets
		 */
		public function enqueue_assets() {
			$_debug   = defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG;
			$_version = $_debug ? time() : HOGAN_GALLERY_VERSION;
			$_postfix = $_debug ? '' : '.min';

			// Flickity.
			wp_register_style( 'flickity', plugins_url( '/assets/flickity/flickity' . $_postfix . '.css', __FILE__ ), [], '2.0.10' );
			wp_register_script( 'flickity', plugins_url( '/assets/flickity/flickity.pkgd' . $_postfix . '.js', __FILE__ ), [], '2.0.10', true );

			// Photoswipe.
			add_action( 'wp_footer', [ $this, 'photoswipe_template' ], 999 );
			wp_register_style( 'photoswipe', plugins_url( '/assets/photoswipe/photoswipe.css', __FILE__ ), [], '4.1.2' );
			wp_register_script( 'photoswipe', plugins_url( '/assets/photoswipe/photoswipe' . $_postfix . '.js', __FILE__ ), [], '2.0.10', true );
			wp_register_style( 'photoswipe-default-skin', plugins_url( '/assets/photoswipe/default-skin/default-skin.css', __FILE__ ), [], '4.1.2' );
			wp_register_script( 'photoswipe-ui-default', plugins_url( '/assets/photoswipe/photoswipe-ui-default' . $_postfix . '.js', __FILE__ ), [], '2.0.10', true );
			wp_register_script( 'hogan-photoswipe', plugins_url( '/assets/js/hogan-photoswipe.js', __FILE__ ), [ 'photoswipe', 'photoswipe-ui-default' ], $_version, true );

			// Hogan gallery.
			wp_enqueue_style( 'hogan-gallery-slider', plugins_url( '/assets/css/hogan-gallery-slider.css', __FILE__ ), [ 'flickity', 'photoswipe', 'photoswipe-default-skin' ], $_version );
			wp_enqueue_script( 'hogan-gallery-slider', plugins_url( '/assets/js/hogan-gallery-slider.js', __FILE__ ), [ 'flickity', 'hogan-photoswipe' ], $_version, true );

			wp_enqueue_style( 'hogan-gallery-grid', plugins_url( '/assets/css/hogan-gallery-grid.css', __FILE__ ), [ 'photoswipe', 'photoswipe-default-skin' ], $_version );
			wp_enqueue_script( 'hogan-gallery-grid', plugins_url( '/assets/js/hogan-gallery-grid.js', __FILE__ ), [ 'hogan-photoswipe' ], $_version, true );

			wp_enqueue_style( 'hogan-gallery-masonry', plugins_url( '/assets/css/hogan-gallery-masonry.css', __FILE__ ), [ 'photoswipe', 'photoswipe-default-skin' ], $_version );
			wp_enqueue_script( 'hogan-gallery-masonry', plugins_url( '/assets/js/hogan-gallery-masonry.js', __FILE__ ), [ 'hogan-photoswipe' ], $_version, true );

			$options = [
				'sliderConfig'     => apply_filters(
					'hogan/module/gallery/slider/options', [
						'fullscreen' => true,
					]
				),
				'flickityConfig'   => apply_filters(
					'hogan/module/gallery/flickity', [
						'imagesLoaded' => true,
						'pageDots'     => false,
						'wrapAround'   => true,
					]
				),
				'photoswipeConfig' => apply_filters(
					'hogan/module/gallery/photoswipe', []
				),
			];

			wp_localize_script( 'hogan-gallery-slider', 'hoganGallery', $options );
		}

		/**
		 * Module wrapper classname.
		 *
		 * @param array  $classnames Wrapper classnames.
		 * @param Module $module Module.
		 * @return array Wrapper classnames.
		 */
		public function add_wrapper_classname( array $classnames, Module $module ) : array {
			if ( $module->name !== $this->name ) {
				return $classnames;
			}

			$classnames[] = 'hogan-gallery-layout-' . $module->layout;

			return $classnames;
		}

		/**
		 * Field definitions for module.
		 *
		 * @return array $fields Fields for this module
		 */
		public function get_fields() : array {

			/**
			 * Filters the choices for layouts in the Gallery module
			 *
			 * @param array $layouts Layouts.
			 */
			$layoyt_choices = apply_filters( 'hogan/module/gallery/layouts', [
				'slider'  => __( 'Slider', 'hogan-gallery' ),
				'grid'    => __( 'Grid', 'hogan-gallery' ),
				'masonry' => __( 'Masonry', 'hogan-gallery' ),
			] );

			$fields = [
				[
					'type'          => 'button_group',
					'key'           => $this->field_key . '_layout',
					'label'         => __( 'Layout', 'hogan-gallery' ),
					'name'          => 'layout',
					'instructions'  => __( 'Choose layout', 'hogan-gallery' ),
					'choices'       => $layoyt_choices,
					'allow_null'    => 0,
					'default_value' => 'slider',
					'layout'        => 'horizontal',
					'return_format' => 'value',
				],
				[
					'type'         => 'gallery',
					'key'          => $this->field_key . '_items',
					'name'         => 'items',
					'label'        => __( 'Gallery Items', 'hogan-gallery' ),
					'instructions' => __( 'Add gallery items using the Add to gallery button at the lower left. Items can be rearranged using drag-and-drop.', 'hogan-gallery' ),
				],
			];

			return $fields;
		}

		/**
		 * Map raw fields from acf to object variable.
		 *
		 * @param array $raw_content Content values.
		 * @param int   $counter Module location in page layout.
		 * @return void
		 */
		public function load_args_from_layout_content( array $raw_content, int $counter = 0 ) {

			$this->items  = $raw_content['items'];
			$this->layout = $raw_content['layout'];

			parent::load_args_from_layout_content( $raw_content, $counter );
		}

		/**
		 * Validate module content before template is loaded.
		 *
		 * @return bool Whether validation of the module is successful / filled with content.
		 */
		public function validate_args() : bool {
			return ! empty( $this->items );
		}
	}
}
