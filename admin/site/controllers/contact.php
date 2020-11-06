<?php

$sql = "SELECT * FROM peel_pages WHERE pages_slug = '".$uri[2]."' LIMIT 1;";
$data = $db->prepare($sql);
$data->execute();
$line = $data->fetch();

if (isset($_POST['save']) && $_POST['save'] == 1) {

 if (isset($_FILES['image']['type']) && $_FILES['image']['type'] == 'image/jpeg') {

    include('system/resize.php');

    move_uploaded_file($_FILES['image']['tmp_name'], $peel."/../img/contact/".$_POST['id'].".jpg");
    $resizeObj = new resize($peel."/../img/contact/".$_POST['id'].".jpg");
    $resizeObj -> resizeImage(300, 300, 'crop');
    $resizeObj -> saveImage($peel."/../img/contact/thumbs/".$_POST['id']."-1.jpg", 80);
    $resizeObj -> resizeImage(1000, 1000, 'portrait');
    $resizeObj -> saveImage($peel."/../img/contact/thumbs/".$_POST['id']."-2.jpg", 80);

  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($_POST))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
}

$sql = "SELECT * FROM peel_content WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
$data = $db->prepare($sql);
$data->execute();
$line = $data->fetch();

$contact = json_decode($line['content_content']);

?>
