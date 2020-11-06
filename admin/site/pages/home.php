<h1>Home</h1>
<div id="tony"></div>
<form role="form" enctype="multipart/form-data" method="post" action="">
<input type="hidden" value="1" name="save" />

<div class="row">

  <div class="col-md-12">
    <p><b>Slideshow</b></p>

    <div class="radio">
      <label>
        <input type="radio" name="slideshowon" id="slideshowon" value="1"<?php if (isset($content->slideshowon) && $content->slideshowon == 1) echo " checked"; ?>>
        On
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="slideshowon" id="slideshowon" value="0"<?php if (isset($content->slideshowon) && $content->slideshowon == 0) echo " checked"; ?>>
        Off
      </label>
    </div>
<hr />

        <input type="submit" class="btn btn-success" value="Update" />
    <a href="/admin" class="btn btn-danger">Cancel</a>
<hr />
    <div class="form-group">
      <label for="headline">Upload new image to slideshow</label>
      <input type="file" name="image" value="" />
      <p class="help-block">Images should be .JPG, no less that 1200 pixels wide.</p>
    </div>

    <hr />

<?php

if (isset($display_images) && sizeof($display_images) > 0) {
  for ($x=0;$x<sizeof($display_images);$x++) {
  if (isset($display_images[$x]['id']) && $display_images[$x]['id'] <> '') { ?>
      <div class="image">
        <input type="hidden" value="<?php echo $display_images[$x]['id']; ?>" name="images[<?php echo $x; ?>][id]" />
        <input type="hidden" value="<?php echo $display_images[$x]['order']; ?>" name="images[<?php echo $x; ?>][order]" />
        <img src="/img/slideshow/thumbs/<?php echo $display_images[$x]['id']; ?>-1.jpg?<?php echo rand(1000,9999);?>" style="width: 70px;" />
        <?php if ($x<>0) { ?>
          <a href="/admin/home/?up=<?php echo $x; ?>" class="btn btn-primary"><i class="fa fa-hand-o-up"></i> Up</a>
        <?php } else { ?>
          <a href="" class="btn btn-default" disabled='disabled'><i class="fa fa-hand-o-up"></i> Up</a>
        <?php } ?>
        <?php if ($x<>sizeof($display_images)-1) { ?>
        <a href="/admin/home/?down=<?php echo $x; ?>" class="btn btn-primary"><i class="fa fa-hand-o-down"></i> Down</a>
        <?php } else { ?>
        <a href="" class="btn btn-default" disabled='disabled'><i class="fa fa-hand-o-down"></i> Down</a>
        <?php } ?>
        <a href="/admin/home/?delete=<?php echo $x; ?>" class="btn btn-danger" onclick="return confirmClick('Are you sure you want to delete this?');"><i class="fa fa-trash-o"></i> Delete</a>
        <hr />
      </div>
  <?php
  }
  }
} else if ($image_message <> '') {
    echo $image_message;
}

?>
     <!-- <input type="hidden" value="2" name="images[1][id]" />
      <input type="hidden" value="100" name="images[1][order]" />
      <input type="hidden" value="3" name="images[2][id]" />
      <input type="hidden" value="12" name="images[2][order]" />-->
  </div>

</div>

</form>
