<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {


    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT userName,password FROM admin WHERE userName=:username and password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location ='admin/add-tool.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>盛诗淇</title>
    <link rel="icon" href="assets/img/icon.ico">
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/login.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/style.css" rel="stylesheet" />

    <style>

    </style>
</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line" style="text-align: center;">诗淇家管理系统</h4>
                </div>
            </div>

            <!--LOGIN PANEL START-->

            <form class="login" role="form" method="post" >
                <input type="text" placeholder="Username" name="username" autocomplete="off" required>
                <input type="password" placeholder="Password" name="password" autocomplete="off" required>
                <button type="submit" name="login">Login</button>
            </form>

            <!---LOGIN PABNEL END-->


        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>

</body>

</html>