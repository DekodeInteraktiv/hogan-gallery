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
		this.getThumbBoundsFn = this.getThumbBoundsFn.bind( this );

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
				item.title = caption.innerHTML;
			}

			item.el = images[ i ];
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

	getThumbBoundsFn( index ) {
		const thumbnail = this.items[ index ].el.getElementsByTagName( 'img' )[ 0 ];
		const pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
		const rect = thumbnail.getBoundingClientRect();

		return {
			x: rect.left,
			y: rect.top + pageYScroll,
			w: rect.width,
		};
	}

	open( index ) {
		const template = document.querySelector( '.pswp' );

		const config = {
			...this.config,
			galleryUID: this.uid,
			index,
		};

		if ( 0 !== config.showAnimationDuration ) {
			config.getThumbBoundsFn = this.getThumbBoundsFn;
		}

		// Pass data to PhotoSwipe and initialize it
		const gallery = new PhotoSwipe( template, PhotoSwipeUI_Default, this.items, config );

		gallery.init();
	}
}

// Make it public
window.hogan = window.hogan || {};
window.hogan.PhotoSwipe = HoganPhotoSwipe;
