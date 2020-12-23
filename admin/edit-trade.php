<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/timeZone.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {

    if (isset($_POST['update'])) {
        $comments = $_POST['comments'];
        $loss = $_POST['loss'];
        $catid = intval($_GET['catid']);
        $sql = "update tbltransaction set loss=:loss,comments=:comments where id=:catid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':comments', $comments, PDO::PARAM_STR);
        $query->bindParam(':loss', $loss, PDO::PARAM_STR);
        $query->bindParam(':catid', $catid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg'] = "更新成功！";
        header('location:manage-trades.php');
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>更新信息</title>
        <link rel="icon" href="assets/img/icon.ico">
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
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
                        <h4 class="header-line">详情</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class=" panel panel-default">
                        <div class="panel-heading">
                            详情
                        </div>

                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $catid = intval($_GET['catid']);
                                $sql = "SELECT * from tbltransaction where id=:catid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':catid', $catid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {               ?>

                                        <div class="form-group">
                                            <label>姓名 : </label>
                                            <span> <?php echo htmlentities($result->name); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>电话 : </label>
                                            <span> <?php echo htmlentities($result->phone); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>地址 : </label>
                                            <span> <?php echo htmlentities($result->address); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>产品 :</label>
                                            <span> <?php echo htmlentities($result->product); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>斤数 :</label>
                                            <span> <?php echo htmlentities($result->unit); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>进价 :</label>
                                            <span> <?php echo htmlentities($result->cost); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>售价 :</label>
                                            <span> <?php echo htmlentities($result->sellingPrice); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>快递公司 :</label>
                                            <span> <?php echo htmlentities($result->expressCompany); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>快递费用 :</label>
                                            <span> <?php echo htmlentities($result->expressFee); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>利润:</label>
                                            <span style="color: green; font-weight:bold;"> <?php echo htmlentities($result->sellingPrice - $result->cost - $result->loss); ?></span>
                                        </div>


                                        <div class="form-group">
                                            <label>赔损 :</label>
                                            <input class="form-control" type="number" name="loss" value="<?php echo htmlentities($result->loss); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>备注</label><br />
                                            <textarea rows="5" cols="40" name="comments"><?php echo htmlentities($result->comments); ?></textarea>
                                        </div>

                                <?php }
                                } ?>
                                <button type="submit" name="update" class="btn btn-info">更新</button>

                            </form>
                        </div>
                    </div>
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
        <!-- CUSTOM SCRIPTS  -->
               <!-- <script src="assets/js/custom.js"></script> -->
    </body>

    </html>
<?php } ?>