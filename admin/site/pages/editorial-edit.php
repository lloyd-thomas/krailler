<h1>Interiors - Edit</h1>

<form role="form" enctype="multipart/form-data" method="post" autocomplete="off" action="/admin/interiors-edit">

<input type="hidden" value="1" name="edited" />
<input type="hidden" value="<?php echo $_GET['edit']; ?>" name="editid" />
<input type="hidden" value="<?php echo $news[$_GET['edit']]['order']; ?>" name="order" />
<input type="hidden" value="<?php echo $news[$_GET['edit']]['id']; ?>" name="id" />
<div class="row">

  <div class="col-md-6">

    <div class="form-group">
      <label for="title">Project Name</label>
      <input type="text" class="form-control input-lg" id="title" name="title" value="<?php echo stripslashes($news[$_GET['edit']]['title']); ?>">
    </div>

    <div class="form-group">
      <label for="headline">Body</label>
      <textarea class="form-control input-lg" id="news" name="news" rows="10"><?php echo stripslashes($news[$_GET['edit']]['news']); ?></textarea>
    </div>

      <input type="submit" class="submit btn btn-success" value="Save" />
  <a href="/admin/interiors" class="submit btn btn-danger">Cancel</a>


  </div>

  <div class="col-md-6">

    <div class="form-group">
      <label for="headline">Replace project cover image</label>
      <input type="file" name="image" value="" />
      <p class="help-block">Images should be .JPG, no less that 1200 pixels wide.</p>

<?php if (file_exists($peel."/../img/interiors/thumbs/".$news[$_GET['edit']]['id']."-1.jpg")) { ?>
      <img src="/img/interiors/thumbs/<?php echo $news[$_GET['edit']]['id']; ?>-1.jpg?<?php echo rand(1000,9999);?>" style="width: 70px;" />
<?php } ?>
    </div>

 </form>

    <hr />

<form role="form" id="imageupload2" enctype="multipart/form-data" method="post" autocomplete="off" action="">
  <input type="hidden" value="<?php echo $news[$_GET['edit']]['id']; ?>" name="cid" />
  <input type="hidden" value="<?php echo $_GET['edit']; ?>" name="editid" />
  <input type="hidden" value="1" name="ajax" />
    <div class="form-group">
      <label for="headline">Upload an image to the project</label>
      <input type="file" name="collection" id="collection" value="" />
      <p class="help-block">Images should be .JPG, ideally square and no less that 1200 pixels wide.</p>
    </div>
    <div class="form-group">
      <label for="title">Photo title</label>
      <input type="text" class="form-control input-lg" id="ptitle" name="ptitle" value="">
    </div>
<input type="submit" id="imageuploader2" class="submit btn btn-success disabled" value="Upload Now" />
</form>
<div id="maincontent"><?php include('system/upload-interiors.php');?></div>
  </div>

</div>

<script>

</script>

