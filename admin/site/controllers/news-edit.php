<?php

$sql = "SELECT * FROM peel_pages WHERE pages_slug = 'news' LIMIT 1;";
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
    return str_replace('-','',$b['datetime']) - str_replace('-','',$a['datetime']);
});

//$news = array_reverse($news);

if (isset($_POST['edited']) && $_POST['edited'] <> '') {

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

    move_uploaded_file($_FILES['image']['tmp_name'], $peel."/../img/news/".$_POST['id'].".jpg");
    $resizeObj = new resize($peel."/../img/news/".$_POST['id'].".jpg");
    $resizeObj -> resizeImage(300, 300, 'crop');
    $resizeObj -> saveImage($peel."/../img/news/thumbs/".$_POST['id']."-1.jpg", 80);
    $resizeObj -> resizeImage(1000, 1000, 'portrait');
    $resizeObj -> saveImage($peel."/../img/news/thumbs/".$_POST['id']."-2.jpg", 80);

  }

  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location: /admin/news');
  exit();

}

?>
