<?php
session_start();
$pagetitel = 'Dashboard';
if(isset($_SESSION['Username']))
{
     include "init.php";
    ?>
    <div class="container home-stats text-center">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="stat total_member">Total Members
                    <span><a href="memebers.php"><?php echo countitem('UserID', 'user'); ?></a></span>
                </div>
                
            </div>
            <div class="col-md-3">
                <div class="stat pending_member">Pending Members
                    <span><a href="memebers.php?do=Manage&page=pending"><?php echo checkitem("RegStatus","user",0) ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat total_item">Total Item
                    <span>100</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat total_comment">Total Comments
                    <span>100</span>
                </div>
            </div>
        </div>
    </div>
    <div class="latest">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php $rownumber = 5; ?>
                            <i class="fa fa-user">Latest <?php echo $rownumber ?> Registerd User</i>
                        </div>
                        <div class="panel-body">
                            <?php
                            $arraylatest = gitlatest('*', 'user', 'UserID',$rownumber);
                            foreach($arraylatest as $user){
                                echo '<div class="alert alert-info">'.$user['Username'].'<span class="latest-btn btn btn-success pull-right"><a href="memebers.php?do=Edit&ID=' . $user['UserID'] . '">Edit</a></span>'.'</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tag">Latest Added</i>
                        </div>
                        <div class="panel-body">
                            Test
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    

    include $tpl."footer.php";
}
else{
    header('location:index.php');
    exit();
}

?>
