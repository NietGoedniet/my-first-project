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
                    <h1><a href="" target="_blank" title="Help Faktuur Admin"><i class="fas fa-address-book text-success"></i></a> Product Admin </h1>
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
                <table class="table table-borderless table-hover table-responsive">
                    <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#faktuurModal">Add Product</button>
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
                                            FROM products
                                            WHERE description like '%$Search%' ";
                    }else{
                        $totalDBSQL   = "SELECT * FROM products";
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
                                    from products
                                    WHERE description like '%$Search%'
                                    order by description desc
                                    LIMIT $startFrom, $showRecordPerPage";
                    }else{
                        $sql = "SELECT * 
                                    from products
                                    order by description asc
                                    LIMIT $startFrom, $showRecordPerPage";          
                    }

                    $stmt         = $ConnectingDB->query($sql);
                    $Sr = 0;
                    echo FilterMessage();
                    while ($DataRows = $stmt->fetch()){
                        $Id          = $DataRows["id"];
                        $Description = $DataRows["description"];
                        $Sr++;
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $Id; ?></td>
                        <td><?php echo $Description; ?></td>
                        <td>
                            <div class="btn-group">
                                <!-- <a href="product_edit.php?id=<?php echo $Id; ?>">
                                    <span class="btn-sm btn-warning">
                                        <i class="fas fa-edit text-white" data-toggle="tooltip" title="Edit"></i>
                                    </span></a> -->
                                <a href="product_delete.php?id=<?php echo $Id; ?>">
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
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="faktuurForm" name="contact" role="form" method="post" action="product_add.php" >
            <div class="modal-body">

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control" placeholder="enter Description" value="">
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
