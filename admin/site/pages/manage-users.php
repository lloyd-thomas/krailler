<style>
<?php if (isset($_GET['edit']) && $_GET['edit'] > 0) { ?>
.edituser { display: block; }
<?php } ?>
select { width: 100%; }
</style>
<div class="edituser">
<h1>Edit User</h1>
<form role="form" method="post" autocomplete="off" action="/admin/manage-users">
<input type="hidden" name="editsubmit" value="1">
<input type="hidden" name="user_id" value="<?php echo $edituser['users_id'];?>">
  <div class="form-group">
    <label for="newemail">Email</label>
    <input type="email" id="newemail" autocomplete="off" value="<?php echo $edituser['users_email']; ?>" class="form-control validate" name="newemail" required autofocus />
    <p class="help-block"></p>
  </div>

  <div class="form-group">
    <label for="newpassword">New Password</label>
    <input type="password" autocomplete="off" value="" placeholder="" id="newpassword" class="form-control" name="newpassword" />
  </div>

  <div class="form-group">
    <label for="newpassword2">Retype New Password</label>
    <input type="password" autocomplete="off" value="" placeholder="" id="newpassword2" class="form-control" name="newpassword2" />
  </div>

  <div class="form-group">
    <label for="newdescription">Description</label>
    <input type="text" autocomplete="off" value="<?php echo $edituser['users_description']; ?>" id="newdescription" class="form-control" name="newdescription" />
  </div>

  <div class="form-group">
    <label for="usertype">Type</label>
    <select name="usertype">
      <option value="editor"<?php if (isset($edituser['users_role']) && $edituser['users_role'] == 'editor') echo ' selected'; ?>>Editor</option>
      <option value="admin"<?php if (isset($edituser['users_role']) && $edituser['users_role'] == 'admin') echo ' selected'; ?>>Admin</option>
    </select>
  </div>


  <input type="submit" class="btn btn-success" value="Save" />
  <a href="/admin/manage-users" class="btn btn-danger">Cancel</a>

</form>
<hr />
</div>

<div class="addnew">
<h1>Add New User</h1>
<form role="form" method="post" autocomplete="off" action="/admin/manage-users">
<input type="hidden" name="newsubmit" value="1">
  <div class="form-group">
    <label for="newemail">Email</label>
    <input type="email" id="newemail" autocomplete="off" value="" class="form-control validate" name="newemail" required autofocus />
    <p class="help-block"></p>
  </div>

  <div class="form-group">
    <label for="newpassword">Password</label>
    <input type="password" autocomplete="off" value="" id="newpassword" class="form-control" name="newpassword" />
  </div>

  <div class="form-group">
    <label for="newdescription">Description</label>
    <input type="text" autocomplete="off" value="" id="newdescription" class="form-control" name="newdescription" />
  </div>

  <div class="form-group">
    <label for="usertype">Type</label>
    <select name="usertype">
      <option value="editor">Editor</option>
      <option value="admin">Admin</option>
    </select>
  </div>

  <input type="submit" class="btn btn-success" value="Save" />
  <a href="/admin/manage-users" class="btn btn-danger">Cancel</a>

</form>
<hr />
</div>

<h1>Manage Users<a href="" class="addnewitem pad-right pull-right btn btn-success"><i class="fa fa-pencil"></i> Add New</a></h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th></th>
      <th>Email</th>
      <th>Role</th>
      <th>Description</th>
      <th>Added</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php for ($x=0;$x<sizeof($users);$x++) { ?>
    <tr>
      <td></td>
      <td><a href="mailto:<?php echo $users[$x]['users_email']; ?>"><?php echo $users[$x]['users_email']; ?><a/></td>
      <td><?php echo $users[$x]['users_role']; ?></td>
      <td><?php echo $users[$x]['users_description']; ?></td>
      <td><?php echo $users[$x]['users_date']; ?></td>
      <td>
<?php if (isset($users[$x]['users_email']) && $users[$x]['users_email'] <> $_SESSION['admin']['email']) {  ?>
<a href="/admin/manage-users/?delete=<?php echo $users[$x]['users_id']?>" class="internal btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-trash-o "></i> Delete</a>
<?php if (isset($users[$x]['users_deletable']) && $users[$x]['users_deletable'] == 0) {  ?>
        <a href="/admin/manage-users/?lock=<?php echo $users[$x]['users_id']?>" class="internal btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-lock"></i> Lock</a>
<?php } else { ?>
        <a href="/admin/manage-users/?unlock=<?php echo $users[$x]['users_id']?>" class="internal btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-unlock"></i> Unlock</a>
<?php } ?>
<?php }  else { ?>
        <a href="#" class="internal btn btn-default pull-right nonactive" style="margin-right: 5px;"><i class="fa fa-lock"></i> Lock</a>
<?php } ?>
        <a href="/admin/manage-users/?edit=<?php echo $users[$x]['users_id']?>" class="internal btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-pencil-square-o "></i> Edit</a>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>