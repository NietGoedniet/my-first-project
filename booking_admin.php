<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php require_once("Includes/header.php"); ?>
<html>
    <title>Booking Admin</title>
</head>
<body>
    <!-- start navbar -->
    <?php include "Includes/navbar.php"; ?>
    <!-- end navbar -->

    <!-- START Header Main Area -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1><a href="" target="_blank" title="Help Faktuur Admin"><i class="fas fa-address-book text-success"></i></a> Booking Admin </h1>
                </div>
                <div class="col-md-2">
                </div>
                  <div class="col-md-4 mt-2">
                    <div class="input-group">
                        <div class="input-group">
                        <form class="input-group" method="post" action="#">
                          <input type="text" class="form-control" name="gsearch" id="search" placeholder="?" aria-label="Recipient's username" aria-describedby="button-addon2">
                          <!-- <button class="btn btn-outline-secondary" type="submit" name="submit_gsearch" id="button-addon2">Button</button> -->
                          <input class="form-control btn btn-secondary" type="submit" name="submit_gsearch"  value="Search">
                        </form>
                        </div>
                    </div>
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
                echo InfoMessage();
               //  $Statusresult = get_status_picklist();
                $Productresult = get_booking_picklist();
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
                <table class="table table-borderless table-hover table-responsive">
                    <thead class="table-info">
                        <tr>
                           <th>Date</th>
                           <th>Description</th>
                           <th style="text-align:right">KG</th>
                            <th style="text-align:right">Price</th>
                            <th style="text-align:right">Total</th>
                            <th>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#faktuurModal">Add Booking</button>
                            </th>
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

                    if (!empty($_POST['submit_gsearch'])&&(!empty($_POST['gsearch']))) {
                        $Search=$_POST['gsearch'];
                        $_SESSION["FilterMessage"] = "Search filter on: ".$Search;
                                        
                        $sql = "SELECT * 
                                    from lalit_production
                                    WHERE concat(date_format(pdate,'%d-%m-%Y'), description, kg, price) like '%$Search%'
                                    order by pdate desc
                                    LIMIT $startFrom, $showRecordPerPage";
                    }else{
                        $sql = "SELECT * 
                                    from lalit_production
                                    order by pdate desc
                                    LIMIT $startFrom, $showRecordPerPage";          
                    }

                    $stmt         = $ConnectingDB->query($sql);
                    $Sr = 0;
                    echo FilterMessage();
                    while ($DataRows = $stmt->fetch()){
                        $Id    = $DataRows["id"];
                        $Description = $DataRows["description"];
                        $pDate = $DataRows["pdate"];
                        $Kg    = $DataRows["kg"];
                        $Price = $DataRows["price"];
                        $Total = $DataRows["total"];
                        $Sr++;
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo date('d-m-Y',strtotime($pDate)); ?></td>
                        <td><?php echo $Description; ?></td>
                        <td style="text-align:right"><?php echo number_format($Kg,2); ?></td>
                        <td style="text-align:right"><?php echo number_format($Price,2); ?></td>
                        <td style="text-align:right"><?php echo number_format($Total,2); ?></td>
                        <td>
                            <div class="btn-group">
                                <!-- <a href="booking_report1.php?id=<?php echo $Id; ?>">
                                    <span class="btn-sm btn-secondary" >
                                    <i class="fas fa-print" data-toggle="tooltip" title="Print"></i>
                                    </span></a> -->
                                <a href="booking_edit.php?id=<?php echo $Id; ?>">
                                    <span class="btn-sm btn-warning">
                                        <i class="fas fa-edit text-white" data-toggle="tooltip" title="Edit"></i>
                                    </span></a>
                                <a href="booking_delete.php?id=<?php echo $Id; ?>">
                                    <span class="btn-sm btn-danger" >
                                    <i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i>
                                    </span></a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                <?php } ?>
                </table>
<!-- START Pagination -->
                <?php include_once "Includes/Show_Pagination.php"; ?>
<!-- END Pagination -->
            </div>
        </div>
    </section>

<!-- Modal content -->

<!-- Modal add boeking -->
<div class="modal fade" id="faktuurModal" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add production for a certain date</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="faktuurForm" name="contact" role="form" method="post" action="booking_add.php" >
            <div class="modal-body">
                <div class="form-group">
                    <label for="date_booking">Date</label>
                    <input type="text" id="example5" name="date_booking" class="form-control" placeholder="DD-MM-YYY" value="<?php echo date('d-m-Y') ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="booking_name">Name Product</label>
                    <select class="form-control" name="booking_name">
                        <option>--Product Selection---</option>
                        <?php foreach($Productresult as $value){ ?>
                          <option value="<?= $value['description'];?>"><?= $value['description']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_booking">KG</label>
                    <input type="text" id="example5" name="kg" class="form-control" placeholder="enter KG" value="">
                </div>
                <div class="form-group">
                    <label for="date_booking">Price</label>
                    <input type="text" id="example5" name="price" class="form-control" placeholder="enter Price" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <input type="submit" name="Submit" class="btn btn-success" id="submit">
            </div>
        </form>
      </div>
    </div>
</div>


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
