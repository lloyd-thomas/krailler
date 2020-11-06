<h1>Interiors - Add New</h1>

<form role="form" enctype="multipart/form-data" method="post" autocomplete="off" action="/admin/interiors-new">

<input type="hidden" value="1" name="addnew" />
<div class="row">

  <div class="col-md-6">

    <div class="form-group">
      <label for="title">Project Name</label>
      <input type="text" class="form-control input-lg" id="title" name="title" value="<?php if (isset($content->link) && $content->link <> '') echo $content->link; ?>">
    </div>

    <div class="form-group">
      <label for="headline">Body</label>
      <textarea class="form-control input-lg" id="news" name="news" rows="10"></textarea>
    </div>

  </div>

  <div class="col-md-6">

    <div class="form-group">
      <label for="headline">Upload collection cover image</label>
      <input type="file" name="image" value="" />
      <p class="help-block">Images should be .JPG, no less that 1200 pixels wide.</p>

<!--<?php if (file_exists($peel."/../img/interiors/thumbs/".$nextid."-2.jpg")) { ?>
      <img src="/img/photos/thumbs/<?php echo $display_images[$x]['id']; ?>-1.jpg?<?php echo rand(1000,9999);?>" style="width: 70px;" />
<?php } ?>-->
    </div>

  </div>

</div>

<div class="row">

  <div class="col-md-8" style="margin-bottom: 50px;">

    <hr />

    <input type="submit" class="btn btn-success" value="Save" />
    <a href="/admin/interiors" class="btn btn-danger">Cancel</a>

  </div>

</div>


</form>