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

$classnames = hogan_classnames( [
	'hogan-gallery-carousel' => 'slider' === $this->layout,
	'hogan-gallery-grid'     => 'grid' === $this->layout,
] );

?>
<div class="<?php echo esc_attr( $classnames ); ?>" itemscope itemtype="http://schema.org/ImageGallery" data-pswp-uid="<?php echo esc_attr( $this->counter ); ?>">
	<?php
	$index = 0;

	foreach ( $this->items as $item ) :
		?>
		<figure
			class="hogan-gallery-cell"
			itemprop="associatedMedia"
			itemscope
			itemtype="http://schema.org/ImageObject"
			data-pswp-index="<?php echo esc_attr( $index ); ?>"
			data-pswp-size="<?php echo esc_attr( $item['width'] . 'x' . $item['height'] ); ?>"
		>
			<a class="hogan-gallery-item-link" href="<?php echo esc_url( $item['url'] ); ?>" itemprop="contentUrl">
				Open
			</a>
			<?php
			echo wp_get_attachment_image(
				$item['id'],
				'slider' === $this->layout ? 'large' : 'thumbnail',
				false,
				[ 'itemprop' => 'thumbnail' ]
			);

			if ( ! empty( $item['caption'] ) ) {
				printf( '<figcaption itemprop="caption description">%s</figcaption',
					wp_kses( $item['caption'], [
						'br' => [],
					] )
				);
			}
			?>
		</figure>
		<?php
		$index++;
	endforeach;
	?>
</div>
