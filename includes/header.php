<link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap&subset=latin-ext" rel="stylesheet">
<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand">

                <img src="assets/img/shiqi_logo.png" style="width:70px;    margin-top: -10%;" />

            </a>

        </div>
        <?php if ($_SESSION['login']) {
        ?>
            <div class="right-div" style="padding-right: 0;">
                <a href="logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true" style="color:palevioletred;"></i></a>
            </div>
        <?php } ?>
    </div>
</div>
<!-- LOGO HEADER END-->
<?php if ($_SESSION['login']) {
?>
    <section class="menu-section" style="border-bottom: 5px solid palevioletred;">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>


                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">My Profile</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Change Password</a></li>
                                </ul>
                            </li>
                            <li><a href="issued-books.php">Issued Books</a></li>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php } else { ?>
    <section class="menu-section" style="border-bottom: 5px solid palevioletred;">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">

                            <!-- <li><a href="adminlogin.php">Admin Login</a></li> -->
                            <!-- <li><a href="signup.php">User Signup</a></li>
                            <li><a href="index.php">User Login</a></li> -->


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php } ?>