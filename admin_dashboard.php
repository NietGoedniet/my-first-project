<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php require_once("Includes/header.php"); ?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();
?>
<!DOCTYPE html>
<html lang="en"
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- start navbar -->
    <?php include "Includes/navbar.php"; ?>
    <!-- end navbar -->

<html>
<body>
    <!-- header -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-tools"></i>
                     Admin Dashboard
                    </h1>
                </div>
                <div class="col-lg-3 d-grid gap-2">
                    <a href="admin_log_files.php" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i> View Log Files
                    </a>
                </div>
                <div class="col-lg-3 d-grid gap-2">
                    <a href="admin_manage_users.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plug"></i> User Admin
                    </a>
                </div>
                <div class="col-lg-3 d-grid gap-2">
                    <a href="admin_report.php" class="btn btn-warning btn-block">
                        <i class="fas fa-user-plus"></i> Reports
                    </a>
                </div>
                <div class="col-lg-3 d-grid gap-2">
                    <a href="#" class="btn btn-success btn-block">
                        <!-- <i class="fas fa-check "></i> Approve Comments -->
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- Main area-->


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
