<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php

    echo $_GET["id"];

if (isset($_GET["id"])) {
    $SearchQueryParameter = $_GET['id'];
    global $ConnectingDB;
    $sql = "DELETE FROM admins WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
    if ($Execute) {
        add_user_log('delete user','deleted user: ' .$SearchQueryParameter);
        $_SESSION["SuccessMessage"] = "Admin Deleted Successfully";
        Redirect_to("admin_manage_users.php");
    }else{
        $_SESSION["ErrorMessage"] = "Something wet wrong. Try again.";
        Redirect_to("admin_manage_users.php");
    }
}

?>