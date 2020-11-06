<h1>News<a href="/admin/news-new" class="pad-right pull-right btn btn-success"><i class="fa fa-pencil"></i> Add New</a></h1>

<table  class="table table-striped">
  <thead>
    <tr>
      <th></th>
      <th>Title</th>
      <th>Date</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php for ($x=0;$x<sizeof($content);$x++) {
?>
  <tr>
    <td>
<?php if (file_exists($peel."/../img/news/thumbs/".$content[$x]['id']."-1.jpg")) { ?>
      <img src="/img/news/thumbs/<?php echo $content[$x]['id']; ?>-1.jpg?<?php echo rand(1000,9999);?>" style="width: 70px;" />
<?php } ?>
    </td>
    <td><?php echo $content[$x]['title']; ?></td>
    <td><?php echo $content[$x]['datetime']; ?></td>
    <td>
      <a href="/admin/news/?delete=<?php echo $x; ?>" class="btn btn-danger pull-right" onclick="return confirmClick('Are you sure you want to delete this?');" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Delete</a>
      <a href="/admin/news-edit/?edit=<?php echo $x; ?>" class="btn btn-primary pull-right"><i class="fa fa-pencil-square-o "></i> Edit</a>
    </td>
  </tr>
<?php } ?>
  </tbody>
</table>