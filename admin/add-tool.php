<?php
require 'includes/address.php';
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/timeZone.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $product = $_POST['product'];
        $unit = $_POST['unit'];
        $expressCompany = $_POST['expressCompany'];
        $expressFee = $_POST['expressFee'];
        $cost = $_POST['cost'];
        $sellingPrice = $_POST['sellingPrice'];
        $employeeId = $_POST['employeeId'];

        $sql = "INSERT INTO tbltransaction(name, phone, address, product, unit, expressCompany,expressFee,date,cost,sellingPrice,employeeId) VALUES(:name,:phone,:address,:product,:unit,:expressCompany,:expressFee,'$current_time',:cost,:sellingPrice,:employeeId)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':unit', $unit, PDO::PARAM_STR);
        $query->bindParam(':product', $product, PDO::PARAM_STR);
        $query->bindParam(':expressFee', $expressFee, PDO::PARAM_STR);
        $query->bindParam(':expressCompany', $expressCompany, PDO::PARAM_STR);
        $query->bindParam(':cost', $cost, PDO::PARAM_STR);
        $query->bindParam(':sellingPrice', $sellingPrice, PDO::PARAM_STR);
        $query->bindParam(':employeeId', $employeeId, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Transaction inserted successfully";
            header('location:manage-trades.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-trades.php');
        }
    }



?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="donor" content="" />
        <title>诗淇家 | 新单</title>
        <link rel="icon" href="assets/img/icon.ico" sizes="160x160">
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
                        <h4 class="header-line">创建新单</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
                        <div class=" panel panel-default">
                        <div class="panel-heading">
                            创建新单
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>快捷粘贴AI识别</label><br />
                                    <textarea rows="5" cols="40" id="rawData" name="rawData"></textarea>
                                </div>

                                <button type="submit" id="identify" name="identify" class="btn btn-info">识别</button>
                                <hr />
                            </form>


                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>姓名<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" id="name" name="name" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>电话</label>
                                    <input class="form-control" type="text" id="phone" name="phone" autocomplete="off" />
                                </div>


                                <div class="form-group">
                                    <label>地址<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" id="address" name="address" autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label>产品<span style="color:red;">*</span></label>
                                    <select class="form-control" name="product" required>
                                        <option value="草莓-大果" selected="selected">草莓-大果</option>
                                        <option value="草莓-中果">草莓-中果</option>
                                        <option value="草莓-小果">草莓-小果</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>斤数</label>
                                    <input class="form-control" type="number" name="unit" autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label>售价</label>
                                    <input class="form-control" type="number" name="sellingPrice" autocomplete="off" />
                                </div>


                                <div class="form-group">
                                    <label>进价</label>
                                    <input class="form-control" type="number" name="cost" autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label>快递公司</label>
                                    <select class="form-control" name="expressCompany" required>
                                        <option value="shunfeng" selected="selected">顺丰</option>
                                        <option value="yunda">韵达</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>快递费</label>
                                    <input class="form-control" type="number" name="expressFee" autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label>代理人</label>
                                    <select class="form-control" name="employeeId">
                                        <option value="0">无</option>
                                        <?php
                                        $sql = "SELECT * from  tblemployee";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':status', $status, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {               ?>
                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->Name); ?></option>
                                        <?php }
                                        } ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>备注</label><br />
                                    <textarea rows="5" cols="40" name="comments"></textarea>
                                </div>


                                <button type="submit" id="submit" name="add" class="btn btn-info">添加</button>




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
<?php
    if (isset($_POST['identify'])) {
        $rawData = $_POST['rawData'];
        $address = "刘轩辰 129103223 上海上海市闵行区浦江镇永跃路550号";
        $r = Address::smart($rawData);
        //print_r($r);
        echo "<script>document.getElementById('rawData').value='{$rawData}'</script>";
        echo "<script>document.getElementById('name').value='{$r['name']}'</script>";
        echo "<script>document.getElementById('phone').value='{$r['mobile']}'</script>";
        echo "<script>document.getElementById('address').value='{$r['addr']}'</script>";
    }
}
?>