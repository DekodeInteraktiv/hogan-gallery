<?php
/**
 * PhotoSwipe root element template.
 *
 * @package Hogan
 */

declare( strict_types = 1 );

?>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="pswp__bg"></div>

	<div class="pswp__scroll-wrap">
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>

		<div class="pswp__ui pswp__ui--hidden">
			<div class="pswp__top-bar">
				<div class="pswp__counter"></div>

				<button class="pswp__button pswp__button--close" title="<?php esc_attr_e( 'Close (Esc)', 'hogan-gallery' ); ?>">
					<span class="screen-reader-text"><?php esc_html_e( 'Close', 'hogan-gallery' ); ?></span>
				</button>
				<button class="pswp__button pswp__button--share" title="<?php esc_attr_e( 'Share', 'hogan-gallery' ); ?>">
					<span class="screen-reader-text"><?php esc_html_e( 'Share', 'hogan-gallery' ); ?></span>
				</button>
				<button class="pswp__button pswp__button--fs" title="<?php esc_attr_e( 'Toggle fullscreen', 'hogan-gallery' ); ?>">
					<span class="screen-reader-text"><?php esc_html_e( 'Toggle fullscreen', 'hogan-gallery' ); ?></span>
				</button>
				<button class="pswp__button pswp__button--zoom" title="<?php esc_attr_e( 'Zoom in/out', 'hogan-gallery' ); ?>">
					<span class="screen-reader-text"><?php esc_html_e( 'Zoom in/out', 'hogan-gallery' ); ?></span>
				</button>

				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div>
			</div>

			<button class="pswp__button pswp__button--arrow--left" title="<?php esc_attr_e( 'Previous (arrow left)', 'hogan-gallery' ); ?>">
				<span class="screen-reader-text"><?php esc_html_e( 'Previous', 'hogan-gallery' ); ?></span>
			</button>
			<button class="pswp__button pswp__button--arrow--right" title="<?php esc_attr_e( 'Next (arrow right)', 'hogan-gallery' ); ?>">
				<span class="screen-reader-text"><?php esc_html_e( 'Next', 'hogan-gallery' ); ?></span>
			</button>

			<div class="pswp__caption">
				<div class="pswp__caption__center"></div>
			</div>
		</div>
	</div>
</div>
