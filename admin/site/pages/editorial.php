<h1>Interiors<a href="/admin/interiors-new" class="pad-right pull-right btn btn-success"><i class="fa fa-pencil"></i> Add New</a></h1>

<table  class="table table-striped">
  <thead>
    <tr>
      <th></th>
      <th>Project</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php for ($x=0;$x<sizeof($content);$x++) {
?>
  <tr>
    <td>
<?php if (file_exists($peel."/../img/interiors/thumbs/".$content[$x]['id']."-1.jpg")) { ?>
      <img src="/img/interiors/thumbs/<?php echo $content[$x]['id']; ?>-1.jpg?<?php echo rand(1000,9999);?>" style="width: 70px;" />
<?php } ?>
    </td>
    <td><?php echo $content[$x]['title']; ?></td>
    <td align="right">
 <?php if ($x<>0) { ?>
          <a href="/admin/interiors/?up=<?php echo $x; ?>" class="btn btn-primary"><i class="fa fa-hand-o-up"></i> Up</a>
        <?php } else { ?>
          <a href="" class="btn btn-default" disabled='disabled'><i class="fa fa-hand-o-up"></i> Up</a>
        <?php } ?>
        <?php if ($x<>sizeof($content)-1) { ?>
        <a href="/admin/interiors/?down=<?php echo $x; ?>" class="btn btn-primary"><i class="fa fa-hand-o-down"></i> Down</a>
        <?php } else { ?>
        <a href="" class="btn btn-default" disabled='disabled'><i class="fa fa-hand-o-down"></i> Down</a>
        <?php } ?>
    </td>
    <td>
      <a href="/admin/interiors/?delete=<?php echo $x; ?>" class="btn btn-danger pull-right" onclick="return confirmClick('Are you sure you want to delete this?');" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Delete</a>
      <a href="/admin/interiors-edit/?edit=<?php echo $x; ?>" class="btn btn-primary pull-right"><i class="fa fa-pencil-square-o "></i> Edit</a>
    </td>
  </tr>
<?php } ?>
  </tbody>
</table>