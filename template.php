<?php
/**
 * Template for gallery module
 *
 * $this is an instace of the Gallery object. Ex. use: $this->content to output content value.
 *
 * @package Hogan
 */

namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) || ! ( $this instanceof Gallery ) ) {
	return; // Exit if accessed directly.
}

?>

<?php if ( ! empty( $this->heading ) ) : ?>
	<h1 class="heading"><?php echo esc_html( $this->heading ); ?></h1>
<?php endif; ?>

<ul class="items">
	<?php foreach ( $this->items as $item ) : ?>
		<li>
			<figure>
				<a href="<?php echo esc_url( $item['url'] ); ?>">
					<img src="<?php echo esc_attr( $item['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" />
				</a>

				<?php if ( ! empty( $item['caption'] ) ) : ?>
					<figcaption><?php echo wp_kses_post( $item['caption'] ); ?></figcaption>
				<?php endif; ?>
			</figure>
		</li>
	<?php endforeach; ?>
</ul>
