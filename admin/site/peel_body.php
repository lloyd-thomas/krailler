<?php if(!defined('PEEL')) die('Unable to start Peel.');

$pages = get_pages();

?>
<body>

      <div id="loading">
      <div id="clock">
        <span class="hand second"></span>
      </div>
    </div>

  <div id="wrap">

       <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin"><?php echo PROJECT ?>.</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
                <ul class="dropdown-menu">
<?php for ($x=0;$x<sizeof($pages);$x++) { ?>
                  <li><a href="/admin/<?php echo $pages[$x]['pages_slug']; ?>"><?php echo $pages[$x]['pages_title']; ?></a></li>
<?php } ?>
                </ul>
              </li>
<?php if (isset($_SESSION['admin']['email']) && $_SESSION['admin']['role'] == md5('admin'.$_SESSION['admin']['email'].SALT)) { ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/admin/manage-pages">Manage Pages</a></li>
                  <li><a href="/admin/manage-users">Manage Users</a></li>
                </ul>
              </li>
<?php } ?>
            </ul>
<?php if (isset($_SESSION['admin']['email']) && (md5($_SESSION['admin']['email'].SALT)) == $_SESSION['admin']['authenticated']) { ?>
            <ul class="nav navbar-nav navbar-right">​
              <li><a href="/admin/sign-out" class="navbar-right">Sign out</a></li>
            </ul>

<?php } else { ?>
            <form method="post" action="" class="navbar-form navbar-right" role="form">
              <input type="hidden" name="authenticate" value="1" />
              <div class="form-group">
                <input type="text" placeholder="Email" name="email" class="form-control">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" name="password" class="form-control">
              </div>
              <button type="submit" class="btn btn-success">Sign in</button>
            </form>
<?php } ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>

      <!-- Begin page content -->
      <div class="container">

 <?php if (isset($_SESSION['admin']['message']) && $_SESSION['admin']['message'] <> '') { ?>

    <div class="alert fade in<?php if (isset($_SESSION['admin']['message_style'])) echo " alert-".$_SESSION['admin']['message_style']; ?>">
      <?php echo $_SESSION['admin']['message']; ?>
      <a href="#" class="close" data-dismiss="alert">×</a>
    </div>

<?php

displayed_message(); // clear displayed message

}
?>

<?php if (isset($_SESSION['admin']['email']) && (md5($_SESSION['admin']['email'].SALT)) == $_SESSION['admin']['authenticated']) {

switch ($uri[2]) {
  case "manage-pages":
    include('site/pages/manage-pages.php');
    break;
  case "manage-users":
    include('site/pages/manage-users.php');
    break;
  default:
    if (file_exists('site/pages/'.$uri[2].'.php')) {
      include('site/pages/'.$uri[2].'.php');
    } else if (isset($uri[2]) && $uri[2] <> '') {
      include('site/pages/admin-404.php');
    } else {
      include('site/pages/admin-home.php');
    }
    break;
}

} ?>

      </div>
    </div>
