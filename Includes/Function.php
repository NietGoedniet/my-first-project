<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php
function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
}

function show_page_name(){
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    return $curPageName;
}

function Login_Attempt($UserName,$Password){
  global $ConnectingDB;
  $sql = "SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userName',$UserName);
  $stmt->bindValue(':passWord',$Password);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return $Found_Account=$stmt->fetch();
  }else {
    return null;
  }
}
function Confirm_Login(){
if (isset($_SESSION["UserId"])) {
  return true;
}  else {
  $_SESSION["ErrorMessage"]="Login Required !";
  Redirect_to("Login.php");
}
}

function add_user_log($App,$Activity){
    global $conn;
    date_default_timezone_set("Europe/Berlin");
    $DateTime = date('Y-m-d H:i:s');
    $User = $_SESSION['UserName'];
    $Check = False;
    $sql = "INSERT INTO activity_log (user, date_time, app, activity)
            Values ('$User', now(), '$App', '$Activity')";
    $Execute = $conn->query($sql);
    if ($Execute) {
        $Check=True;
    }else{
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    return $Check;
}

function check_faktuur_exists($Search){
    global $conn;
    $sql = "SELECT id FROM faktuur where klanten_id = $Search and status='nieuw'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    $row = mysqli_fetch_row($result);
    $Faknum = $row[0];

    return $Faknum;
}

function check_product_exists($Search){
    global $conn;
    $sql = "SELECT * FROM products where description = '$Search'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    $row = mysqli_fetch_row($result);
    $pCheck = $row[0];

    return $pCheck;
}

function CheckUserNameExistsOrNot($UserName){
    global $ConnectingDB;
    $sql = "SELECT username FROM admins WHERE username=:userName";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':userName',$UserName);
    $stmt->execute();
    $Result = $stmt->rowcount();
    if ($Result>=1) {
        return true;
    }else{
        return false;
    }
}

function TotalBoekingen($Search){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM lalit_production where description = '$Search'";
    $stmtApprove = $ConnectingDB->query($sql);
    $TotalRows = $stmtApprove->fetch();
    $TotalPosts = array_shift($TotalRows);
    return $TotalPosts;
}

function get_artikel_info($ArtikelNr){
    global $conn;
    $sql = "SELECT prijs FROM artikel WHERE artikel_nr='$ArtikelNr'";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    $row = mysqli_fetch_row($result);
    $APrijs = $row[0];
    //$mysqli -> close();
    return $APrijs;
}

function get_faktuur_bedrag($FakNr){
    global $conn;
    $sql = "SELECT sum(bedrag) FROM boekingen WHERE faktuur_nr='$FakNr'";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    $row = mysqli_fetch_row($result);
    $TotalBoekingen = $row[0];
    //$mysqli -> close();
    return $TotalBoekingen;
}

function get_booking_picklist(){
    global $conn;
    $select = "SELECT * FROM products";
    $Productresult = mysqli_query ($conn, $select);
    return $Productresult;
}

function get_status_picklist(){
    global $conn;
    $select = "SELECT * FROM status";
    $Statusresult = mysqli_query ($conn, $select);
    return $Statusresult;
}
function get_artikel_picklist(){
    global $conn;
    $select = "SELECT * FROM artikel";
    $Artikelresult = mysqli_query ($conn, $select);
    return $Artikelresult;
}
function get_day_picklist(){
    global $conn;
    $select = "SELECT * FROM day_names";
    $Dayresult = mysqli_query ($conn, $select);
    return $Dayresult;
}

function get_klanten_details($Search){
    global $conn;
    $select = "SELECT * FROM klanten WHERE id='$Search'";
    $Klantenresult = mysqli_query ($conn, $select);
    return $Klantenresult;
}

?>
