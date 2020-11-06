<?php

  if (isset($_GET['edit']) && $_GET['edit'] > 0) {
    $sql = "SELECT * FROM peel_users WHERE users_id = '".$_GET['edit']."' LIMIT 1;";
    $data = $db->prepare($sql);
    $data->execute();
    $edituser = $data->fetch();

  }

  if (isset($_POST['newsubmit']) && $_POST['newsubmit'] > 0) {
    $errors = NULL;

    if (empty($_POST['newemail']) || $_POST['newemail'] == '') {
      $errors++;
    }

    if (empty($_POST['newpassword']) || $_POST['newpassword'] == '') {
      $errors++;
    }

    if (!$errors) {
      $sql = "INSERT INTO peel_users (users_email, users_password, users_role, users_description, users_created) VALUES ('".$_POST['newemail']."','".md5($_POST['newpassword'].SALT)."','".$_POST['usertype']."','".$_POST['newdescription']."',NOW());";
      $data = $db->prepare($sql);
      $data->execute();
      set_message('User account created',ADMIN_LABEL_INFO);
      header('location:/admin/manage-users');
      exit();
    } else {
      set_message('Please fix errors in your submission',ADMIN_LABEL_INFO);
    }

  }

  if (isset($_POST['editsubmit']) && $_POST['editsubmit'] > 0) {
    $errors = NULL;

    if (empty($_POST['newemail']) || $_POST['newemail'] == '') {
      $errors++;
    }

    if (empty($_POST['newpassword']) || $_POST['newpassword'] <> $_POST['newpassword2']) {
      $errors++;
    }

    if (!$errors) {
      $sql = "UPDATE peel_users SET users_email = '".$_POST['newemail']."', users_password = md5('".$_POST['newpassword'].SALT."'), users_description = '".addslashes($_POST['newdescription'])."', users_role = '".$_POST['usertype']."' WHERE users_id = '".$_POST['user_id']."' LIMIT 1;";
      $data = $db->prepare($sql);
      $data->execute();
      set_message('User account edited',ADMIN_LABEL_INFO);
      header('location:/admin/manage-users');
      exit();
    } else {
      set_message('Please fix errors in your submission',ADMIN_LABEL_INFO);
    }
  }

  if (isset($_GET['delete']) && $_GET['delete'] > 0) {
    $sql = "DELETE FROM peel_users WHERE users_id = '".$_GET['delete']."' LIMIT 1;";
    $data = $db->prepare($sql);
    $data->execute();
    set_message('User account deleted',ADMIN_LABEL_INFO);
  }

  if (isset($_GET['lock']) && $_GET['lock'] > 0) {
    $sql = "UPDATE peel_users SET users_deletable = 1 WHERE users_id = '".$_GET['lock']."' LIMIT 1;";
    $data = $db->prepare($sql);
    $data->execute();
    set_message('User account locked',ADMIN_LABEL_INFO);
  }

  if (isset($_GET['unlock']) && $_GET['unlock'] > 0) {
    $sql = "UPDATE peel_users SET users_deletable = 0 WHERE users_id = '".$_GET['unlock']."' LIMIT 1;";
    $data = $db->prepare($sql);
    $data->execute();
    set_message('User account unlocked',ADMIN_LABEL_INFO);
  }

  $users = NULL;
  $sql = "SELECT *, date_format(users_created,'%h:%i %d/%m/%Y') as users_date FROM peel_users ORDER BY users_email ASC;";
  $data = $db->prepare($sql);
  $data->execute();
  while ($user = mysql_fetch_array($result)) $users[] = $user;

?>
