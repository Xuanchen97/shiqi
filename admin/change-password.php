<?php
session_start();
include('includes/config.php');
include('includes/timeZone.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if($_SESSION['category'] == 'admin' || $_SESSION['category'] == 'manager'){
    header('location:../index.php');
}else{
  if (isset($_POST['change'])) {
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $username = $_GET['id'];
    $sql = "SELECT Password FROM admin where userName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update admin set Password=:newpassword where userName=:username";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo '<script>alert("Your password has been changed successfully")</script>';
    } else {
      $error = "Your current password is incorrect";
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
    <title>更改密码</title>
    <link rel="icon" href="assets/img/icon.png">
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }

      .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }
    </style>
  </head>
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password Field does not match!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <!--LOGIN PANEL START-->
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                Account Setting
              </div>
              <div class="panel-body">
                <form role="form" method="post" onSubmit="return valid();" name="chngpwd">
                <div class="row pad-botm">
                        <div class="col-md-12">
                          <h4 class="header-line">Change Password</h4>
                        </div>
                      </div>
                  <?php
                  $username =$_GET['id'];
                  $sql = "SELECT FullName,Phone,userName,UpdationDate from  admin  where userName=:username ";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':username', $username, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                    foreach ($results as $result) {               ?>
                      <div class="form-group">
                        <label>Username(Login Name) : </label>
                      <?php echo htmlentities($result->userName); ?>
                       
                      </div>

                        <div class="form-group">
                          <label>Full Name : </label>
                          <?php echo htmlentities($result->FullName); ?>
                        </div>

                        <div class="form-group">
                          <label>Phone: </label>
                          <?php echo htmlentities($result->Phone); ?>
                        </div>
                     

                      <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                      <div class="form-group">
                        <label>Current Password</label>
                        <input class="form-control" type="password" name="password" autocomplete="off" required />
                      </div>
                      <div class="form-group">
                        <label>New Password</label>
                        <input class="form-control" type="password" name="newpassword" autocomplete="off" required />
                      </div>
                      <div class="form-group">
                        <label>Confirm Password </label>
                        <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                      </div>
                      <button type="submit" name="change" class="btn btn-info">Update Password</button>
                  <?php }
                  } ?>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!---LOGIN PABNEL END-->


      </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
           <!-- <script src="assets/js/custom.js"></script> -->
  </body>

  </html>
<?php }} ?>