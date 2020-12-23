<?php
session_start();
include('includes/config.php');
include('includes/timeZone.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if($_SESSION['category'] == 'admin' || $_SESSION['category'] == 'manager' ){
    header('location:../index.php');
}else{
    if (isset($_POST['update'])) {
        $sid = intval($_GET['id']);;
        $fname = $_POST['fullname'];
        $phone = $_POST['mobileno'];
        $username = $_POST['username'];
        $sql = "update admin set FullName=:fname,Phone=:phone,userName =:username,updationDate='$current_time' where id=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Profile has been updated")</script>';
    }

?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>编辑个人信息</title>
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
                编辑账户
              </div>
              <div class="panel-body">
                <form role="form" method="post" onSubmit="return valid();" name="chngpwd">
                <div class="row pad-botm">
                        <div class="col-md-12">
                          <h4 class="header-line">个人信息</h4>
                        </div>
                      </div>
                  <?php
                  $sid =intval($_GET['id']);
                  $sql = "SELECT FullName,Phone,userName,UpdationDate from  admin  where id=:sid ";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                    foreach ($results as $result) {               ?>
                      <div class="form-group">
                        <label>用户名 : </label>
                        <input class="form-control" type="text" name="username" autocomplete="off" required value='<?php echo htmlentities($result->userName); ?>'/>
                      </div>
                    <div class="form-group">
                          <label>姓名 : </label>
                          <input class="form-control" type="text" name="fullname" autocomplete="off" required value='<?php echo htmlentities($result->FullName); ?>'/>
                          
                        </div>
                        <div class="form-group">
                          <label>电话: </label>
                          <input class="form-control" type="text" name="mobileno" autocomplete="off"  value='<?php echo htmlentities($result->Phone); ?>'/>
                        </div>

                        <?php if ($result->UpdationDate != "") { ?>
                            <div class="form-group">
                                <label>最近更新时间 : </label>
                                <?php echo htmlentities($result->UpdationDate); ?>
                            </div>
                        <?php } ?>

                    <button type="submit" name="update" class="btn btn-success">更新信息</button>
                    <a href="change-password.php?id=<?php echo htmlentities($result->userName); ?>" class="btn btn-info">更改密码</a>
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