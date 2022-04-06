<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php
if(isset($_POST["Submit"])){
  date_default_timezone_set("Europe/Berlin");
  $Description = $_POST["description"];
  $check_Product = check_product_exists($Description);
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(!empty($check_Product)){
    $_SESSION["ErrorMessage"]= "Product Name exists!";
    Redirect_to("product_admin.php");
  }else{
    // Query to insert Post in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO products(description)";
    $sql .= "VALUES(:pdescription)";
    $stmt=$ConnectingDB->prepare($sql);
    $stmt->bindValue(':pdescription',$Description);
    $Execute=$stmt->execute();
    $last_id = $ConnectingDB->lastInsertId();
    if($Execute){
      add_user_log('add product','product ID: '.$last_id. " Description:" . $Description);
      $_SESSION["SuccessMessage"]="Product: " .$Description ."added Successfully";
      Redirect_to("product_admin.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !" .$Description;
      Redirect_to("product_admin.php");
    }
  }
} //Ending of Submit Button If-Condition

?>
