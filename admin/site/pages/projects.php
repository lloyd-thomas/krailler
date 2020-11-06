<h1>Projects<a href="" class="pad-right pull-right btn btn-success"><i class="fa fa-pencil"></i> Add New</a></h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th></th>
      <th>Title</th>
      <th>Order</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php for ($x=0;$x<sizeof($projects);$x++) { ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>
<?php if (isset($projectss[$x]['users_email']) && $projects[$x]['users_email'] == 0) {  ?>
        <a href="#" class="internal btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-lock"></i> Lock</a>
<?php } else { ?>
        <a href="#" class="internal btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-unlock"></i> Unlock</a>
<?php } ?>
        <a href="#" class="internal btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-pencil-square-o "></i> Edit</a>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>