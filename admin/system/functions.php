<?php

if(!defined('PEEL')) die('Unable to start Peel.');

/* ---------------------------------------------------------------------------------------------------------------------- */

function get_uri($rawuri) {

  $uri = explode('/', $rawuri);
  return $uri;

}

/* ---------------------------------------------------------------------------------------------------------------------- */

function set_message($message,$style = '') {

  $_SESSION['admin']['message'] = $message;
  $_SESSION['admin']['message_style'] = $style;
  return true;

}

/* ---------------------------------------------------------------------------------------------------------------------- */

function displayed_message() {

  unset($_SESSION['admin']['message']);
  unset($_SESSION['admin']['message_style']);
  return true;

}

/* ---------------------------------------------------------------------------------------------------------------------- */

function attempt_login($email = '', $password = '') {
global $db; 
  $sql = "SELECT * FROM peel_users
           WHERE users_email = '".($email)."'
             AND users_password = '".(md5($password.SALT))."'
           LIMIT 1;";

           $data = $db->prepare($sql);
           $data->execute();
           $user = $data->fetch();

  if (isset($user['users_password']) && md5($password.SALT) == $user['users_password']) {

      $_SESSION['admin']['authenticated'] = (md5($email.SALT));
      $_SESSION['admin']['email'] = ($email);
      $_SESSION['admin']['role'] = (md5($user['users_role'].$email.SALT));
      set_message('You have logged in as '.$email.' with '.$user['users_role'].' privileges',ADMIN_LABEL_SUCCESS);
      return true;

  }

  unset($_SESSION['admin']['authenticated']);
  unset($_SESSION['admin']['email']);
  unset($_SESSION['admin']['role']);
  set_message('Invalid username or password. Please try again.',ADMIN_LABEL_ERROR);
  return false;
}

/* ---------------------------------------------------------------------------------------------------------------------- */

function attempt_signout() {

  unset($_SESSION['admin']['authenticated']);
  unset($_SESSION['admin']['email']);
  set_message('You have signed out.',ADMIN_LABEL_ERROR);
  return true;

}
/* ---------------------------------------------------------------------------------------------------------------------- */

function get_pages() {
  global $db;
  $pages = array();
  $sql = "SELECT * FROM peel_pages WHERE pages_deleted = '0' ORDER BY pages_order ASC;";
  $data = $db->prepare($sql);
  $data->execute();
  $pages = $data->fetchAll();

  return $pages;

}
/* -------------------------------------------------------------------------------------------------------------------- */


function get_page_content($page,$arrayvalue=false) {
  global $db;
$sql = "SELECT * FROM peel_content WHERE content_page_id = '".$page."' LIMIT 1;";

$data = $db->prepare($sql);
$data->execute();
$line = $data->fetch();

return json_decode($line['content_content'],$arrayvalue);

}

/* -------------------------------------------------------------------------------------------------------------------- */

function get_id($arrayin) {

  return array_map(function($array) {
    return $array['id'];
  }, $arrayin);

}

/* -------------------------------------------------------------------------------------------------------------------- */

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

/* -------------------------------------------------------------------------------------------------------------------- */ ?>
