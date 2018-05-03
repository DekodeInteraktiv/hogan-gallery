/**
 * Globals
 */
const {
	hoganGallery,
} = window;

/**
 * Hogan grid galleries
 */
const galleries = document.querySelectorAll( '.hogan-gallery-masnory' );

Array.prototype.slice.call( galleries ).forEach( gallery => {
	if ( gallery.hasAttribute( 'data-pswp-uid' ) ) {
		new window.hogan.PhotoSwipe( gallery, hoganGallery.photoswipeConfig ); // eslint-disable-line no-new
	}
} );
