$('#wrap').on('click', '.addnewitem', function(e) {
  $('.edituser').fadeOut('slow');
  $('.addnew').fadeIn('slow');
  $('.addnewitem').addClass('nonactive');
  $('.addnewitem').addClass('btn-default');
  $('.addnewitem').removeClass('btn-success');
  e.preventDefault();
});

$('#wrap').on('click', '#ptitle', function(e) {
  $('#imageuploader').removeClass('disabled');
  e.preventDefault();
});

$('#wrap').on('click', '#ptitle', function(e) {
  $('#imageuploader2').removeClass('disabled');
  e.preventDefault();
});

function confirmClick(message) {
  var agree=confirm(message);
  if (agree)
    return true;
  else
    return false;
}