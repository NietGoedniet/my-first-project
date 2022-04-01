<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();
?>
<?php
if(isset($_POST["Submit"])){
    $UserName = $_POST["Username"];
    $Name = $_POST["Name"];
    $Password = $_POST["Password"];
    $ConfirmPassword = $_POST["ConfirmPassword"];
    $Admin = $_SESSION['UserName'];
    date_default_timezone_set("Europe/Berlin");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $check = CheckUserNameExistsOrNot($UserName);


    if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("admin_manage_users.php");
    }elseif (strlen($Password)<4){
        $_SESSION["ErrorMessage"] = "Password should be greater than 3 characters";
        Redirect_to("admin_manage_users.php");
    }elseif ($Password!==$ConfirmPassword){
        $_SESSION["ErrorMessage"] = "Password and Confirmed Password not matching";
        Redirect_to("admin_manage_users.php");
    }elseif (CheckUserNameExistsOrNot($UserName)){
        $_SESSION["ErrorMessage"] = "Username exists, try another one!";
        Redirect_to("admin_manage_users.php");

    }else{
        // Insert new admin
        $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
        $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
        $stmt=$ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime',$DateTime);
        $stmt->bindValue(':userName',$UserName);
        $stmt->bindValue(':password',$Password);
        $stmt->bindValue(':aName',$Name);
        $stmt->bindValue(':adminName',$Admin);
        $Execute=$stmt->execute();

        if($Execute){
            add_user_log('add user','added user: ' .$UserName);
            $_SESSION["SuccessMessage"] = "New Admin Added Successfully".$check;
            Redirect_to("admin_manage_users.php");
        }else {
            $_SESSION["ErrorMessage"] = "something wet wrong";
            Redirect_to("admin_manage_users.php");
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin Dashboard</title>
</head>
<html>
<body>
    <!-- start navbar -->
    <?php include "Includes/navbar.php"; ?>
    <!-- end navbar -->



    <!-- header -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1> <i class="fas fa-user" style="#27aae1"></i> Manage Users </h1>
                </div>
            </div>
        </div>

    </header>

    <section class="container py-2 mb-4>
        <div class="row">
            <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
                <form class="" action="admin_manage_users.php" method="post">
                    <div class="card bg-secondary text-light md3" >
                        <div class="card-header">
                            <h1>Add New User</h1>
                        </div>
                        <div class="card-body bg-dark text-white">
                            <div class="form-group">
                                <label for="username"><span class="FieldInfo"> Username: </span></label>
                                <input class="form-control" type="text" name="Username" id="Username" value="">
                            </div>
                            <div class="form-group">
                                <label for="Name"><span class="FieldInfo"> Admin Name: </span></label>
                                <input class="form-control" type="text" name="Name" id="Name" value="">
                                <small class="text-muted">Optional</small>
                            </div>
                            <div class="form-group">
                                <label for="password"><span class="FieldInfo"> Password: </span></label>
                                <input class="form-control" type="password" name="Password" id="Password" value="">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword"><span class="FieldInfo"> Confirm Password: </span></label>
                                <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" value="">
                            </div>


                            <div class="row">
                                <div class="col-lg-6 mt-2 d-grid gap-2">
                                    <a href="admin_dashboard.php" class="btn btn-warning"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
                                </div>
                                <div class="col-lg-6 mt-2  d-grid gap-2">
                                    <button type="submit" name="Submit" class="btn btn-success">
                                        <i class="fas fa-check"></i></a> Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <h2>Existing Admins</h2>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Date&Time</th>
                            <th>Username</th>
                            <th>Admin Name</th>
                            <th>Added by</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <?php
                    global $ConnectingDB;
                    $sql = "SELECT * FROM admins ORDER BY id desc";
                    $Execute = $ConnectingDB->query($sql);
                    $SrNo = 0;
                    while ($DataRows=$Execute->fetch()) {
                        $AdminId       = $DataRows['id'];
                        $DateTime      = $DataRows['datetime'];
                        $AdminUsername = $DataRows['username'];
                        $AdminName     = $DataRows['aname'];
                        $AddedBy       = $DataRows['addedby'];
                        $SrNo++;
                        //if (strlen($CommenterName)>10) {$CommenterName = substr($CommenterName, 0, 10).'..';}
                        //if (strlen($DateTimeComment)>11) {$DateTimeComment = substr($DateTimeComment, 0, 11).'..';}
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo htmlentities($SrNo)?></td>
                            <td><?php echo htmlentities($DateTime)?></td>
                            <td><?php echo htmlentities($AdminUsername)?></td>
                            <td><?php echo htmlentities($AdminName)?></td>
                            <td><?php echo htmlentities($AddedBy)?></td>
                            <td><a class="btn btn-danger" href="admin_delete_user.php?id=<?php echo $AdminId; ?>"> Delete</a></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>

            </div>
        </div>
    </section>



    <br>
    <!-- footer -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme By | Uli"> </p>
                </div>
            </div>
        </div>

    </footer>



    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
