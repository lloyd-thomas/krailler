<?php

$sql = "SELECT * FROM peel_pages WHERE pages_slug = 'interiors' LIMIT 1;";
$data = $db->prepare($sql);
$data->execute();
$line = $data->fetch();

$content = get_page_content($line['pages_id'], true);

$news = array();
for ($x=0;$x<sizeof($content);$x++) {
  $row = json_decode($content[$x],true);
  $news[] = $row;
}

usort($news, function($a, $b) {
    return $a['order'] - $b['order'];
});

if (isset($_GET['pdown']) && $_GET['pdown'] <> '') {

  usort($news[$_GET['edit']]['images'], function($a, $b) {
    return $a['order'] - $b['order'];
  });

  //print_r($news[$_GET['edit']]['images']);
  $news[$_GET['edit']]['images'][$_GET['pdown']]['order']=$news[$_GET['edit']]['images'][$_GET['pdown']+1]['order'];
  $news[$_GET['edit']]['images'][$_GET['pdown']+1]['order']=$news[$_GET['edit']]['images'][$_GET['pdown']]['order']-1;
  //print_r($news[$_GET['edit']]['images']);
  $content = array();
  for ($x=0;$x<sizeof($news);$x++) {
    $row = json_encode($news[$x],true);
    $content[] = $row;
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();

  //print_r($pimages);
}

if (isset($_GET['pup']) && $_GET['pup'] <> '') {

  usort($news[$_GET['edit']]['images'], function($a, $b) {
    return $a['order'] - $b['order'];
  });

  //print_r($news[$_GET['edit']]['images']);
  $news[$_GET['edit']]['images'][$_GET['pup']]['order']=$news[$_GET['edit']]['images'][$_GET['pup']-1]['order'];
  $news[$_GET['edit']]['images'][$_GET['pup']-1]['order']=$news[$_GET['edit']]['images'][$_GET['pup']]['order']+1;
  //print_r($news[$_GET['edit']]['images']);
  $content = array();
  for ($x=0;$x<sizeof($news);$x++) {
    $row = json_encode($news[$x],true);
    $content[] = $row;
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();

  //print_r($pimages);
}



if (isset($_GET['pdelete']) && $_GET['pdelete'] <> '') {

  $news = array();
  for ($x=0;$x<sizeof($content);$x++) {
    $row = json_decode($content[$x],true);
    $news[] = $row;
  }

  $pimages = $news[$_GET['edit']]['images'];

  for ($x=0;$x<sizeof($news[$_GET['edit']]['images']);$x++) {
    if (isset($news[$_GET['edit']]['images'][$x]['id']) && $news[$_GET['edit']]['images'][$x]['id'] == $_GET['pdelete']) $index = $x;
  }
//print_r($news[$_GET['edit']]['images']);
  if (isset($index)) {
    unset($news[$_GET['edit']]['images'][$index]);
    $news[$_GET['edit']]['images'] = array_values($news[$_GET['edit']]['images']);
  }

  $content = array();
  for ($x=0;$x<sizeof($news);$x++) {
    $row = json_encode($news[$x],true);
    $content[] = $row;
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();


  //print_r($pimages);
}

$sql = "SELECT * FROM peel_pages WHERE pages_slug = 'interiors' LIMIT 1;";
$data = $db->prepare($sql);
$data->execute();
$line = $data->fetch();

$content = get_page_content($line['pages_id'], true);

$news = array();
for ($x=0;$x<sizeof($content);$x++) {
  $row = json_decode($content[$x],true);
  $news[] = $row;
}

usort($news, function($a, $b) {
    return $a['order'] - $b['order'];
});

//$news = array_reverse($news);

if (isset($_POST['edited']) && $_POST['edited'] <> '') {

  $_POST['images'] = $news[$_POST['editid']]['images'];
  unset($news[$_POST['editid']]);

    foreach($news as $item) {
      $output[] = json_encode($item);
  }
  $output[] = json_encode($_POST);

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($output))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();


  if (isset($_FILES['image']['type']) && $_FILES['image']['type'] == 'image/jpeg') {

    include('system/resize.php');

    move_uploaded_file($_FILES['image']['tmp_name'], $peel."/../img/interiors/".$_POST['id'].".jpg");
    $resizeObj = new resize($peel."/../img/interiors/".$_POST['id'].".jpg");
    $resizeObj -> resizeImage(300, 300, 'crop');
    $resizeObj -> saveImage($peel."/../img/interiors/thumbs/".$_POST['id']."-1.jpg", 80);
    $resizeObj -> resizeImage(1000, 1000, 'portrait');
    $resizeObj -> saveImage($peel."/../img/interiors/thumbs/".$_POST['id']."-2.jpg", 80);

  }

  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location: /admin/interiors');
  exit();

}

?>
