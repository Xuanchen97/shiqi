<?php
session_start();
error_reporting(0);
$date = date("Y-m-d", strtotime('-30 days'));
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:../index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>主页</title>
    <link rel="icon" href="assets/img/icon.ico">
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">主页</h4>

          </div>

        </div>

        <div class="row">

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-success back-widget-set text-center">
              <i class="fa fa-file-text  fa-5x"></i>
              <?php
              $sql = "SELECT * FROM `tbltransaction` WHERE date_sub(curdate(), INTERVAL 30 DAY) <= DATE(`date`);";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $listAll = $query->rowCount();

              ?>


              <h3><?php echo htmlentities($listAll); ?></h3>

              <label>近30天成交单数 (<?php echo htmlentities($date); ?>至今)</label>
              <!-- <form method="post" action="Report/download-rental-records.php">
                <input class="btn btn-link" type="submit" name="export" style="color:black;" value="Tools Rental Records (.csv)" />
              </form> -->

            </div>
          </div>


          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-money fa-5x"></i>
              <?php
              $sql = "SELECT SUM(sellingPrice - cost - loss) AS profit FROM `tbltransaction` WHERE date_sub(curdate(), INTERVAL 30 DAY) <= DATE(`date`);";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $listAll = $query->rowCount();
              ?>
              <h3><?php echo htmlentities($results[0]->profit) ?></h3>

              <label>近30天盈利总额 (<?php echo htmlentities($date); ?>至今)</label>
            </div>
          </div>


          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-danger back-widget-set text-center">
              <i class="fa fa-list-alt  fa-5x"></i>
              <?php
              $sql = "SELECT * FROM `tbltransaction`";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $listAll = $query->rowCount();
              ?>
              <h3><?php echo htmlentities($listAll); ?></h3>

              <label>累计成交单数</label>

            </div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center">
              <i class="fa fa-dollar fa-5x"></i>
              <?php
              $sql = "SELECT SUM(sellingPrice - cost - loss) AS profit FROM `tbltransaction`;";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $listAll = $query->rowCount();
              ?>
              <h3><?php echo htmlentities($results[0]->profit) ?></h3>

              <label>累计盈利总额</label>
            </div>
          </div>



          <!-- <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center">
              <i class="fa fa-handshake-o fa-5x"></i>
              <?php

              $sql = "SELECT  id from tbldonors where status = 1;";
              $query1 = $dbh->prepare($sql);
              $query1->execute();
              $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
              $donor = $query1->rowCount();
              ?>

              <h3><?php echo htmlentities($donor); ?></h3>
              <form method="post" action="Report/download-all-donors.php">
                <input class="btn btn-link" type="submit" name="export" style="color:black;" value="Donors (.csv)" />
              </form>
            </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-danger back-widget-set text-center">
              <i class="fa fa-users fa-5x"></i>
              <?php
              $sql3 = "SELECT id from tblusers ";
              $query3 = $dbh->prepare($sql3);
              $query3->execute();
              $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
              $regstds = $query3->rowCount();
              ?>
              <h3><?php echo htmlentities($regstds); ?></h3>
              <form method="post" action="Report/download-all-users.php">
                <input class="btn btn-link" type="submit" name="export" style="color:black;" value=" Registered Users (.csv)" />
              </form>
             
            </div>
          </div>  -->

        </div>




        <div class="col-lg-6 mb-4">

          <!-- Pie chart -->
          <br /><br />

          <!-- 
    <div class="text-center">
    <canvas id="doughnutChart" style="width:50%"></canvas>
    
    </div> -->




          <!-- 
          <canvas id="lineChart" style=""></canvas>

 -->


        </div>




      </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> -->
    <!-- CUSTOM SCRIPTS  -->
    <!--        <!-- <script src="assets/js/custom.js"></script> -->
    <script src="assets/js/DoughnutChart.js"></script>
    <script src="assets/js/lineChart.js"></script> -->
  </body>

  </html>
<?php } ?>