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

?>

<?php if ( ! empty( $this->heading ) ) : ?>
	<h2 class="heading"><?php echo esc_html( $this->heading ); ?></h2>
<?php endif; ?>

<ul class="items">
	<?php foreach ( $this->items as $item ) : ?>
		<li class="item">
			<figure>
				<a href="<?php echo esc_url( $item['url'] ); ?>" data-size="<?php echo esc_attr( $item['width'] . 'x' . $item['height'] ); ?>">
					<img
						src="<?php echo esc_attr( $item['sizes'][ apply_filters( 'hogan/module/gallery/image_size', 'thumbnail' ) ] ); ?>"
						alt="<?php echo esc_attr( $item['alt'] ); ?>"
					/>
				</a>

				<?php if ( ! empty( $item['caption'] ) ) : ?>
					<figcaption><?php echo wp_kses_post( $item['caption'] ); ?></figcaption>
				<?php endif; ?>
			</figure>
		</li>
	<?php endforeach; ?>
</ul>
