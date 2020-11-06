<?php

if (isset($_POST['save']) && $_POST['save'] == 1) {
  $sql = "UPDATE language_content SET content = '".addslashes($_POST['content'])."' WHERE id = ".$_POST['id'].";";
  $data = $db->prepare($sql);
  $data->execute();
}

if (isset($_GET['lang']) && $_GET['lang'] > 0) {
  $lang = $_GET['lang'];
} else {
  $lang = 1;
}
$sql = "SELECT * FROM language_content WHERE lang_id = ".$lang." order by order_id ASC;";
$data = $db->prepare($sql);
$data->execute();
$content = $data->fetchAll();

?>
