<?php
/**
 * Gallery module class
 *
 * @package Hogan
 */

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
		 * Gallery heading
		 *
		 * @var string $heading
		 */
		public $heading;

		/**
		 * Gallery items
		 *
		 * @var string $items;
		 */
		public $items;

		/**
		 * Module constructor.
		 */
		public function __construct() {

			$this->label = __( 'Gallery', 'hogan-gallery' );
			$this->template = __DIR__ . '/template.php';

			parent::__construct();
		}

		/**
		 * Field definitions for module.
		 */
		public function get_fields() {

			$fields = [];

			// Heading field can be disabled using filter hogan/module/gallery/heading/enabled (true/false).
			hogan_append_heading_field( $fields, $this );

			$fields[] = [
				'type' => 'gallery',
				'key' => $this->field_key . '_items',
				'name' => 'items',
				'label' => __( 'Gallery Items', 'hogan-gallery' ),
				'instructions' => __( 'Add gallery items using the Add to gallery button at the lower left. Items can be rearranged using drag-and-drop.', 'hogan-gallery' ),
			];

			return $fields;
		}

		/**
		 * Map fields to object variable.
		 *
		 * @param array $content The content value.
		 */
		public function load_args_from_layout_content( $content ) {

			$this->heading = $content['heading'] ?? null;
			$this->items = $content['items'];

			parent::load_args_from_layout_content( $content );
		}

		/**
		 * Validate module content before template is loaded.
		 */
		public function validate_args() {
			return ! empty( $this->items );
		}
	}
}
