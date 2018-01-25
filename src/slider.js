/**
 * Globals
 */
const {
	Flickity,
	hoganGallery,
	PhotoSwipe,
	PhotoSwipeUI_Default, // eslint-disable-line camelcase
} = window;

/**
 * Hogan slider
 */
const sliders = document.querySelectorAll( '.hogan-gallery-carousel' );

class HoganPhotoSwipe {
	constructor( gallery ) {
		this.gallery = gallery;

		this.uid = this.gallery.getAttribute( 'data-pswp-uid' );
		this.items = this.getItems();

		this.handleClick = this.handleClick.bind( this );

		gallery.addEventListener( 'click', this.handleClick );
	}

	getItems() {
		const images = this.gallery.querySelectorAll( '.hogan-gallery-cell' );
		const items = [];

		for ( let i = 0; i < images.length; i++ ) {
			const linkEl = images[ i ].querySelector( '.hogan-gallery-item-link' );
			const size = images[ i ].getAttribute( 'data-pswp-size' ).split( 'x' );

			const item = {
				src: linkEl.getAttribute( 'href' ),
				w: parseInt( size[ 0 ], 10 ),
				h: parseInt( size[ 1 ], 10 ),
			};

			items.push( item );
		}

		return items;
	}

	getClosest( element, fn ) {
		return element && ( fn( element ) ? element : this.getClosest( element.parentNode, fn ) );
	}

	handleClick( event ) {
		event = event || window.event;

		const target = event.target;

		const clickedLink = this.getClosest( target, element => {
			return ( element.tagName && element.tagName.toUpperCase() === 'A' );
		} );

		if ( ! clickedLink ) {
			return;
		}

		const clickedItem = this.getClosest( clickedLink, element => {
			return ( element.tagName && element.tagName.toUpperCase() === 'FIGURE' );
		} );

		if ( ! clickedItem ) {
			return;
		}

		event.preventDefault();

		const index = parseInt( clickedItem.getAttribute( 'data-pswp-index' ), 10 );
		this.open( index );
	}

	open( index ) {
		const template = document.querySelector( '.pswp' );

		// Pass data to PhotoSwipe and initialize it
		const gallery = new PhotoSwipe( template, PhotoSwipeUI_Default, this.items, {
			...hoganGallery.photoswipeConfig,
			galleryUID: this.uid,
			index,
		} );

		gallery.init();
	}
}

Array.prototype.slice.call( sliders ).forEach( slider => {
	new Flickity( slider, hoganGallery.flickityConfig ); // eslint-disable-line no-new

	if ( slider.hasAttribute( 'data-pswp-uid' ) ) {
		new HoganPhotoSwipe( slider ); // eslint-disable-line no-new
	}
} );
