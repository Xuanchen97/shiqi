<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tbltransaction  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        header('location:manage-trades.php');
        $_SESSION['delmsg'] = "删除成功！";
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>记录</title>
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
                        <h4 class="header-line">销售记录</h4>
                    </div>
                    <div class="col-md-12">
                        <a href="add-tool.php">
                            <i class="fa fa-plus fa-2x" aria-hidden="true" style="color:palevioletred;"></i>
                            <span style="font-family: sans-serif; color: black;">创建新单</span>
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
                                记录
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>姓名</th>
                                                <!-- <th>地址</th> -->
                                                <th>产品</th>
                                                <th>斤数</th>
                                                <th>进价</th>
                                                <th>卖价</th>
                                                <th>利润</th>
                                                <th>销售日期</th>
                                                <th>更多</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * from  tbltransaction Order by date DESC;";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->name); ?></td>
                                                        <!-- <td class="center"><?php echo htmlentities($result->address); ?></td> -->
                                                        <td class="center"><?php echo htmlentities($result->product); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->unit); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->cost); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->sellingPrice); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->sellingPrice - $result->cost - $result->loss); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->date); ?></td>
                                                        <td class="center">
                                                            <a href="edit-trade.php?catid=<?php echo htmlentities($result->id); ?>"><button class="btn btn-primary"><i class="fa fa-edit "></i>详情</button></a>
                                                            <a href="manage-trades.php?del=<?php echo htmlentities($result->id); ?>" onclick="return confirm('确定要删除此订单吗？');"><button class=" btn btn-danger"> 删除</button></a>
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
<?php } ?>