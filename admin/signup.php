<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/timeZone.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../index.php');
} else {

    if (isset($_POST['signup'])) {

        //Code for user ID

        $UserId = $_POST['personalid'];
        $fname = $_POST['fullname'];
        $mobileno = $_POST['mobileno'];
        $mobileno2 = $_POST['mobileno2'];
        $education = $_POST['education'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $status = 1;
        $sql = "INSERT INTO  tblusers(UserId,FullName,Gender,Birthdate,Education,MobileNumber,MobileNumber2,Status,RegDate) VALUES(:UserId,:fname,:gender,:birthdate,:education,:mobileno,:mobileno2,:status,'$current_time')";
        $query = $dbh->prepare($sql);
        $query->bindParam(':UserId', $UserId, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':mobileno2', $mobileno2, PDO::PARAM_STR);
        $query->bindParam(':education', $education, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo '<script>alert("Success!")</script>';
            header('location:reg-users.php');
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Tool Library | User Signup</title>
    <link rel="icon" href="assets/img/icon.ico">
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
            .bootstrap-iso .formden_header h2,
            .bootstrap-iso .formden_header p,
            .bootstrap-iso form {
                font-family: Arial, Helvetica, sans-serif;
                color: black
            }

            .bootstrap-iso form button,
            .bootstrap-iso form button:hover {
                color: white !important;
            }

            .asteriskField {
                color: red;
            }
        </style>


    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_id.php",
                data: 'personalid=' + $("#personalid").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>

</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">User Signup</h4>
                </div>

            </div>
            <div class="row">

                <div class="col-md-9 col-md-offset-1"  style="margin-left: 13%;">
                    <div class="panel panel-danger">

                        <div class="panel-body">
                            <form name="signup" method="post" onsubmit="true">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <span class="asteriskField">
                                            *
                                        </span>
                                    <input class="form-control" type="text" name="fullname" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>National ID Number</label>
                                    <span class="asteriskField">
                                            *
                                        </span>
                                    <input class="form-control" type="text" name="personalid" id="personalid" autocomplete="off" onBlur="checkAvailability()" required />
                                    <span id="user-availability-status" style="font-size:16px;"></span>
                                </div>

                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <span class="asteriskField">
                                            *
                                        </span>
                                    <input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
                                    <label>Phone Number 2 (Optional)</label>
                                    <input class="form-control" type="text" name="mobileno2" maxlength="10" autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label for="date">
                                        Birthdate
                                    </label>
                                    <div class="bootstrap-iso" style="width: 30%;">

                                        <div class="form-group ">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar">
                                                    </i>
                                                </div>
                                                <input class="form-control" id="birthdate" name="birthdate"  placeholder="YYYY-MM-DD" type="text" />
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Gender </label>
                                    <select class="form-control" name="gender" id="gender" style="width: 30%;">
                                        <option value="Unknown" selected disabled hidden>--- Select ---</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Education </label>
                                    <select class="form-control" name="education" id="education" style="width: 30%;">
                                        <option value="Unknown" selected disabled hidden>--- Select ---</option>
                                        <option value="Formal">Formal</option>
                                        <option value="Informal">Informal</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>

                                <input type="checkbox" name="consent" required>User signed waiver and agrees to store the above personal data in our system.<br/><br/>


                                <button type="submit" name="signup" class="btn btn-danger" id="submit" >Register</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
           <!-- <script src="assets/js/custom.js"></script> -->


</body>

</html>


<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<script>
    $(document).ready(function() {
        var date_input = $('input[name="birthdate"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>