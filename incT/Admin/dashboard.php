<?php
session_start();
$pagetitel = 'Dashboard';
if(isset($_SESSION['Username']))
{
     include "init.php";

    print_r($_SESSION);

    include $tpl."footer.php";
}
else{
    header('location:index.php');
    exit();
}

?>
