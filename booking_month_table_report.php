<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php require_once("Includes/header.php"); ?>


<html>
    <title>Booking Month Report</title>
</head>
<body>
    <!-- start navbar -->
    <?php include "Includes/navbar.php"; ?>
    <!-- end navbar -->

    <!-- START Header Main Area -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php if(isset($_POST['month'])){?>
                        <h1><a href="" target="_blank" title="Help Faktuur Admin"><i 
                            class="fas fa-address-book text-success"></i></a> Report Booking - <?php echo $_POST['month']; ?> <?php echo $_POST['year']; ?> </h1>
                    <?php }else{?>
                        <h1><a href="" target="_blank" title="Help Faktuur Admin"><i class="fas fa-address-book text-success"></i></a> Booking Month Report </h1>
                    <?php }?>
                </div>
            </div>
        
            <div class="col">
                <i class="fas fa-folder-plug"></i>
                <form class="input-group" method="post" action="booking_report.php">
                    <button type="submit" name="report"  class="btn btn-success">Reports</button>
                </form>
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
                // echo InfoMessage();
               //  $Statusresult = get_status_picklist();
                // $Productresult = get_booking_picklist();
                ?>
                
                <div class="row align-items-start text-black">
                  <div class="col">
                      <div></div>
                  </div>

                  <div class="col">
                    <div class="input-group">
                    </div>
                  </div>

                </div>
                <?PHP
                if(isset($_POST['month'])){
                    $Month = $_POST['month'];
                    $Year = $_POST['year'];
                    $sql = "SELECT total
                            from lalit_production
                            where monthname(pdate)='$Month' and year(pdate) ='$Year'
                            order by pdate desc";
                    $MonthTotal=0;
                    $stmt = $ConnectingDB->query($sql);
                    while ($DataRows = $stmt->fetch()){
                        $MonthTotal += $DataRows['total'];
                    }
                }
                $_SESSION["InfoMessage"]= "Total Month ".$_POST['month']. " ".$_POST['year']. ": ".$MonthTotal." B$";
                echo InfoMessage();
                ?>     
                <table class="table table-borderless table-hover table-responsive">
                    <thead class="table-info">
                        <tr>
                           <th>Date</th>
                           <th>Description</th>
                           <th style="text-align:right">KG</th>
                           <th style="text-align:right">Price</th>
                           <th style="text-align:right">Total</th>

                        </tr>
                    </thead>

                    <?php
                    global $conn;
                    global $ConnectingDB;
                    $showRecordPerPage = 10;
                    if(isset($_GET['page']) && !empty($_GET['page'])){
                        $currentPage = $_GET['page'];
                    }else{
                        $currentPage = 1;
                    }
                    $startFrom    = ($currentPage * $showRecordPerPage) - $showRecordPerPage;

                    if (!empty($_POST['submit_gsearch'])&&(!empty($_POST['gsearch']))) {
                        $Search=$_POST['gsearch'];
                        $totalDBSQL   = "SELECT * 
                                            FROM lalit_production
                                            WHERE concat(date_format(pdate,'%d-%m-%Y'), description, kg, price) like '%$Search%' ";
                    }else{
                        $totalDBSQL   = "SELECT * FROM lalit_production";
                    }
                    
                    $allDBResult  = mysqli_query($conn, $totalDBSQL);
                    $TotalRows    = mysqli_num_rows($allDBResult);
                    $lastPage     = ceil($TotalRows/$showRecordPerPage);
                    $firstPage    = 1;
                    $nextPage     = $currentPage + 1;
                    $previousPage = $currentPage - 1;


                    if(isset($_POST['month'])){
                        $Month = $_POST['month'];
                        $Year = $_POST['year'];
                        $sql = "SELECT *
                                from lalit_production
                                where monthname(pdate)='$Month' and year(pdate) ='$Year'
                                order by pdate desc";          

                    }else{

                        $sql = "SELECT * 
                                from lalit_production
                                order by pdate desc
                                LIMIT $startFrom, $showRecordPerPage";          
                    }

                    $stmt         = $ConnectingDB->query($sql);
                    $Sr = 0;
                    echo FilterMessage();
                    $MonthTotal=0;
                    while ($DataRows = $stmt->fetch()){
                        $Id    = $DataRows["id"];
                        $Description = $DataRows["description"];
                        $pDate = $DataRows["pdate"];
                        $Kg    = $DataRows["kg"];
                        $Price = $DataRows["price"];
                        $Total = $DataRows["total"];
                        $MonthTotal += $Total;
                        $Sr++;
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo date('d-m-Y',strtotime($pDate)); ?></td>
                        <td><?php echo $Description; ?></td>
                        <td style="text-align:right"><?php echo number_format($Kg,2); ?></td>
                        <td style="text-align:right"><?php echo number_format($Price,2); ?></td>
                        <td style="text-align:right"><?php echo number_format($Total,2); ?></td>
                        <!-- <td>
                            <div class="btn-group">
                                <a href="booking_report1.php?id=<?php echo $Id; ?>">
                                    <span class="btn-sm btn-secondary" >
                                    <i class="fas fa-print" data-toggle="tooltip" title="Print"></i>
                                    </span></a>
                                <a href="booking_edit.php?id=<?php echo $Id; ?>">
                                    <span class="btn-sm btn-warning">
                                        <i class="fas fa-edit text-white" data-toggle="tooltip" title="Edit"></i>
                                    </span></a>
                                <a href="booking_delete.php?id=<?php echo $Id; ?>">
                                    <span class="btn-sm btn-danger" >
                                    <i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i>
                                    </span></a>
                            </div>
                        </td> -->
                    </tr>
                    </tbody>
                <?php } ?>
                </table>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "Includes/footer.php";?>
    <!-- script for modal popup -->
    <script>
        $('#faktuurForm').on('submit', function(e){
          $('#faktuuModal').modal('show');
          e.preventDefault();
        });
    </script>
    <!-- Script for tooltips popup -->
    <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <!-- for datepcker -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example5').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy"
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#example6').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy"
            });
        });
    </script>

    <!-- Important for Modal -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
