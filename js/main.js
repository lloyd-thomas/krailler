



// ---- FUNCTIONS ------------------------------------------------------------------------





function setPageTitle(string) {
  $('title').html(string);
}


$(function() {

kraillerSlideshow.init();

$("#modal-1").on("change", function() {
if ($(this).is(":checked")) {
  $("body").addClass("modal-open");
} else {
  $("body").removeClass("modal-open");
}
});

$("#modal-2").on("change", function() {
if ($(this).is(":checked")) {
  $("body").addClass("modal-open");
} else {
  $("body").removeClass("modal-open");
}
});

$("#modal-3").on("change", function() {
if ($(this).is(":checked")) {
  $("body").addClass("modal-open");
} else {
  $("body").removeClass("modal-open");
}
});


$(".modal-fade-screen, .modal-close").on("click", function() {
$(".modal-state:checked").prop("checked", false).change();
});

$(".modal-inner").on("click", function(e) {
e.stopPropagation();
});

});
