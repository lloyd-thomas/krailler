<h1>News - Add New</h1>

<form role="form" enctype="multipart/form-data" method="post" autocomplete="off" action="/admin/news-new">

<input type="hidden" value="1" name="addnew" />
<div class="row">

  <div class="col-md-8">

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control input-lg" id="title" name="title" value="<?php if (isset($content->link) && $content->link <> '') echo $content->link; ?>">
    </div>

    <div class="form-group">
      <label for="datetime">Date</label>
      <input type='text' name="datetime" class="form-control input-lg" id='datetimepicker1' data-date-format="YYYY-MM-DD"/>
      <p class="help-block"></p>
    </div>

    <!--<div class="form-group">
      <label for="link">Link</label>
      <input type="text" class="form-control input-lg" id="link" name="link" value="<?php if (isset($content->link) && $content->link <> '') echo $content->link; ?>">
      <p class="help-block">Must be a valid URL &mdash; i.e. http://<?php echo $_SERVER['HTTP_HOST']; ?>/news/news-item</a>
    </div>-->

    <div class="form-group">
      <label for="headline">News</label>
      <textarea class="form-control input-lg" id="news" name="news" rows="10"><?php if (isset($content->headline) && $content->headline <> '') echo $content->headline; ?></textarea>
    </div>

  </div>

  <div class="col-md-4">

    <div class="form-group">
      <label for="headline">Upload image</label>
      <input type="file" name="image" value="" />
      <p class="help-block">Images should be .JPG, no less that 1200 pixels wide.</p>

<!--<?php if (file_exists($peel."/../img/news/thumbs/".$nextid."-2.jpg")) { ?>
      <img src="/img/news/thumbs/<?php echo $display_images[$x]['id']; ?>-1.jpg?<?php echo rand(1000,9999);?>" style="width: 70px;" />
<?php } ?>-->
    </div>

  </div>

</div>

<div class="row">

  <div class="col-md-8" style="margin-bottom: 50px;">

    <hr />

    <input type="submit" class="btn btn-success" value="Save" />
    <a href="/admin/news" class="btn btn-danger">Cancel</a>

  </div>

</div>


</form>