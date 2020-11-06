// ---- ONLOAD EVENTS -------------------------------------------------------------------

$(function() {

  loadContent(location.pathname);

});

// ---- EVENTS ------------------------------------------------------------------------

$('#wrapper').on('click', '.internal', function(e) {
  $("#loading").show();
  href = $(this).attr("href");
  loadContent(href);
  history.pushState('', 'New URL: '+href, href);
  e.preventDefault();
});

// ---- FUNCTIONS ------------------------------------------------------------------------

function loadContent(url) {
  $("#loading").fadeIn();
  $.ajax({
    url: "/_includes/content.php",
    cache: false,
    type: "POST",
    data: {cid: url}})
  .done(function(html,status,request) {
    $("#loading").hide();
    $('#maincontent').fadeOut('fast', function () { $('#maincontent').html(html).fadeIn('fast') });
    $('#maincontent').css('position','relative');
    $('#maincontent').css('z-index','0');
    var imgheight = $('.banner_img').height();
    $(".banners").height(imgheight);
    setPageTitle(request.getResponseHeader("pageTitle"));
    $("#loading").hide();
    });
}

function setPageTitle(string) {
  $('title').html(string);
}
