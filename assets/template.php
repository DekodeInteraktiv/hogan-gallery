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

?>
<div class="items" itemscope itemtype="http://schema.org/ImageGallery">
	<?php foreach ( $this->items as $item ) : ?>
		<figure class="item" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
			<a href="<?php echo esc_url( $item['url'] ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $item['width'] . 'x' . $item['height'] ); ?>">
				<img src="<?php echo esc_attr( $item['sizes'][ apply_filters( 'hogan/module/gallery/image_size', 'thumbnail' ) ] ); ?>" itemprop="thumbnail" alt="<?php echo esc_attr( $item['alt'] ); ?>"/>
			</a>
			<?php if ( ! empty( $item['caption'] ) ) : ?>
				<figcaption itemprop="caption description"><?php echo wp_kses_post( $item['caption'] ); ?></figcaption>
			<?php endif; ?>
		</figure>
	<?php endforeach; ?>
</div>
