/**
 * Globals
 */
const {
	PhotoSwipe,
	PhotoSwipeUI_Default, // eslint-disable-line camelcase
} = window;

/**
 * Hogan photoswipe
 */
class HoganPhotoSwipe {
	constructor( gallery, config = {} ) {
		this.config = config;
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
			const caption = images[ i ].querySelector( '.hogan-gallery-caption' );

			const item = {
				src: linkEl.getAttribute( 'href' ),
				w: parseInt( size[ 0 ], 10 ),
				h: parseInt( size[ 1 ], 10 ),
			};

			if ( caption ) {
				item.title = caption.textContent;
			}

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
			...this.config,
			galleryUID: this.uid,
			index,
		} );

		gallery.init();
	}
}

// Make it public
window.hogan = window.hogan || {};
window.hogan.PhotoSwipe = HoganPhotoSwipe;
