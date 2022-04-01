<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php require_once("Includes/header.php"); ?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();
?>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- start navbar -->
    <?php include "Includes/navbar.php"; ?>
    <!-- end navbar -->

    <!-- START Header Main Area -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-users-cog text-success"></i> Admin Dashboard / Admin logged in: <?php echo $_SESSION['UserName']; ?></h1>
                </div>
            </div>
        </div>
    </header>
    <br>
    <!-- END Header Main Area -->


    <section class="container text-white">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                // $Statusresult = get_status_picklist();
                // $Klantenresult = get_klanten_picklist();
                // $Artikelresult = get_artikel_picklist();
                ?>

                <div class="row align-items-start text-black">
                    <div class="col-auto mb-2">
                        <form class="input-group" method="post" action="admin_dashboard.php">
                            <button type="submit" name="bestellingen_per_dag"  class="btn btn-success">Back</button>
                        </form>
                    </div>
                    <div class="col-auto">
                        <form class="input-group" method="post" action="#">
                            <!-- <button type="submit" name="Bestellingen_per_dag" class="btn btn-primary mb-3">Bestellingen per dag</button> -->
                        </form>
                    </div>
                    <div class="col-lg-3">
                      <div class="input-group">
                          <div class="input-group mb-3">
                          <form class="input-group" method="post" action="#">
                            <input type="text" class="form-control" name="gsearch" placeholder="wat zoekt u?" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <!-- <button class="btn btn-outline-secondary" type="submit" name="submit_gsearch" id="button-addon2">Button</button> -->
                            <input class="form-control btn btn-secondary" type="submit" name="submit_gsearch"  value="Zoeken">
                          </form>
                          </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <!-- <button type="submit" class="btn btn-primary mb-3">others</button> -->
                    </div>
                    <div class="col">

                    </div>

                  </div>
                </div>


                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>App</th>
                            <th>Activity</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <?php
                    global $conn;
                    global $ConnectingDB;
                    $showRecordPerPage = 50;
                    if(isset($_GET['page']) && !empty($_GET['page'])){
                        $currentPage = $_GET['page'];
                    }else{
                        $currentPage = 1;
                    }
                    $startFrom    = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
                    $totalDBSQL   = "SELECT date_time, user, app, activity,count(*) as counter
                                    FROM activity_log
                                    group by date(date_time), user, activity";

                    $allDBResult  = mysqli_query($conn, $totalDBSQL);
                    $TotalRows    = mysqli_num_rows($allDBResult);
                    $lastPage     = ceil($TotalRows/$showRecordPerPage);
                    $firstPage    = 1;
                    $nextPage     = $currentPage + 1;
                    $previousPage = $currentPage - 1;
                    if(!empty($_POST['submit_gsearch']) || !empty($_POST['gsearch'])){
                        $Search=$_POST['gsearch'];
                        $sql = "SELECT date_time, user, app, activity
                                    FROM activity_log
                                    WHERE concat(date_time,user,app,activity) like '%$Search%'
                                    group by date_time, user, activity
                                    ORDER by date_time DESC";
                    }else{
                        $sql = "SELECT date_time, user, app, activity,count(*) as counter
                                    FROM activity_log
                                    group by date_time, user, activity
                                    ORDER by date_time DESC";
                    }

                    $stmt         = $ConnectingDB->query($sql);
                    $Final_total = 0;
                    $Sr=0;
                    while ($DataRows = $stmt->fetch()){
                        // $Id         = $DataRows["id"];
                        $User       = $DataRows["user"];
                        $Date       = $DataRows["date_time"];
                        $App        = $DataRows["app"];
                        $Activity   = $DataRows["activity"];
                        $Sr++;
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $Date; ?></td>
                        <td><?php echo $User; ?></td>
                        <td><?php echo $App; ?></td>
                        <td><?php echo $Activity; ?></td>
                        <td>
                            <!-- <a href="produktie_view.php?date_bestel=<?php echo $DateBestelSearch; ?>"><span class="btn btn-primary">Bekijk Produktie</span></a> -->
                            <!-- <a href="produktie_print.php?date_bestel=<?php echo $DateBestelSearch; ?>"><span class="btn btn-secondary">Afrukken Produktie</span></a> -->
                            </a>
                        </td>
                    </tr>
                    </tbody>
                <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                         </tr>
                </table>
<!-- START Pagination -->
                <?php include_once "Includes/Show_Pagination.php"; ?>
<!-- END Pagination -->
            </div>
        </div>
    </section>


<!-- Modal content -->

<!-- Button trigger modal -->
    <!-- <?php include "bestelling_modal_view.php";?> -->

    <!-- Footer -->
    <!-- <?php include "Includes/footer.php";?> -->

    <script>
      $('.openModal').click(function(){
          var id = $(this).attr('data-id');
          $.ajax({url:"bestelling_modal_view.php?date_bestel="+id,cache:false,success:function(result){
              $(".modal-content").html(result);
          }});
      });
    </script>


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
