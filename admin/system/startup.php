<?php

if(!isset($peel))
  die('Unable to start Peel.');

define('PEEL', true);

require_once('configuration.php');
require_once('functions.php');

$uri = get_uri($_SERVER['REQUEST_URI']);

if (isset($_POST['authenticate']) && $_POST['authenticate'] == '1') {
  attempt_login(trim($_POST['email']),trim($_POST['password']));
}

if (isset($uri[2]) && $uri[2] == 'sign-out') {
  attempt_signout();
  header("location: /admin/");
  exit();
}

require_once('load.php');

?>