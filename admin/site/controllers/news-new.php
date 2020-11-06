<?php

$sql = "SELECT * FROM peel_pages WHERE pages_slug = 'news' LIMIT 1;";
$data = $db->prepare($sql);
$data->execute();
$line = $data->fetch();

$content = get_page_content($line['pages_id'], true);

$nextid = 0;
for ($x=0;$x<sizeof($content);$x++) {
  $row = json_decode($content[$x],true);
  if ($nextid <= $row['id']) $nextid = $row['id'];
}

$_POST['id'] = $nextid+1;

if (isset($_POST['addnew']) && $_POST['addnew'] == 1) {

    $newsitem = json_encode($_POST);
    $content[] = $newsitem;

  if (isset($_FILES['image']['type']) && $_FILES['image']['type'] == 'image/jpeg') {

    include('system/resize.php');

    move_uploaded_file($_FILES['image']['tmp_name'], $peel."/../img/news/".$_POST['id'].".jpg");
    $resizeObj = new resize($peel."/../img/news/".$_POST['id'].".jpg");
    $resizeObj -> resizeImage(300, 300, 'crop');
    $resizeObj -> saveImage($peel."/../img/news/thumbs/".$_POST['id']."-1.jpg", 80);
    $resizeObj -> resizeImage(1000, 1000, 'portrait');
    $resizeObj -> saveImage($peel."/../img/news/thumbs/".$_POST['id']."-2.jpg", 80);

  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();

  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location: /admin/news');
  exit();
}

?>
