<?php

$data = $db->prepare("SELECT * FROM peel_pages WHERE pages_slug = :input LIMIT 1;");
$data->bindValue(':input', $uri[1], PDO::PARAM_STR);
$data->execute();
$line = $data->fetch();

$data = $db->prepare("SELECT * FROM peel_content WHERE content_page_id = :input LIMIT 1;");
$data->bindValue(':input', $line['pages_id'], PDO::PARAM_STR);
$data->execute();
$line = $data->fetch();

$home = json_decode($line['content_content']);

$images = get_homepage_images($home);

$data = $db->prepare("SELECT * FROM languages WHERE active = 1 ORDER BY id ASC;");
$data->execute();
$langs = $data->fetchAll();

function get_content($section,$lang) {
  global $db;
  if ($lang == 'zh') {
    $data = $db->prepare("SELECT language_content.content as content FROM language_content, languages WHERE languages.id = 134 AND content_block = :block AND languages.id =lang_id;");
    $data->bindValue(':block', $section, PDO::PARAM_STR);
} else if ($lang == 'ar') {
      $data = $db->prepare("SELECT language_content.content as content FROM language_content, languages WHERE languages.id = 6 AND content_block = :block AND languages.id =lang_id;");
      $data->bindValue(':block', $section, PDO::PARAM_STR);
    } else {
    $data = $db->prepare("SELECT language_content.content as content FROM language_content, languages WHERE languages.iso = :iso AND content_block = :block AND languages.id =lang_id;");
    $data->bindValue(':iso', $lang, PDO::PARAM_STR);
    $data->bindValue(':block', $section, PDO::PARAM_STR);
  }
  $data->execute();
  $content = $data->fetch();
  return $content['content'];
}
?>
