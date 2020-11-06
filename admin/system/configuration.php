<?php

if(!defined('PEEL')) die('Unable to start Peel.');

define('PEEL_VERSION','0.1');

define('DEBUG',1);
define('PRODUCTION',1);
define('SALT','Yx8-Ew2-43R-DrE');
define('PROJECT','Krailler');
define('COMPANY','Krailler');

define('ADMIN_LABEL_SUCCESS','success');
define('ADMIN_LABEL_INFO','info');
define('ADMIN_LABEL_ERROR','danger');



switch($_SERVER['HTTP_HOST']) {
  case 'krailler.clients.tedra.net':
    define('DB_SERVER','127.0.0.1');
    define('DB_USERNAME','devuser');
    define('DB_PASSWORD','uYt-7d9-Cx7-Ws8-1Wa');
    define('DB_DATABASE','krailler');
    define('DB_PREFIX','peel');
  break;
  case 'krailler.deptofmentalhygiene.com':
    define('DB_SERVER','mysql.deptofmentalhygiene.com');
    define('DB_USERNAME','krailler_admin');
    define('DB_PASSWORD','7@ocean11');
    define('DB_DATABASE','krailler_db');
    define('DB_PREFIX','peel');
  break;
  case 'krailler.local':
    define('DB_SERVER','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','c0l0m8ia');
    define('DB_DATABASE','krailler_db');
    define('DB_PREFIX','peel');
    break;
  default:
  define('DB_SERVER','internal-db.s188151.gridserver.com');
  define('DB_USERNAME','db188151_kra2');
  define('DB_PASSWORD','v0-on@Td#201THRE4');
  define('DB_DATABASE','db188151_krailler_new');
  define('DB_PREFIX','peel');
  break;
}

$db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE.';sslmode=require;port=3306;charset=utf8', DB_USERNAME, DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if(DEBUG == 1) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  set_time_limit(0);
  ini_set('memory_limit', '-1');
} else {
  error_reporting(0);
  ini_set('display_errors', 0);
}

session_start();

date_default_timezone_set('GMT');
setlocale(LC_ALL, 'en_US.utf-8');
header('Content-Type: text/html; charset=utf-8');

?>
