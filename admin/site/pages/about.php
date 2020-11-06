<h1>About</h1>

<form role="form" enctype="multipart/form-data" method="post" action="">
<input type="hidden" value="1" name="save" />
<input type="hidden" value="1" name="id" />
<div class="row">

  <div class="col-md-6">

    <div class="form-group">
      <label for="body">About Us</label>
      <textarea class="form-control input-lg" id="body" name="body1" rows="10"><?php if (isset($about->body1) && $about->body1 <> '') echo stripslashes($about->body1); ?></textarea>
    </div>

  </div>

    <div class="col-md-6">

    <div class="form-group">
      <label for="body">Email address</label>
      <input type="text" class="form-control input-lg" id="body" name="body2"  value="<?php if (isset($about->body2) && $about->body2 <> '') echo stripslashes($about->body2); ?>">
    </div>

    <div class="form-group">
        <label for="headline">About us image</label>
        <input type="file" name="image" value="" />
        <p class="help-block">Images should be .JPG, no less that 1200 pixels wide.</p>

  <?php if (file_exists($peel."/../img/about/thumbs/".$about->id."-1.jpg")) { ?>
        <img src="/img/about/thumbs/<?php echo $about->id; ?>-1.jpg?<?php echo rand(1000,9999);?>" style="width: 70px;" />
  <?php } ?>

  </div>

</div>
</div>
<div class="row">

  <div class="col-md-12">
    <input type="submit" class="btn btn-success" value="Save" />
    <a href="/admin" class="btn btn-danger">Cancel</a>

  </div>

</div>

</form>