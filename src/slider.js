/**
 * Globals
 */
const {
	Flickity,
	hoganGallery,
} = window;

/**
 * Hogan slider
 */
const sliders = document.querySelectorAll( '.hogan-gallery-carousel' );

Array.prototype.slice.call( sliders ).forEach( slider => {
	new Flickity( slider, hoganGallery.flickityConfig ); // eslint-disable-line no-new
} );
