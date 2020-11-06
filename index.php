<?php
include('_includes/configuration.php');
include('_controllers/home.php');

if(!$lang){
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $url
$tokens = explode('/', $url);
$lang =  $tokens[sizeof($tokens)-1];
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Krailler</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" href="https://use.typekit.net/ubp0log.css">

        <script type="text/javascript" src="/js/vendor/jquery-1.12.3.min.js"></script>
        <script type="text/javascript" src="/js/vendor/velocity-min.js"></script>
        <script type="text/javascript" src="/js/vendor/velocity.ui-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js"></script>
      <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>-->
   

        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.velocity.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/plugins/ScrollToPlugin.min.js"></script>
        <script src="/js/vendor/modernizr.custom.js"></script>
        <script src="/js/vendor/parallax.min.js"></script>

    </head>
    <body id="page" class="<?php echo $lang ?>">
        <div id="nav-dot-wrapper" >
          <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
          </ul>
        </div>
        <div  <?php if($lang=='ar'){?>dir="rtl"<?php } ?> class="loading"><?php echo get_content('loading',$lang); ?><span>.</span><span>.</span><span>.</span></div>
        <div id="slideshow-wrapper">
          <ul id="krailler-slideshow" class="krailler-slideshow">

<?php
            if (isset($home->slideshowon) && $home->slideshowon == 1) { ?>
                   <?php for ($x=0;$x<sizeof($images);$x++) { ?>
                   <li>
                    <div class="img-wrapper">
                   <picture>
  <source type="image/webp" srcset="/img/slideshow/webp/<?php echo $images[$x]['id']; ?>.webp">
  <source type="image/jpeg" srcset="/img/slideshow/<?php echo $images[$x]['id']; ?>.jpg">
  <img src="/img/slideshow/<?php echo $images[$x]['id']; ?>.jpg">
</picture> </div>
                   </li>
                   <?php } ?>
            <?php }else{ ?>
              <div id="slideshow"> <img  src="img/slideshow/<?php echo $images[0]['id'] ?>.jpg"></div>
            <?php } ?>

          </ul>
          <div class="container">
               <div id="krailler-controls" class="krailler-controls">
                 <div class="btn-hover btn-container-prev"><span class="krailler-prev line-arrow square left"></span></div>
                <div class="logo-big-wrapper"><?php echo file_get_contents("img/logo-2.svg"); ?></div>
                <div id="strapline" class="strapline center-me"><?php echo get_content('master',$lang); ?><br /><b>LONDON</b></div>
                 <div class="btn-hover btn-container-next"><span class="krailler-next line-arrow square right"></span></div>
                 <a href="#about-us"><div id="scroll-indicator"><div class="bounce"><span class="line-arrow square bottom"></div></div></a>
               </div>
            </div>
          </div>

<div class="main-container">
  <article <?php if($lang=='ar'){?>dir="rtl"<?php } ?> id="about-us"  style="background-color:#52544D">
          <div id="about">
            <section id="about-section-1">
              <div class="two-col">
              <div id ="about-txt-1" class="txt">
              <p class="big"><?php echo get_content('block1',$lang); ?></p>
              <p><?php echo get_content('block2',$lang); ?> <?php echo get_content('block3',$lang); ?></p>
              </div>
            </div>
            <div class="two-col"><img id="about-img-1" src="/img/about2.jpg"></img></div>
            </section>
            <section id="about-section-2">
              <div class="two-col"><img id="about-img-2" src="/img/about/04.jpg"></img></div>
              <div class="two-col">
              <div id="about-txt-2" class="txt">
              <p class="big"><?php echo get_content('block4',$lang); ?></p><p><?php echo get_content('block5',$lang); ?> <?php echo get_content('block6',$lang); ?> <?php echo get_content('block7',$lang); ?></p>
              </div>
            </div>


            </section>
          </div>
    </article>
    <article <?php if($lang=='ar'){?>dir="rtl"<?php } ?> id="process">

      <div class="process-intro">
      <span><h1><?php echo get_content('process',$lang); ?></h1>
      <p class="pb-4"><?php echo get_content('processtxt',$lang); ?></p></span>
      </div>
      <div class="process-bg1 process-bg" style="height:80vh"></div>
      <div class="process-txt">
        <span><!--<div class="num-circle">1</div>-->
      <p><?php echo get_content('block8',$lang); ?></p></span>
      </div>
      <div class="process-bg2 process-bg"></div>
      <div class="process-txt">
        <span><!--<div class="num-circle">2</div>-->
        <p><?php echo get_content('block9',$lang); ?></p></span>
      </div>
      <div class="process-bg3 process-bg"></div>
      <div class="process-txt">
        <span><!--<div class="num-circle">3</div>-->
        <p><?php echo get_content('block10',$lang); ?> <?php echo get_content('block11',$lang); ?></p></span>
      </div>
      <div class="process-bg4 process-bg"></div>
      <div class="process-txt">
        <span><!--<div class="num-circle">4</div>-->
        <p><?php echo get_content('block12',$lang); ?> <?php echo get_content('block13',$lang); ?></p></span>
      </div>
      <div class="process-bg5 process-bg" style="height:100vh"></div>
    </article>
    <article id="contact-us" class="slide">
        <div class="bcg"></div>


        <div id="contact">
          <div>
                  <div class="vcard mb-2">

                  <p class="adr">
                  <span class="country-name"><?php echo nl2br(get_content('country',$lang)); ?></span>
                  </p>
                  </div>

                  <label for="modal-1">
                    <div class="modal-trigger btn"><?php echo get_content('contact',$lang); ?></div>
                  </label>
                  </button>
            </div>

        </div> <!-- .wrapper -->

    </article>
    <article id="credits" class="slide" >
      <div class="bcg"></div>

          <div <?php if($lang=='ar'){?>dir="rtl"<?php } ?> class="center-me" style="z-index:999;width:100%">
          <ul>
            <li>
              <h2><?php echo get_content('design',$lang); ?></h2>
              <ul class="mb-3">
                <li class="mb-1">Juergen Krailler</li>
                <li>5mm Ltd</li>
                <li>Cocovara Interiors Ltd</li>
                <li>DKT Artworks Ltd</li>
                <li>Form Design Architecture Ltd</li>
                <li>Helen Green Design Ltd</li>
                <li>Katharine Pooley Ltd</li>
                <li>Laura Hammett Ltd</li>
                <li>Staffan Tollgard Ltd</li>
                <li>Vallgren Design Ltd</li>
              </ul>
            </li>
            <li>
              <h2><?php echo get_content('photo',$lang); ?></h2>
              <ul class="mb-3">
                <li>David Still Photography</li>
                <li>Erameri Ltd</li>
                <li>Nick Smith Photography</li>
                <li>Patrick Steel Photography</li>
              </ul>
            </li>
            <li>
              <h2><?php echo get_content('website',$lang); ?></h2>
              <ul class="mb-3">
                <li><?php echo get_content('produced',$lang); ?> Gerrie Villon</li>
                <li><a href="http://www.domh.net" target="_blank"><?php echo get_content('created',$lang); ?> Lloyd Thomas</a></li>
              </ul>
            </li>
          </ul>

        </div>

    </article>


</div> <!-- #main-container -->
<footer>
  <div class="inner">
    <div class="float-left">&copy;<?php echo date('Y'); ?> Krailler Ltd. <?php echo get_content('copyright',$lang); ?>.</div>
    <div class="float-right legal-links"><a href="https://www.instagram.com/kraillerlondon/" target="_blank"><div class="footer-link instagram-logo">Instagram</div></a><div class="footer-link"><label for="modal-2"><div class="modal-trigger show-pointer"><?php echo get_content('terms',$lang); ?></div></label></div><div class="footer-link show-pointer" id="credits-link"><?php echo get_content('credits',$lang); ?></div></div>

  <div class="modal">
  <input class="modal-state" id="modal-1" type="checkbox" />
  <div class="modal-fade-screen">
    <div class="modal-inner" <?php if($lang=='ar'){?>dir="rtl"<?php } ?>>
      <div class="modal-close" for="modal-1"></div>
      <h1  <?php if($lang=='ar'){?>style="text-align:right"<?php } ?> ><?php echo get_content('contact',$lang); ?></h1>
      <div id="contact-response"></div>
      <div id="contact-form">
      <form id="contactsubmit" method="post">
        <ul class="auto-col-2">
          <?php if($lang=='ar'){ ?>
            <li class="block" dir="rtl">
              <label for="message"><?php echo get_content('message',$lang); ?></label>
              <textarea name="message" cols="30" rows="5"></textarea>
              <input type="submit" value="<?php echo get_content('submit',$lang); ?>">
            </li>
            <li class="block" dir="rtl" style="text-align:right">
              <label for="name">Name</label>
              <input type="text" id="name" name="name">
              <label for="email">Email</label>
              <input type="text" id="email" name="email">
              <label for="telephone"><?php echo get_content('phone',$lang); ?></label>
              <input type="text" id="telephone" name="telephone">
            </li>
          <?php }else{ ?>
            <li class="block">
              <label for="name">Name</label>
              <input type="text" id="name" name="name">
              <label for="email">Email</label>
              <input type="text" id="email" name="email">
              <label for="telephone"><?php echo get_content('phone',$lang); ?></label>
              <input type="text" id="telephone" name="telephone">
            </li>
            <li class="block">
              <label for="message"><?php echo get_content('message',$lang); ?></label>
              <textarea name="message" cols="30" rows="5"></textarea>
              <input type="submit" value="<?php echo get_content('submit',$lang); ?>">
            </li>
          <?php } ?>
          </ul>
        </form>
      </div>

  </div>
</div>

  </div>
  <div class="modal">
  <input class="modal-state" id="modal-2" type="checkbox" />
  <div class="modal-fade-screen">
    <div class="modal-inner">
      <div class="modal-close" for="modal-2"></div>
      <h1><?php echo get_content('terms',$lang); ?></h1>
      <?php include('_includes/terms.php') ?>
  </div>
</div>
</div>

</footer>
        <div id="lang-options">
          <div><?php echo get_content('lang',$lang); ?>:</div>
          <ul>
<?php for ($x=0;$x<sizeof($langs);$x++) { ?>
<?php if ($langs[$x]['iso'] == '中文' || $langs[$x]['id'] == 134) { ?>
            <li id="zh" class="lang-selector<?php if ($lang == $langs[$x]['iso']) echo " selected"?>"><?php echo strtoupper($langs[$x]['iso']); ?></li>
<?php } else if ($langs[$x]['iso'] == 'عربي' || $langs[$x]['id'] == 6) { ?>
            <li id="ar" class="lang-selector<?php if ($lang == $langs[$x]['iso']) echo " selected"?>"><?php echo strtoupper($langs[$x]['iso']); ?></li>
<?php } else { ?>
            <li id="<?php echo $langs[$x]['iso']; ?>" class="lang-selector<?php if ($lang == $langs[$x]['iso']) echo " selected"?>"><?php echo strtoupper($langs[$x]['iso']); ?></li>
<?php } ?>
<?php } ?>
          </ul>
        </div>
        <div class="logo-default-pos">
          <div class="logo-wrapper" id="logo"><?php include('img/logo.svg') ?></div>
        </div>
        <div id="mobile-menu-toggle"><div class="burger-menu-icon"></div></div>
        <div id="nav-wrapper">
          <nav>
            <ul class="main">
              <li><a href="#krailler-slideshow"><?php echo get_content('slideshow',$lang); ?></a></li>
              <li><a href="#about-us"><?php echo get_content('about',$lang); ?></a></li>
              <li><a href="#process"><?php echo get_content('process',$lang); ?></a></li>
              <li><a href="#contact"><?php echo get_content('contact',$lang); ?></a></li>
            </ul>
            <div id="lang-options-mobile">
              <div>Languages</div>
              <?php for ($x=0;$x<sizeof($langs);$x++) { ?>
              <?php if ($langs[$x]['iso'] == '中文' || $langs[$x]['id'] == 134) { ?>
                          <li id="zh" class="lang-selector<?php if ($lang == $langs[$x]['iso']) echo " selected"?>"><?php echo strtoupper($langs[$x]['iso']); ?></li>
              <?php } else if ($langs[$x]['iso'] == 'عربي' || $langs[$x]['id'] == 6) { ?>
                          <li id="ar" class="lang-selector<?php if ($lang == $langs[$x]['iso']) echo " selected"?>"><?php echo strtoupper($langs[$x]['iso']); ?></li>
              <?php } else { ?>
                          <li id="<?php echo $langs[$x]['iso']; ?>" class="lang-selector<?php if ($lang == $langs[$x]['iso']) echo " selected"?>"><?php echo strtoupper($langs[$x]['iso']); ?></li>
              <?php } ?>
              <?php } ?>
            </div>
          </nav>
        </div>

    </body>
    <script type="text/javascript" src="/js/vendor/jquery.imagesloaded.min.js"></script>
    <script type="text/javascript" src="/js/kraillerSlideshow-min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/scrollm.js"></script>

    <script>
    $(document).ready(function(){

    $('.lang-selector').click(function () {
      var lang = $(this).attr('id');
      var url = '/home/'+lang;
      //alert(lang+url);
      window.location = url;
      //window.location.href = url;
      //window.location.reload(true);
    })

    $('#credits-link').click(function(){
      $('#credits')
      .velocity("fadeIn")
      .velocity("scroll", { duration: 1500, easing: "easeInSine" });

    })

    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }


    $("#contactsubmit").submit(function(e) {
      var error = 0;
      $(":text, :file, :checkbox, select, textarea").each(function() {
        if($(this).val() === "") {
          $('#contact-response').html("<span>Please fill in all fields</span>");
          error = 1;
        }
      });
      if (!isEmail($('#email').val())) {
        $('#contact-response').html("<span>Please enter a valid email address</span>");
        error = 1
      }

      if (error === 0) {
      var url = "/_includes/post.php";
      $.ajax({
       type: "POST",
       url: url,
       data: $("#contactsubmit").serialize(),
       success: function(data) {
           $('#contact-response').html(data);
           var delay = 2000;
            setTimeout(function() {
             $(".modal-state:checked").prop("checked", false).change();
            }, delay);

       }});
      }
      e.preventDefault();
    });

    $('#mobile-menu-toggle').click(function(){
      $('#mobile-menu-toggle').velocity('fadeOut');
      $('nav').velocity(
        'fadeIn',
        {
          complete:function(){
            $('nav').click(function(){
              $(this).css('display','none');
              $('#mobile-menu-toggle')
                .velocity('stop')
                .velocity('fadeIn');
            })
          }
        }
      );
    })
    $('#process .process-bg1').parallax({
      imageSrc: '/img/process/05_new.jpg',
      speed: 0.75
    });
    $('#process .process-bg2').parallax({
        imageSrc: '/img/process/jigsaw.jpg'
    });
    $('#process .process-bg3').parallax({
      imageSrc: '/img/process/plans3.jpg'
    });
    $('#process .process-bg4').parallax({
      imageSrc: '/img/process/wood.jpg'
    });
    $('#process .process-bg5').parallax({
        imageSrc: '/img/process/upholstery.jpg',
        speed: 0.75
    });


    });
    </script>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-13174307-2', 'auto');
  ga('send', 'pageview');

  </script>


</html>
