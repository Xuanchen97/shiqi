<?php
session_start();
error_reporting(0);
include('includes/config.php');
$current_time = date("Y-m-d");
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {
    if ($_SESSION['category'] == 'admin' || $_SESSION['category'] == 'manager') {
        header('location:../index.php');
    }else{
    // code for block user    
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $status = -1;
        $sql = "update tblusers set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-users.php');
    }

    //code for active users
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = 1;
        $sql = "update tblusers set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-users.php');
    }

    //check user over due status
    include('includes/check-userstatus.php');


    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tool Library | Manage Admin</title>
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
                        <h4 class="header-line">Management</h4>
                    </div>
<!-- 
                    <div class="col-md-12">
                        <a href="create-admin.php">
                            <i class="fa fa-plus fa-2x" aria-hidden="true" style="color:palevioletred;"></i>
                            &nbsp;
                            <span style="font-family: sans-serif; color: black;"> Create New Account</span>
                        </a>
                    </div> -->

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Users
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>姓名</th>
                                                <th>用户名</th>
                                                <th>权限</th>
                                                <th>电话</th>
                                                <th>最近更新时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * from admin";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->FullName); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->userName); ?></td>
                                                        <?php if($result->category == 'owner'){?>
                                                        <td class="center" style="color:red"><?php echo htmlentities($result->category); ?></td>
                                                        <?php }else{?>
                                                            <td class="center" style="color:green"><?php echo htmlentities($result->category); ?></td>
                                                        <?php }?>

                                                        <?php if($result->Phone == null){?>
                                                            <td class="center">N/A</td>
                                                        <?php }else{?>
                                                            <td class="center"><?php echo htmlentities($result->Phone); ?></td>
                                                        <?php }?>

                                                        <td class="center"><?php echo htmlentities($result->updationDate); ?></td>
                                                        <td class="center">
                                                            <a href="edit-admin.php?id=<?php echo htmlentities($result->id); ?>"><button class=" btn btn-primary"> <i class="fa fa-edit "></i> 编辑</button></a>
                                                            <!-- <a href="reg-users.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to remove this admin account?');"><button class=" btn btn-danger"> Remove</button></a> -->
                                                        </td>
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
               <!-- <script src="assets/js/custom.js"></script> -->


    </body>

    </html>
<?php }} ?>