<?php

$peel = dirname(__FILE__);

if (isset($_POST['ajax']) && $_POST['ajax'] == 1) {

 function get_slug($str) {
    $str = strtolower(trim($str));
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', "-", $str);
    while (substr($str,-1) == "-") $str = substr($str,0,-1);
    while (substr($str,0,1) == "-") $str = substr($str,1,strlen($str));

    return $str;

  }

  function get_page_content($page,$arrayvalue=false) {

    global $db;
  $sql = "SELECT * FROM peel_content WHERE content_page_id = '".$page."' LIMIT 1;";

  $data = $db->prepare($sql);
  $data->execute();
  $line = $data->fetch();

  return json_decode($line['content_content'],$arrayvalue);

  }

switch($_SERVER['HTTP_HOST']) {
  case 'Krailler.local:8888':
    define('DB_SERVER','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','root');
    define('DB_DATABASE','peel_Krailler');
    define('DB_PREFIX','peel');
  break;
  case 'nienke.dl':
    define('DB_SERVER','127.0.0.1');
    define('DB_USERNAME','devuser');
    define('DB_PASSWORD','Seiji32x');
    define('DB_DATABASE','peel_Krailler');
    define('DB_PREFIX','peel');
    break;
  case 'nienke.clients.tedra.net':
  case 'nienke.clients.domh.net':
  case 'Krailler.clients.tedra.net':
  case 'Krailler.clients.domh.net':
    define('DB_SERVER','127.0.0.1');
    define('DB_USERNAME','devuser');
    define('DB_PASSWORD','uYt-7d9-Cx7-Ws8-1Wa');
    define('DB_DATABASE','peel_Krailler');
    define('DB_PREFIX','peel');
    break;
  default:
    define('DB_SERVER','localhost');
    define('DB_USERNAME','deb59054_admin');
    define('DB_PASSWORD','K1und3rb13');
    define('DB_DATABASE','deb59054_Krailler');
    define('DB_PREFIX','peel');
    break;
}

$db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE.';sslmode=require;port=3306;charset=utf8', DB_USERNAME, DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} else {

  $_POST['editid'] = $_GET['edit'];

}

  $sql = "SELECT * FROM peel_pages WHERE pages_slug = 'work' LIMIT 1;";
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

//print_r($news[$_POST['editid']]['images']);
//print_r($news[$_POST['editid']]);
if (isset($news[$_POST['editid']]['images'])) {
$pimages = $news[$_POST['editid']]['images'];
 } else {
  $pimages = array();
 }

if (isset($_POST['ajax']) && $_POST['ajax'] == 1) {

  $image = array();
  $image['cid'] = $_POST['cid'];
  $image['id'] = sizeof($pimages)+1;
  $image['slug'] = get_slug($_POST['ptitle']);
  $image['title'] = $_POST['ptitle'];
  $image['order'] = 0;

  for ($x=0;$x<sizeof($news[$_POST['editid']]['images']);$x++) {
    $news[$_POST['editid']]['images'][$x]['order'] = $news[$_POST['editid']]['images'][$x]['order']+1;
  }

  $news[$_POST['editid']]['images'][] = $image;

  $content = array();
  for ($x=0;$x<sizeof($news);$x++) {
    $row = json_encode($news[$x],true);
    $content[] = $row;
  }


  if (isset($_FILES['collection']['type']) && $_FILES['collection']['type'] == 'image/jpeg') {

    include('../system/resize.php');

    move_uploaded_file($_FILES['collection']['tmp_name'], $peel."/../../img/work/".$image['cid'].'-'.$image['id'].'-'.$image['slug'].".jpg");
    $resizeObj = new resize($peel."/../../img/work/".$image['cid'].'-'.$image['id'].'-'.$image['slug'].".jpg");
    $resizeObj -> resizeImage(150, 150, 'crop');
    $resizeObj -> saveImage($peel."/../../img/work/thumbs/".$image['cid'].'-'.$image['id'].'-'.$image['slug']."-1.jpg", 100);
    $resizeObj -> resizeImage(1200, 1200, 'auto');
    $resizeObj -> saveImage($peel."/../../img/work/thumbs/".$image['cid'].'-'.$image['id'].'-'.$image['slug']."-2.jpg", 100);

  }

  $sql = "UPDATE peel_content SET content_updated = NOW(), content_content = '".addslashes(json_encode($content))."' WHERE content_page_id = '".$line['pages_id']."' LIMIT 1;";
  $data = $db->prepare($sql);
  $data->execute();
}

  $sql = "SELECT * FROM peel_pages WHERE pages_slug = 'work' LIMIT 1;";
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

$pimages = array();
if (isset($news[$_POST['editid']]['images'])) {
$pimages = $news[$_POST['editid']]['images'];
 } else {
  $pimages = array();
 }

usort($pimages, function($a, $b) {
    return $a['order'] - $b['order'];
});

?>
<a name="work"></a>
<table class="table">
<thead>
<tr>
  <th></th>
  <th>Photo title</th>
  <th></th>
  <th></th>
</tr>
</thead>
<tbody>
<?php
for ($x=0;$x<sizeof($pimages);$x++) { ?>
<tr>
  <td><img src="/img/work/thumbs/<?php echo $pimages[$x]['cid']; ?>-<?php echo $pimages[$x]['id']; ?>-<?php echo $pimages[$x]['slug']; ?>-1.jpg?<?php echo rand(1000,9999); ?>" style="width: 50px;" /></td>
  <td><?php echo $pimages[$x]['title']; ?></td>
  <td>
 <?php if ($x<>0) { ?>
          <a href="?edit=<?php echo $_POST['editid']; ?>&amp;pup=<?php echo $x; ?>#work" class="btn btn-primary"><i class="fa fa-hand-o-up"></i> Up</a>
        <?php } else { ?>
          <a href="" class="btn btn-default" disabled='disabled'><i class="fa fa-hand-o-up"></i> Up</a>
        <?php } ?>
        <?php if ($x<>sizeof($pimages)-1) { ?>
        <a href="?edit=<?php echo $_POST['editid']; ?>&amp;pdown=<?php echo $x; ?>#work" class="btn btn-primary"><i class="fa fa-hand-o-down"></i> Down</a>
        <?php } else { ?>
        <a href="" class="btn btn-default" disabled='disabled'><i class="fa fa-hand-o-down"></i> Down</a>
        <?php } ?>

  </td>
  <td align="right"><a href="?edit=<?php echo $_POST['editid']; ?>&amp;pdelete=<?php echo $pimages[$x]['id']; ?>#work" class="btn btn-danger" onclick="return confirmClick('Are you sure you want to delete this?');" ><i class="fa fa-trash-o"></i> Delete</a></td>
</tr>
<?php } ?>
</tbody>
</table>
