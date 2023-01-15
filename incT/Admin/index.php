<?php
    session_start();
    $Navbare = '';
    $pagetitel = 'Login';
    if(isset($_SESSION['Username']))
    {
       header('location:dashboard.php');
    }
    include "init.php";
    include  $tpl."haeder.php";
    // include $lang."englash.php";
    // include $lang . "arbic.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['user'];
    $password = $_POST['password'];
    $shpassword = sha1($password);


$stat = $con->prepare("SELECT UserID, Username, Passworduser FROM user WHERE Username=? AND Passworduser=? AND GroupID=1 LIMIT 1");
$stat->execute(array($username, $shpassword));
$row=$stat->fetch();
$count = $stat->rowCount();

if($count>0)
{
    // print_r($row);
    $_SESSION['Username'] = $username;
    $_SESSION['ID']=$row['UserID'];
    header('location:dashboard.php');
    exit();
}
//echo $username . " " . $password;
}
 ?>
 <!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Zenix - Crypto Admin Dashboard">
	<meta property="og:title" content="Zenix - Crypto Admin Dashboard">
	<meta property="og:description" content="Zenix - Crypto Admin Dashboard">
	<meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
    <title>Zenix -  Crypto Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<img src="images/logo-full.png" alt="">
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="user" value="">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" value="">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
													<input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
													<label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="page-register.html">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>
<!-- <form class="login" action="<?php //echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control" type="text" name="user" placeholder="username" autocomplete="off">
    <input class="form-control" type="text" name="password" placeholder="password" autocomplete="off">
    <input class="btn btn-primary btn-block" type="submit" value="Login">
</form> -->
<?php include $tpl."footer.php";?>