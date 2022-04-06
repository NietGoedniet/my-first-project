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
    <title>Report Admin</title>
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
                     Reports
                     &nbsp&nbsp   
                    <a href="admin_log_files.php" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i>
                    </a>
                    </h1>
                </div>

                <div class="col-lg-2 d-grid gap-2">
                    <a href="https://app.powerbi.com/reportEmbed?reportId=7efa6dd0-87c4-45d8-bf6e-38a33cdaddec&autoAuth=true&ctid=d235cb18-4396-4c75-83cb-e72815ec235f&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLXNvdXRoLWVhc3QtYXNpYS1iLXByaW1hcnktcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQvIn0%3D" target="_blank" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plug"></i> PowerBi
                    </a>
                </div>
                <div class="col-lg-2 d-grid gap-2">
                    <a href="#" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plug"></i> Report 2
                    </a>
                </div>
                <div class="col-lg-2 d-grid gap-2">
                    <a href="#" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plug"></i> Report 2
                    </a>
                </div>
                <div class="col-lg-2 d-grid gap-2">
                    <a href="#" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plug"></i> Report 2
                    </a>
                </div>
                <div class="col-lg-2 d-grid gap-2">
                    <a href="#" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plug"></i> Report 2
                    </a>
                </div>

            </div>
        </div>
    </header>
    <!-- Main area-->


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
