<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {


    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tool Library | Manage Tools</title>
        <link rel="icon" href="assets/img/icon.ico">
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Manage Tools</h4>
                    </div>
                    <div class="col-md-12">
                        <a href="add-tool.php">
                            <i class="fa fa-plus fa-2x" aria-hidden="true" style="color:#e7600c;"></i>
                            <span style="font-family: sans-serif; color: black;"> Add Tool</span>
                        </a>
                        &nbsp; &nbsp; &nbsp;
                        <a href="view-all-tools.php">
                            <i class="fa fa-list-alt fa-2x" aria-hidden="true" style="color:#e7600c;"></i>
                            <span style="font-family: sans-serif; color: black;"> List All Tools</span>
                        </a>
                    </div>
                    <div class="row">
                        <?php if ($_SESSION['error'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-danger">
                                    <strong>Error :</strong>
                                    <?php echo htmlentities($_SESSION['error']); ?>
                                    <?php echo htmlentities($_SESSION['error'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['msg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['updatemsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['updatemsg']); ?>
                                    <?php echo htmlentities($_SESSION['updatemsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>


                        <?php if ($_SESSION['delmsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                                    <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tool Listing
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tool Type</th>
                                                <th>Items</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * from  tbltype";

                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>

                                                        <td class="center"><?php echo htmlentities($result->TypeName); ?></td>
                                                        <!-- Sort all tools base on type -->
                                                        <?php $sql1 = "SELECT COUNT(*) as total from  tbltools where TypeId = $result->id";
                                                                    $query1 = $dbh->prepare($sql1);
                                                                    $query1->execute();
                                                                    $results1 = $query1->fetchAll();
                                                                    ?>
                                                        <td class="center"><?php echo htmlentities($results1[0][total]); ?></td>
                                                        <!-- Check tools are available or not -->
                                                        <?php $sql2 = "SELECT COUNT(*) as total from  tbltools where TypeId = $result->id and status=1";
                                                                    $query2 = $dbh->prepare($sql2);
                                                                    $query2->execute();
                                                                    $results2 = $query2->fetchAll();
                                                                    if ($results2[0][total] == 0) {
                                                                        ?>

                                                            <td class="center">
                                                                <li class="label label-danger">None Available</li>

                                                            </td>
                                                            <td class="center">
                                                                <a href="hold-tool.php?typeid=<?php echo htmlentities($result->id); ?>"><button class="btn btn-warning"><i class="fa fa-edit "></i> Hold&nbsp;</button></a>
                                                                <a href="hold-list.php?typeid=<?php echo htmlentities($result->id); ?>"><button class="btn btn-info"><i class="fa fa-edit "></i> Hold List</button></a>
                                                            </td>
                                                        <?php      } else { ?>
                                                            <td class="center">
                                                                <li class="label label-success"><?php echo htmlentities($results2[0][total]); ?> Available</li>

                                                                <!-- Check people on the waiting list are available or not -->
                                                                <?php $sql3 = "SELECT COUNT(*) as total from  tblholdtool where TypeId = $result->id and status=1";
                                                                                $query3 = $dbh->prepare($sql3);
                                                                                $query3->execute();
                                                                                $results3 = $query3->fetchAll();
                                                                                if ($results3[0][total] != 0) {
                                                                                    if ($results3[0][total] > $results2[0][total]) {
                                                                                        if ($results2[0][total] == 1) { ?>
                                                                            <li class="btn btn-warning btn-xs"><?php echo htmlentities($results2[0][total]); ?> people on hold list is ready to check out</li>
                                                                        <?php } else { ?>
                                                                            <li class="btn btn-warning btn-xs"><?php echo htmlentities($results2[0][total]); ?> peoples on hold list are ready to check out</li>
                                                                        <?php }
                                                                                            } else {
                                                                                                if ($results3[0][total] == 1) { ?>
                                                                            <li class="btn btn-warning btn-xs"><?php echo htmlentities($results3[0][total]); ?> people on hold list is ready to check out</li>
                                                                        <?php } else { ?>
                                                                            <li class="btn btn-warning btn-xs"><?php echo htmlentities($results3[0][total]); ?> peoples on hold list are ready to check out</li>


                                                                <?php }
                                                                                    }
                                                                                } ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php if ($results3[0][total] == 0) {  ?>
                                                                    <a href="manage-tool-items.php?typeid=<?php echo htmlentities($result->id); ?>"><button class="btn btn-success"><i class="fa fa-bookmark "></i> Select</button></a>
                                                                <?php } ?>
                                                                <?php if ($results3[0][total] > 0) {  ?>
                                                                    <a href="hold-list.php?typeid=<?php echo htmlentities($result->id); ?>"><button class="btn btn-info"><i class="fa fa-edit "></i> Hold List</button></a>
                                                                <?php } ?>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>



            </div>
        </div>

        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>