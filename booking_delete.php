<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php

if (isset($_GET["id"])) {
    $SearchQueryParameter = $_GET['id'];
    global $ConnectingDB;
    $sql = "DELETE FROM lalit_production WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
    if($Execute){
      add_user_log('delete booking','booking ID: ' . $SearchQueryParameter);
      $_SESSION["SuccessMessage"]="Booking No.: " .$SearchQueryParameter ." deleted successfully";
      Redirect_to("booking_admin.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("booking_admin.php");
    }
}

?>