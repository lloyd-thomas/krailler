var kraillerSlideshow = (function() {

    var $slideshow = $('#krailler-slideshow'),
        $items = $slideshow.children('li'),
        itemsCount = $items.length,
        $controls = $('#krailler-controls'),
        navigation = {
            $navPrev: $controls.find('.btn-container-prev'),
            $navNext: $controls.find('.btn-container-next'),
            $navPlayPause: $controls.find('span.krailler-pause')
        },
        // current item´s index
        current = 0,
        // timeout
        slideshowtime,
        // true if the slideshow is active
        isSlideshowActive = true,

        interval = 6000;

    function init(config) {

        // preload the images
        $slideshow.imagesLoaded(function() {

            /*
            if (Modernizr.backgroundsize) {
                $items.each(function() {
                    var $item = $(this);
                    $item.css('background-image', 'url(' + $item.find('picture').attr('src') + ')');
                });
            } else {
                $slideshow.find('img').show();
                // for older browsers add fallback here (image size and centering)
            }
			// show first item
			*/
            initEvents();




            // on complete
            //fade in 1st image
            $items.eq(0).velocity({ opacity: 1 }, {
                duration: 2000,
                delay: 2000,
                complete: function() {
                    //delay
                    $('.loading').velocity('fadeOut');
                    $('.logo-big-wrapper').velocity(
                        //fade out logo-big-wrapper
                        'fadeOut', {
                            duration: 2000,
                            delay: 1000,
                            complete: function() {
                                // fade in 2nd image
                                current = 0;
                                startSlideshow(true);

                                $('.logo-default-pos').velocity('fadeIn');
                                $('.btn-hover').css('display', 'block');
                                $('.btn-container-next').css('display', 'block');
                                $('.btn-container-prev').css('display', 'block');
                                //	$('.krailler-next').velocity('fadeIn');
                                $('#scroll-indicator').velocity('fadeIn');
                                // fade out 1st image
                                $items.eq(0).velocity({ opacity: 0 }, { duration: 2000 });
                            }
                        }
                    )
                }
            })
        });

    }

    function initEvents() {

        navigation.$navPlayPause.on('click', function() {

            var $control = $(this);
            if ($control.hasClass('krailler-play')) {
                //	$control.removeClass( 'krailler-play' ).addClass( 'krailler-pause' );
                startSlideshow();
            } else {
                //$control.removeClass( 'krailler-pause' ).addClass( 'krailler-play' );
                stopSlideshow();
            }

        });

        navigation.$navPrev.on('click', function() {
            navigate('prev', 0);
            if (isSlideshowActive) {
                startSlideshow();
            }
        });
        navigation.$navNext.on('click', function() {
            navigate('next', 0);
            if (isSlideshowActive) {
                startSlideshow();
            }
        });

    }

    function navigate(direction, $speed) {
        // current item
        var $oldItem = $items.eq(current);

        if (direction === 'next') {
            current = current < itemsCount - 1 ? ++current : 0;
        } else if (direction === 'prev') {
            current = current > 0 ? --current : itemsCount - 1;
        }

        // new item
        var $newItem = $items.eq(current);


        /*
        			var $resizeItem = $items.eq(current-2);
        			$resizeItem.velocity({
        					opacity:0;
        			})
        			console.log(current-2);*/
        //	$newItem.css('-webkit-transform': scale(1));
        // show / hide items
        $oldItem.velocity({
            opacity: 0
        }, { duration: $speed });


        $newItem.velocity({
            opacity: 1
        }, { duration: $speed });

    }

    function startSlideshow(firstSlide) {

        isSlideshowActive = true;
        clearTimeout(slideshowtime);

        if (firstSlide == true) {
            slideshowtime = setTimeout(function() {
                navigate('next', '2000');
                startSlideshow();
            }, 100);
            firstSlide = false;
        } else {
            slideshowtime = setTimeout(function() {
                navigate('next', '4000');
                startSlideshow();

            }, interval);
        }


    }

    function stopSlideshow() {
        isSlideshowActive = false;
        clearTimeout(slideshowtime);
    }

    return { init: init };

})();