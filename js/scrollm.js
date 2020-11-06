(function ($) {

	// Init ScrollMagic
  var controller = new ScrollMagic.Controller();
  var controller2 = new ScrollMagic.Controller({
  globalSceneOptions: {
    triggerHook: 'onLeave'
     }
  })

    // get all slides
	var slides = ["#slide01","#slide02","#slide04"];


  function getHeight(div){
    return $(div).height();
  }

	// Enable ScrollMagic only for desktop, disable on touch and mobile devices
	if (!Modernizr.touch) {

      var slide0 = '#krailler-slideshow',
          slide1 = '#about-us',
          slide2 = '#process',
          slide3 = '#contact-us'
          slide4 = '#credits';



      var slideshowScene = new ScrollMagic.Scene({
            triggerElement: slide0,
            triggerHook: 1,
            duration: getHeight(slide1)
        })

        //.addIndicators()
        .setClassToggle('#nav-dot-wrapper li:first-child','active')
        .addTo(controller);

      //about us scenes
      /////////////////
      /////////////////


    var paboutScene1 = new ScrollMagic.Scene({
          triggerElement: slide1,
          triggerHook: 1,
          duration: getHeight(slide1)
      })
      .setClassToggle('#nav-dot-wrapper li:nth-child(2)','active')
      .addTo(controller2);


      var aboutTimeline01 = new TimelineMax();

      aboutTimeline01
        .to($('#about-img-1'),1, {autoAlpha: 1,  ease:Power0.easeNone})


      var aboutScene01 = new ScrollMagic.Scene({
            triggerElement: '#about-section-1',
            triggerHook: 1,
            duration: '100%'
        })

        .setTween(aboutTimeline01)
        .addTo(controller);

      var aboutTimeline02 = new TimelineMax();

      aboutTimeline02
        .to($('#about-img-1'),1, {autoAlpha: 0, ease:Power0.easeNone})
        .to($('#about-img-2'),1, {autoAlpha:1, ease:Power0.easeNone},0)

        var aboutScene02 = new ScrollMagic.Scene({
              triggerElement: '#about-section-2',
              triggerHook: 1,
              duration: '100%'
          })
            //.addIndicators() // add indicators (requires plugin)
          .setTween(aboutTimeline02)
          .addTo(controller);



      var processScene1 = new ScrollMagic.Scene({
            triggerElement: slide2,
            triggerHook: 1,
            duration: getHeight(slide2)
        })

        .setClassToggle('#nav-dot-wrapper li:nth-child(3)','active')
        .addTo(controller);

      var burgerChange = new ScrollMagic.Scene({
          triggerElement: slide2,
          triggerHook: 1,
          duration: getHeight(slide2)
      })
      .setClassToggle(".burger-menu-icon", "menu-color-change")
      .addTo(controller);

      var timeline = new TimelineMax()
    //  .add(TweenMax.to("nav", 0.5, {y:-23}))
      .add(TweenMax.to("#nav-wrapper", 0.5, {backgroundColor: "rgba(0,0,0,.2)"}));


      var minifyNavScene = new ScrollMagic.Scene({
        triggerElement: ".main-container"
      })

			.setVelocity("#logo", {opacity: 0}, {duration: 100})
      .setTween(timeline) // trigger a TweenMax.to tween
  //    .addIndicators() // add indicators (requires plugin)
			.addTo(controller);

      var langTimeline = new TimelineMax()
     .add(TweenMax.to("#lang-options", 0.5, {y:58}))

      var langScene = new ScrollMagic.Scene({
          triggerElement: slide1
      })
      .setTween(langTimeline)
      .setPin('#lang-options')
    //  .addIndicators() // add indicators (requires plugin)
      .addTo(controller2);


      var contactScene = new ScrollMagic.Scene({
          triggerElement: slide3
          //duration: "100%"
      })
      .setClassToggle('#nav-dot-wrapper li:nth-child(4)','active')
      .addTo(controller);



      var footerTimeline = new TimelineMax()
    //  .add(TweenMax.to("#contact", 0.25, {y:-100}))
      .add(TweenMax.to("#nav-dot-wrapper", 0.5, {y:-180}));

      var footerFix = new ScrollMagic.Scene({
        triggerElement: slide3
      })
    //  .addIndicators()
      //.setPin(slide3)
      .setTween(footerTimeline)
      .addTo(controller2);

    // change behaviour of controller to animate scroll instead of jump
		controller.scrollTo(function (newpos) {
			TweenMax.to(window, 1, {scrollTo: {y: newpos}, ease:Power1.easeInOut});
		});

		//  bind scroll to anchor links
		$(document).on("click", "a[href^='#']", function (e) {
			var id = $(this).attr("href");
			if ($(id).length > 0) {
				e.preventDefault();

				// trigger scroll
				controller.scrollTo(id);

					// if supported by the browser we can even update the URL.
				if (window.history && window.history.pushState) {
					history.pushState("", document.title, id);
				}
			}
		});

	}

}(jQuery));
