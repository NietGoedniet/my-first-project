<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<!--    <?php require_once("Includes/header.php"); ?> -->
<html>
    <title>Booking Admin</title>
</head>
<body>
    <!-- start navbar -->
    <?php include "Includes/navbar.php"; ?>
    <!-- end navbar -->

    <!-- START Header Main Area -->
    <!-- <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1><a href="" target="_blank" title="Help Faktuur Admin"><i class="fas fa-address-book text-success"></i></a> Booking Admin </h1>
                </div>
            </div>
        </div>
    </header> -->
    <br>
    <!-- END Header Main Area -->
    <a href="booking_admin.php"><span class="btn mb-2 btn-success">Back</span></a>

    <section class="container text-white">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <table class="table table-borderless table-hover table-responsive">
                    <thead class="table-info">
                        <tr>
                           <th>Datum</th>
                           <th>Description</th>
                           <th>KG</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#faktuurModal">Add Booking</button>
                            </th>
                        </tr>
                    </thead>

                    <?php
                    global $conn;
                    global $ConnectingDB;
                    $sql          = "SELECT * from lalit_production order by pdate desc";
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
