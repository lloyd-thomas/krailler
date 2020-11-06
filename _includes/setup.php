<?php

function getUserIP() {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$uri = get_uri($_SERVER['REQUEST_URI']);

if (empty($uri[1]) || $uri[1] == "") {
  header('location: /home');
  exit();
}
if (empty($uri[2]) || $uri[2] == "") {
  $ip = getUserIP();
  $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$ip);
  $ccode =  $xml->geoplugin_countryCode ;
  $ccode = "DE";
  if (isset($ccode) && ($ccode == 'DE' || $ccode == 'AT' || $ccode == 'CH' || $ccode == 'LI' || $ccode == 'LU')) {
    header('location: /home/de');
    $lang = 'de';
  } else if (isset($ccode) && ($ccode == 'RU' || $ccode == 'AM' || $ccode == 'AZ' || $ccode == 'BZ' || $$code == "EE" || $$code == "GE" || $ccode == "KZ" || $ccode == "LV" || $ccode == "LT" || $ccode == "MD" || $ccode == "MN" || $ccode == "TJ" || $ccode == "TM" || $ccode == "UZ" || $ccode == "UA")) {
    header('location: /home/ru');
    $lang = 'ru';
  } else if (isset($ccode) && ($ccode == 'ZH' || $ccode == 'HK' || $ccode == 'SG' || $ccode == 'TW' || $ccode == 'ID' || $ccode == 'MY' || $ccode == 'TH')) {
    header('location: /home/zh');
    $lang = 'zh';
  } else if (isset($ccode) && ($ccode == 'BH' || $ccode == 'KM' || $ccode == 'TD' || $ccode == 'DJ' || $ccode == 'EG' || $ccode == 'ER' || $ccode == 'IQ' || $ccode == 'JO' || $ccode == 'KW' || $ccode == 'LB' || $ccode == 'LY' || $ccode == 'MR' || $ccode == 'MA' || $ccode == 'OM' || $ccode == 'QA' || $ccode == 'SA' || $ccode == 'SO' || $ccode == 'SS' || $ccode == 'SY' || $ccode == 'TZ' || $ccode == 'LB' || $ccode == 'TN' || $ccode == 'AE' || $ccode == 'YE' || $ccode == 'EH')) {
    header('location: /home/ar');
    $lang = 'ar';
  } else if (isset($ccode) && $ccode == 'GB') {
    header('location: /home/en');
    $lang = 'en';
  } else {
    header('location: /home/en');
    $lang = 'en';
  }
  exit();
} else {
  $lang = $uri[2];
}
$server = $_SERVER['HTTP_HOST'];
switch($server) {
  case 'krailler.clients.tedra.net':
    define('DB_SERV','127.0.0.1');
    define('DB_USER','devuser');
    define('DB_PASS','uYt-7d9-Cx7-Ws8-1Wa');
    define('DB_BASE','krailler');
    define('URL','/var/www/clients.tedra.net/krailler/');
    define('ADMIN_IMAGE_URL',URL.'images/');
    break;

  case 'krailler.dl':
    define('DB_SERV','127.0.0.1');
    define('DB_USER','root');
    define('DB_PASS','wqu0WsqRr**7');
    define('DB_BASE','krailler');
    define('URL','/Library/WebServer/Documents/projects/krailler.dl/');
    define('ADMIN_IMAGE_URL',URL.'images/');
    break;

  case 'krailler.test':
    define('DB_SERV','localhost');
    define('DB_USER','root');
    define('DB_PASS','c0l0m8ia');
    define('DB_BASE','krailler_db');
    define('URL','/Users/lloydthomas/Sites/krailler');
    define('ADMIN_IMAGE_URL',URL.'img/');
    break;

  default:

    define('DB_SERV','internal-db.s188151.gridserver.com');
    define('DB_USER','db188151_kra2');
    define('DB_PASS','v0-on@Td#201THRE4');
    define('DB_BASE','db188151_krailler_new');
    define('URL','/var/www/krailler.com/');
    define('ADMIN_IMAGE_URL',URL.'img/');
  break;

}

$db = new PDO('mysql:host='.DB_SERV.';dbname='.DB_BASE.';charset=utf8', DB_USER, DB_PASS);
if(isset($_POST['contact-submit-a'])){
  $input_a = $_POST['contact-submit-a'];
}
if(isset($_POST['contact-submit-b'])){
  $input_b = $_POST['contact-submit-b'];
}

if (isset($input_a) && isset($input_b) && $input_b == md5($input_a.'fuckoff')) {
  $json = json_encode($_POST);
  $data = $db->prepare("INSERT INTO peel_incoming (incoming_json,incoming_type,incoming_created) VALUES (:json,'contact',NOW());");
  $data->bindValue(':json', $json, PDO::PARAM_STR);
  $data->execute();
  $done = 1;
}

?>
