<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php
$SearchQueryParameter=$_GET['id'];
if(isset($_POST["Submit"])){
  $ProductId    = $_GET["id"];
  $DateBooking  = date("Y-m-d",strtotime($_POST["date_booking"]));
  $pDescription = $_POST["product_name"];
  $pKG          = $_POST["kg"];
  $pPrice       = $_POST["price"];
  $pTotal       = $pKG * $pPrice;

  date_default_timezone_set("Europe/Berlin");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
  if(empty($ProductId)){
    $_SESSION["ErrorMessage"]= "Please provide Product ID";
    Redirect_to("booking_admin.php");
  }else{
    global $ConnectingDB;
    $sql="UPDATE lalit_production SET pdate='$DateBooking', description='$pDescription', kg='$pKG',price='$pPrice', total='$pTotal' WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
    if($Execute){
      add_user_log('update booking','booking ID: '.$ProductId. " Description:" . $ProductName ." Kg: " .$pKG . " Price: " .$pPrice);
      $_SESSION["SuccessMessage"]="Booking ID.: " .$ProductId . " updated successfully";
      Redirect_to("booking_admin.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("booking_admin.php");
    }
  }
} //Ending of Submit Button If-Condition

?>