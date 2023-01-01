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


$stat = $con->prepare("SELECT UserID, Username, Passworduser FROM users WHERE Username=? AND Passworduser=? AND GroupID=1 LIMIT 1");
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
<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control" type="text" name="user" placeholder="username" autocomplete="off">
    <input class="form-control" type="text" name="password" placeholder="password" autocomplete="off">
    <input class="btn btn-primary btn-block" type="submit" value="Login">
</form>
<?php include $tpl."footer.php";?>