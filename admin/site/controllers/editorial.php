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

if (isset($_GET['up']) && $_GET['up'] <> '') {

  $increment = $_GET['up'];
  $news[$increment]['order']=$news[($increment-1)]['order'];
  $news[$increment-1]['order']=$news[$increment]['order']+1;

  $content = array();
  for ($x=0;$x<sizeof($news);$x++) {
    $row = json_encode($news[$x]);
    $content[] = $row;
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location:/admin/interiors');
  exit();
}

if (isset($_GET['down']) && $_GET['down'] <> '') {

  $increment = $_GET['down'];
  $news[$increment]['order']=$news[($increment+1)]['order'];
  $news[$increment+1]['order']=$news[$increment]['order']-1;

  $content = array();
  for ($x=0;$x<sizeof($news);$x++) {
    $row = json_encode($news[$x]);
    $content[] = $row;
  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location:/admin/interiors');
  exit();
}

$content = array();
$content = $news;

if (isset($_GET['delete']) && $_GET['delete'] <> '') {

  unset($content[$_GET['delete']]);
  $content = array_values($content);
  for ($x=0;$x<sizeof($content);$x++) {
    if (isset($content[$x])) $output[] = json_encode($content[$x]);
  }
  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($output))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";$data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location: /admin/interiors');
  exit();

}

?>
