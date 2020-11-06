<h1>Clients</h1>

<form role="form" enctype="multipart/form-data" method="post" action="">
<input type="hidden" value="1" name="save" />
<input type="hidden" value="1" name="id" />
<div class="row">

  <div class="col-md-12">

    <div class="form-group">
      <label for="body">Client list</label>
      <textarea class="form-control input-lg" id="body" name="body1" rows="10"><?php if (isset($clients->body1) && $clients->body1 <> '') echo stripslashes($clients->body1); ?></textarea>
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