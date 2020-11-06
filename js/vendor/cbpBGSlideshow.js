var cbpBGSlideshow = (function() {

	var $slideshow = $( '#cbp-bislideshow' ),
		$items = $slideshow.children( 'li' ),
		itemsCount = $items.length,
		$controls = $( '#cbp-bicontrols' ),
		navigation = {
			$navPrev : $controls.find( 'span.cbp-biprev' ),
			$navNext : $controls.find( 'span.cbp-binext' ),
			$navPlayPause : $controls.find( 'span.cbp-bipause' )
		},
		// current item´s index
		current = 0,
		// timeout
		slideshowtime,
		// true if the slideshow is active
		isSlideshowActive = true,
		// it takes 3.5 seconds to change the background image
		interval = 3500;

	function init( config ) {

		// preload the images
		$slideshow.imagesLoaded( function() {

			if( Modernizr.backgroundsize ) {
				$items.each( function() {
					var $item = $( this );
					$item.css( 'background-image', 'url(' + $item.find( 'img' ).attr( 'src' ) + ')' );
				} );
			}
			else {
				$slideshow.find( 'img' ).show();
				// for older browsers add fallback here (image size and centering)
			}
			// show first item
			$items.eq( current ).velocity({
				opacity:1,
				scaleX:1.2,
				scaleY:1.2
			});
			// initialize/bind the events
			initEvents();
			// start the slideshow
			startSlideshow();

		} );

	}

	function initEvents() {

		navigation.$navPlayPause.on( 'click', function() {

			var $control = $( this );
			if( $control.hasClass( 'cbp-biplay' ) ) {
			//	$control.removeClass( 'cbp-biplay' ).addClass( 'cbp-bipause' );
				startSlideshow();
			}
			else {
				//$control.removeClass( 'cbp-bipause' ).addClass( 'cbp-biplay' );
				stopSlideshow();
			}

		} );

		navigation.$navPrev.on( 'click', function() {
			navigate( 'prev' );
			if( isSlideshowActive ) {
				startSlideshow();
			}
		} );
		navigation.$navNext.on( 'click', function() {
			navigate( 'next' );
			if( isSlideshowActive ) {
				startSlideshow();
			}
		} );

	}

	function navigate( direction ) {
		// current item
		var $oldItem = $items.eq( current );

		if( direction === 'next' ) {
			current = current < itemsCount - 1 ? ++current : 0;
		}
		else if( direction === 'prev' ) {
			current = current > 0 ? --current : itemsCount - 1;
		}

		// new item
		var $newItem = $items.eq( current );



			var $resizeItem = $items.eq(current-2);
			$resizeItem.velocity({
				scaleX:1,
				scaleY:1
			})
			console.log(current-2);
	//	$newItem.css('-webkit-transform': scale(1));
		// show / hide items
		$oldItem.velocity({
			opacity:0,

		});
		$newItem.velocity({
			opacity:1,
			scaleX:1.1,
			scaleY:1.1,
		});

	}

	function startSlideshow() {

		isSlideshowActive = true;
		clearTimeout( slideshowtime );
		slideshowtime = setTimeout( function() {
			navigate( 'next' );
			startSlideshow();
		}, interval );

	}

	function stopSlideshow() {
		isSlideshowActive = false;
		clearTimeout( slideshowtime );
	}

	return { init : init };

})();
