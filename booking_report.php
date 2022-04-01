<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/db_mysql.php"); ?>
<?php require_once("Includes/Function.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php require_once("Includes/header.php"); ?>
<html>
<body>
    <!-- start navbar -->
    <?php include "Includes/navbar.php"; ?>
    <!-- end navbar -->

    <header class="bg-dark text-white py-3">

      <div class="container">
        <div class="col-md-6">
            <h1><a href="" target="_blank" title="Help Faktuur Admin"><i class="fas fa-address-book text-success"></i></a> Booking Report Selection </h1>
        </div>
        <form method="post" action="booking_month_table_report.php">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="year">Year</label>
                <select id="year" name="year" class="form-control">
                  <option>2022</option>
                  <option selected>2021</option>
                  <option>2020</option>
                  <option>2019</option>
                  <option>2018</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="month">Month</label>
                <select id="month" name="month" class="form-control">
                  <option selected>January</option>
                  <option>February</option>
                  <option>March</option>
                  <option>April</option>
                  <option>May</option>
                  <option>June</option>
                  <option>July</option>
                  <option>August</option>
                  <option>September</option>
                  <option>October</option>
                  <option>November</option>
                  <option>December</option>
                </select>
              </div>
            </div>
            <div class="form-row mt-4">
              <button type="submit" name="Submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        <div>
    </header>
        
   <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
