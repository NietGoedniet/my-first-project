<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php
if(isset($_POST["Submit"])){
  date_default_timezone_set("Europe/Berlin");
  $ProductName = $_POST["booking_name"];
  $DateBoeking = $_POST["date_booking"];
  $KG          = $_POST["kg"];
  $Price       = $_POST["price"];
  $nDate       = date("Y-m-d",strtotime($DateBoeking));
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(($ProductName === "--Product Selection---")){
    $_SESSION["ErrorMessage"]= "Please enter a Product Name";
    Redirect_to("production_admin.php");
  }elseif (empty($KG)){
    $_SESSION["ErrorMessage"]= "Please enter KG";
    Redirect_to("production_admin.php");
  }elseif (empty($Price)){
    $_SESSION["ErrorMessage"]= "Please enter Price";
    Redirect_to("production_admin.php");
  }else{
    // Query to insert Post in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO lalit_production(pdate,description,kg,price,total)";
    $sql .= "VALUES(:pdate_booking,:pdescription,:pkg,:pprice,:ptotal)";
    $stmt=$ConnectingDB->prepare($sql);
    $stmt->bindValue(':pdate_booking',$nDate);
    $stmt->bindValue(':pdescription',$ProductName);
    $stmt->bindValue(':pkg',$KG);
    $stmt->bindValue(':pprice',$Price);
    $stmt->bindValue(':ptotal',$Price*$KG);
    $Execute=$stmt->execute();
    $last_id = $ConnectingDB->lastInsertId();
    if($Execute){
      add_user_log('add booking','booking ID: '.$last_id. " Description:" . $ProductName ." Kg: " .$KG . " Price: " .$Price);
      $_SESSION["SuccessMessage"]="Product: " .$ProductName ." added Successfully";
      Redirect_to("booking_admin.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !" .$ProductName ." / " . $nDate;
      Redirect_to("booking_admin.php");
    }
  }
} //Ending of Submit Button If-Condition

?>
