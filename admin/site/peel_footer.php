<?php if(!defined('PEEL')) die('Unable to start Peel.'); ?>

    <div id="footer">
      <div class="container">
        <p class="text-muted">Content &copy; <?php echo date('Y'); ?> <?php echo COMPANY; ?>. <span class="pull-right">Built by <a href="http://domh.net">Lloyd</a> &amp; <a href="http://tedra.net">Dan</a>.</span></p>
      </div>
    </div>
  
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="/admin/js/bootstrap.min.js"></script>
    <script src="/admin/js/moment.js"></script>
    <script src="/admin/js/datepicker.js"></script>
    <script src="/admin/js/default.js"></script>

    <script type="text/javascript">

    $("form#imageupload2").submit(function() {
        $('#loading').show();
        var data = new FormData($(this)[0]);
        //var title = $("#ptitle").val();
        //var data = new FormData();
        //jQuery.each($('#collection')[0].files, function(i, file) {
        //    data.append('file-'+i, file);
        //});

      $('.submit').addClass('disabled');
      var url = "/admin/system/upload-interiors.php"; // the script where you handle the form input.

      $.ajax({
        data: data,
        cache: false,
        url: url,
        contentType: false,
        processData: false,
        type: 'POST',
      success: function(data)
      {

          $('#maincontent').fadeOut('fast', function () {
          $('#maincontent').html(data).fadeIn('fast');
          $('#loading').hide();
          $('.submit').removeClass('disabled');
        });
      }
      });

      return false; // avoid to execute the actual submit of the form.
      });

    $("form#imageupload").submit(function() {
        $('#loading').show();
        var data = new FormData($(this)[0]);
        //var title = $("#ptitle").val();
        //var data = new FormData();
        //jQuery.each($('#collection')[0].files, function(i, file) {
        //    data.append('file-'+i, file);
        //});

      $('.submit').addClass('disabled');
      var url = "/admin/system/upload-work.php"; // the script where you handle the form input.

      $.ajax({
        data: data,
        cache: false,
        url: url,
        contentType: false,
        processData: false,
        type: 'POST',
      success: function(data)
      {

          $('#maincontent').fadeOut('fast', function () {
          $('#maincontent').html(data).fadeIn('fast');
          $('#loading').hide();
          $('.submit').removeClass('disabled');
        });
      }
      });

      return false; // avoid to execute the actual submit of the form.
      });

        $(function () {
            $('#loading').hide();
            $('#datetimepicker1').datetimepicker({pickTime: false});
        });
    </script>

  </body>
</html>
