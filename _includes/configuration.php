<?php

  include('functions.php');
  include('setup.php');

  nocache();

  set_time_limit(0);
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  ini_set('memory_limit', '-1');

  session_start();

  date_default_timezone_set('GMT');
  setlocale(LC_ALL, 'en_US.utf-8');

  header('Content-Type: text/html; charset=utf-8');

?>