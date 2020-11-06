<?php

$sql = "SELECT * FROM peel_pages WHERE pages_slug = '".$uri[2]."' LIMIT 1;";
$data = $db->prepare($sql);
$data->execute();
$line = $data->fetch();

if (isset($_GET['down']) && $_GET['down'] <> '') {

  $content = get_page_content($line['pages_id']);
  $display_images = get_homepage_images($content);
  $increment = $_GET['down'];
  $display_images[$increment]['order']=$display_images[($increment+1)]['order'];
  $display_images[$increment+1]['order']=$display_images[$increment]['order']-1;
  $images = new stdClass;
  unset($content->images);
  $display_images = array_values($display_images);
  for ($x=0;$x<sizeof($display_images);$x++) {
    if (isset($display_images[$x]['id']) && $display_images[$x]['id'] <> '') {
      $content->images[$x] = new stdClass;
      $content->images[$x]->id = $display_images[$x]['id'];
      $content->images[$x]->order = $display_images[$x]['order'];
    }
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location:/admin/home');
  exit();
}


if (isset($_GET['up']) && $_GET['up'] <> '') {

  $content = get_page_content($line['pages_id']);
  $display_images = get_homepage_images($content);
  $increment = $_GET['up'];
  $display_images[$increment]['order']=$display_images[($increment-1)]['order'];
  $display_images[$increment-1]['order']=$display_images[$increment]['order']+1;
  $images = new stdClass;
  unset($content->images);
  $display_images = array_values($display_images);
  for ($x=0;$x<sizeof($display_images);$x++) {
    if (isset($display_images[$x]['id']) && $display_images[$x]['id'] <> '') {
      $content->images[$x] = new stdClass;
      $content->images[$x]->id = $display_images[$x]['id'];
      $content->images[$x]->order = $display_images[$x]['order'];
    }
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";$data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location:/admin/home');
  exit();
}

if (isset($_GET['delete']) && $_GET['delete'] <> '') {

  $content = get_page_content($line['pages_id']);
  $display_images = get_homepage_images($content);
  $increment = $display_images[$_GET['delete']];
  for ($x=$increment;$x<sizeof($display_images);$x++) {
    $display_images[$x]['order']=$display_images[$x]['order']-1;
  }
  unset($display_images[$_GET['delete']]);
  $images = new stdClass;
  unset($content->images);
  $display_images = array_values($display_images);
  for ($x=0;$x<sizeof($display_images);$x++) {
    if (isset($display_images[$x]['id']) && $display_images[$x]['id'] <> '') {
      $content->images[$x] = new stdClass;
      $content->images[$x]->id = $display_images[$x]['id'];
      $content->images[$x]->order = $display_images[$x]['order'];
    }
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location:/admin/home');
  exit();
}

if (isset($_POST['save']) && $_POST['save'] == 1) {

  $nextid = NULL;
  $content = get_page_content($line['pages_id']);
  if (isset($content->images) && sizeof($content->images) > 0) {
    $display_images = get_homepage_images($content);
    $ids = get_id($display_images);
    if (isset($ids) && sizeof($ids) > 0) $nextid = max($ids)+1;
  }

  if (empty($nextid) || $nextid == '') $nextid = 0;

  if (isset($_FILES['image']['type']) && $_FILES['image']['type'] == 'image/jpeg') {

    include('system/resize.php');

    $new = array();
    $new['id'] = $nextid;
    $new['order'] = 0;
    if (isset($_POST['images']) && sizeof($_POST['images']) > 0) {
      for ($x=0;$x<sizeof($_POST['images']);$x++) {
        $_POST['images'][$x]['order']++;
      }
    }
    $_POST['images'][] = $new;

    move_uploaded_file($_FILES['image']['tmp_name'], $peel."/../img/slideshow/".$nextid.".jpg");
    $resizeObj = new resize($peel."/../img/slideshow/".$nextid.".jpg");
    $resizeObj -> resizeImage(300, 300, 'crop');
    $resizeObj -> saveImage($peel."/../img/slideshow/thumbs/".$nextid."-1.jpg", 100);
    $resizeObj -> resizeImage(1200, 1200, 'auto');
    $resizeObj -> saveImage($peel."/../img/slideshow/thumbs/".$nextid."-2.jpg", 100);
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($_POST))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
}

$content = get_page_content($line['pages_id']);
if (isset($content->images) && sizeof($content->images) > 0) {
  $display_images = get_homepage_images($content);
  $image_message = NULL;
} else {
  $image_message = "No homepage slideshow images.";
}

?>
