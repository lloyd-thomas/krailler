<?php

  function nocache() {
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
  }

 function get_slug($str) {
    $str = strtolower(trim($str));
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', "-", $str);
    while (substr($str,-1) == "-") $str = substr($str,0,-1);
    while (substr($str,0,1) == "-") $str = substr($str,1,strlen($str));

    return $str;

  }

  function get_uri($rawuri) {
    $uri = explode('/', $rawuri);
    if (empty($uri[2])) $uri[2] = NULL;
    if (empty($uri[3])) $uri[3] = NULL;
    return $uri;
  }

  function check_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
  }

  function get_page_content($page,$arrayvalue=false) {

  $sql = "SELECT * FROM peel_content WHERE content_page_id = '".$page."' LIMIT 1;";
  $result = mysql_query($sql);
  $line = mysql_fetch_array($result);

  return json_decode($line['content_content'],$arrayvalue);

  }

  function get_homepage_images($content) {

    $display_images = array();
    if (sizeof($content->images) > 0) {
      foreach($content->images as $image)
      {
          $display_image = array();
          $display_image['id'] = $image->id;
          $display_image['order'] = $image->order;
          $display_images[] = $display_image;
      }

      usort($display_images, function($a, $b) {
          return $a['order'] - $b['order'];
      });

      return $display_images;
    } else {

      return false;

    }
  }

?>