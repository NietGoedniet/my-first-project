<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php
add_user_log('user logout','user: ' .$_SESSION['UserName']);
$_SESSION["UserId"]=null;
$_SESSION["UserName"]=null;
$_SESSION["AdminName"]=null;
session_destroy();
Redirect_to("Login.php");
?>