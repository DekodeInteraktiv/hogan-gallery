<?php
/**
 * Gallery Module template
 *
 * $this is an instace of the Gallery object.
 *
 * Available properties:
 * $this->heading (string) Module heading.
 * $this->items (array) Gallery items.
 *
 * @package Hogan
 */

declare( strict_types = 1 );
namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) || ! ( $this instanceof Gallery ) ) {
	return; // Exit if accessed directly.
}

if ( ! empty( $this->heading ) ) {
	hogan_component( 'heading', [
		'title' => $this->heading,
	] );
}

$is_slider = 'slider' === $this->layout;

$classnames = hogan_classnames( [
	'hogan-gallery-carousel' => $is_slider,
	'hogan-gallery-grid'     => ! $is_slider,
] );

?>
<div class="<?php echo esc_attr( $classnames ); ?>">
	<?php foreach ( $this->items as $item ) : ?>
		<figure class="hogan-gallery-carousel-cell">
			<img
				src="<?php echo esc_attr( $item['url'] ); ?>"
				alt="<?php echo esc_attr( $item['alt'] ); ?>"
			/>
			<?php
			if ( ! empty( $item['caption'] ) ) {
				printf( '<figcaption>%s</figcaption',
					wp_kses( $item['caption'], [
						'br' => [],
					] )
				);
			}
			?>
		</figure>
	<?php endforeach; ?>
</div>
