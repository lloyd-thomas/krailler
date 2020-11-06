<?php if(!defined('PEEL')) die('Unable to start Peel.');

switch ($uri[2]) {
  case "manage-pages":
    include('site/controllers/manage-pages.php');
    break;
  case "manage-users":
    include('site/controllers/manage-users.php');
    break;
  default:
    if (file_exists('site/controllers/'.$uri[2].'.php')) include('site/controllers/'.$uri[2].'.php');
    break;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo PROJECT; ?></title>
  

    <!-- Bootstrap core CSS -->
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/css/bootstrap-override.css" rel="stylesheet">
    <link href="/admin/css/custom-sticky-footer.css" rel="stylesheet">
    <link href="/admin/css/datepicker.css" rel="stylesheet">
    <link href="/admin/css/font-awesome.min.css" rel="stylesheet" >

    <style>
      .pad-right { margin-right: 10px; }
    </style>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
