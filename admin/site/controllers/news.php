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

$content = array();
$content = $news;
if (isset($_GET['delete']) && $_GET['delete'] <> '') {

  unset($content[$_GET['delete']]);
  $content = array_values($content);
  for ($x=0;$x<sizeof($content);$x++) {
    if (isset($content[$x])) $output[] = json_encode($content[$x]);
  }
  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($output))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();
  set_message('Content updated',ADMIN_LABEL_INFO);
  header('location: /admin/news');
  exit();

}

?>
