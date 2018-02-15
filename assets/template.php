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

$is_slider = 'slider' === $this->layout;

$classnames = hogan_classnames( [
	'hogan-gallery-carousel' => $is_slider,
	'hogan-gallery-grid'     => ! $is_slider,
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
			<?php
			printf( '<a class="hogan-gallery-item-link" href="%s" itemprop="contentUrl" aria-label="%s">',
				esc_url( $item['url'] ),
				esc_html__( 'Open image gallery', 'hogan-gallery' )
			);

			// If slider we only want a link in the top corner. Close the link before image.
			if ( $is_slider ) {
				echo '<svg viewBox="0 0 100 100" class="hogan-gallery-expand-icon"><path d="M90.9 84.5L56.4 50l34.5-34.5v17.8h9.1V0H66.7v9.1h17.8L50 43.6 15.5 9.1h17.8V0H0v33.3h9.1V15.5L43.6 50 9.1 84.5V66.7H0V100h33.3v-9.1H15.5L50 56.4l34.5 34.5H66.7v9.1H100V66.7h-9.1z"></path></svg>';
				echo '</a>';
			}

			echo wp_get_attachment_image(
				$item['id'],
				$is_slider ? 'large' : 'thumbnail',
				false,
				[ 'itemprop' => 'thumbnail' ]
			);

			// Close link (slider is already closed).
			if ( ! $is_slider ) {
				echo '</a>';
			}

			if ( ! empty( $item['caption'] ) ) {
				printf( '<figcaption class="%s" itemprop="caption description">%s</figcaption>',
					esc_attr( hogan_classnames( 'hogan-gallery-caption', [
						'screen-reader-text' => ! $is_slider,
					] ) ),
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
