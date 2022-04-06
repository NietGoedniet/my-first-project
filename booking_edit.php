<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<!--    <?php require_once("Includes/header.php"); ?> -->
<html>
    <title>Lalit Production Admin</title>
</head>
<body>
    <!-- start navbar -->
    <?php include "Includes/navbar.php"; ?>
    <!-- end navbar -->

    <!-- START Header Main Area -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><a href="" target="_blank" title="Booking Admin"><i class="fas fa-address-book text-success"></i></a> Booking Admin - Edit  </h1>
                </div>
            </div>
        </div>
    </header>
    <br>
    <!-- END Header Main Area -->

    <section class="container text-white">
        <div class="row">
            <div class="col-lg-6 mt-4">
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                $Productresult = get_booking_picklist();

                global $ConnectingDB;
                $SearchQueryParameter=$_GET['id'];
                $sql = "SELECT * from lalit_production where id='$SearchQueryParameter'";
                $stmt = $ConnectingDB->query($sql);
                $Sr = 0;
                while ($DataRows = $stmt->fetch()){
                  $Id    = $DataRows["id"];
                  $Description = $DataRows["description"];
                  $pDate = $DataRows["pdate"];
                  $Kg    = $DataRows["kg"];
                  $Price = $DataRows["price"];
                  $Total = $DataRows["total"];
                  $Sr++;
               }     
               ?>
               
               <form id="ProductForm" name="contact" role="form" method="post" action="booking_update.php?id=<?php echo $Id; ?>" >
                     <div class="modal-body">
                        <div class="form-group bg-info text-light">
                           <label for="date_booking">Date</label>
                           <input type="text" id="example5" name="date_booking" class="form-control" placeholder="DD-MM-YYY" value="<?php echo date('d-m-Y',strtotime($pDate)) ?>">
                        </div>
                        <div class="form-group bg-info text-light">
                           <label for="product_name">Name Product</label>
                           <select class="form-control" name="product_name">
                                 <option>--Product Selection---</option>

                                 <?php foreach($Productresult as $key => $value){?>
                                        <?php if($Description==$value['description']){ ?>
                                            <option selected='selected' value="<?= $value['description']; ?>">
                                                 <?= $value['description']; ?>
                                            </option>
                                        <?php }else{ ?>
                                            <option value="<?= $value['description']; ?>">
                                                <?= $value['description']; ?>
                                            </option>
                                        <?php } ?>
                         
                                 <?php } ?>
                           </select>
                        </div>
                        <div class="form-group bg-info text-light">
                           <label for="date_booking">KG</label>
                           <input type="text" id="example5" name="kg" class="form-control" placeholder="enter KG" value="<?php echo $Kg ?>">
                        </div>
                        <div class="form-group bg-info text-light">
                           <label for="price">Price</label>
                           <input type="text" id="example5" name="price" class="form-control" placeholder="enter Price" value="<?php echo $Price ?>">
                        </div>
                     </div>
                     <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-bs-dismiss="modal" href="booking_admin.php">Close</button> -->
                        <a href="booking_admin.php"><span class="btn btn-secondary">Back</span></a>
                        <input type="submit" name="Submit" class="btn btn-success" id="submit">
                     </div>
               </form>
            </div>
         </div>
    </section>

    <!-- Footer -->
    <?php include "Includes/footer.php";?>
    <!-- script for modal popup -->
    <script>
        $('#ProductForm').on('submit', function(e){
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
