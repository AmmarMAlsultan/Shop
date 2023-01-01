<?php
session_start();
$pagetitel = 'Memebers';
if(isset($_SESSION['Username']))
{
     include "init.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if($do=='Manage')
    {
        //Manage page
    }elseif($do=='Edit'){
        echo 'Edit Page Memebers'.$_GET['ID'];
    }

    include $tpl."footer.php";
}
else{
    header('location:index.php');
    exit();
}

?>
