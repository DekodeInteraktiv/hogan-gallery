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
window.onload = () => {
	const sliders = document.querySelectorAll('.hogan-gallery-carousel');

	Array.prototype.slice.call(sliders).forEach(slider => {
		new Flickity(slider, hoganGallery.flickityConfig); // eslint-disable-line no-new

		if (slider.hasAttribute('data-pswp-uid')) {
			new window.hogan.PhotoSwipe(slider, hoganGallery.photoswipeConfig); // eslint-disable-line no-new
		}
	});
}

