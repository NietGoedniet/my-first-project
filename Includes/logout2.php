<?php
ob_start();
session_start();
if(isset($_SESSION['user_id'])) {
	session_destroy();
	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
	header("Location: Login2.php");
} else {
	header("Location: Login2.php");
}
?>
