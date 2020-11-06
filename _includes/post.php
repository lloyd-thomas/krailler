<?php
$body = "New contact request via the website...

From: ".$_POST['name']."
Email: ".$_POST['email']."
Phone: ".$_POST['telephone']."

Their Message:
".$_POST['message']."

--

";

if (isset($_POST['email']) && $_POST['email'] <> '') {
//$body = print_r($_POST,true);
  //mail('dl@tedra.net','New contact request from Krailler.com',$body,'From: info@krailler.com'."\r\n".'Reply-To: contact4@krailler.com'."\r\n",'-finfo@krailler.com');
  //mail('lloyd@domh.net','New contact request from Krailler.com',$body,'From: info@krailler.com'."\r\n".'Reply-To: contact4@krailler.com'."\r\n",'-finfo@krailler.com');
  mail('gv@krailler.com','New contact request from Krailler.com',$body,'From: gv@krailler.com'."\r\n".'Reply-To: contact4@krailler.com'."\r\n",'-fgv@krailler.com');
}
?>
<span>Thank you. We will be in touch shortly.</span>
