<?php

  $peel = dirname(__FILE__);

  $peelSys  = $peel . '/system';
  $peelSite = $peel . '/site';

  if(!file_exists($peelSys.'/startup.php')) {
    die('Unable to start Peel.');
  }

  require_once($peelSys . '/startup.php');

?>