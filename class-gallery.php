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

			parent::__construct();
		}

		/**
		 * Field definitions for module.
		 *
		 * @return array $fields Fields for this module
		 */
		public function get_fields() : array {

			$fields = [];

			// Heading field can be disabled using filter hogan/module/gallery/heading/enabled (true/false).
			hogan_append_heading_field( $fields, $this );

			$fields[] = [
				'type'          => 'button_group',
				'key'           => $this->field_key . '_layout',
				'label'         => __( 'Layout', 'hogan-gallery' ),
				'name'          => 'layout',
				'instructions'  => __( 'Choose layout', 'hogan-gallery' ),
				'choices'       => [
					'slider' => __( 'Slider', 'hogan-gallery' ),
					'grid'   => __( 'Grid', 'hogan-gallery' ),
				],
				'allow_null'    => 0,
				'default_value' => 'slider',
				'layout'        => 'horizontal',
				'return_format' => 'value',
			];

			$fields[] = [
				'type'         => 'gallery',
				'key'          => $this->field_key . '_items',
				'name'         => 'items',
				'label'        => __( 'Gallery Items', 'hogan-gallery' ),
				'instructions' => __( 'Add gallery items using the Add to gallery button at the lower left. Items can be rearranged using drag-and-drop.', 'hogan-gallery' ),
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

			$this->items = $raw_content['items'];

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
