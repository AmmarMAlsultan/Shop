<?php
session_start();
$pagetitel = 'Memebers';
if(isset($_SESSION['Username']))
{
     include "init.php";
     include $tpl."haeder.php";
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if($do=='Manage')
    {
        //Manage page
    }elseif($do=='Edit'){



        $userid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
        $stat = $con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1");
        $stat->execute(array($userid));
        $row=$stat->fetch();
        $count = $stat->rowCount();
        if($count>0)
        {?>
<h1 class="text-center">Edit Memebers</h1>
<div class="container text-c enter">
    <form class="form-horizontal text-center" action="?do=update" method="POST">
        <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
        <div class="form-group">
            <label class="col-sm-2 control-label">Usern Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="username" value="<?php echo $row['Username'] ?>" class="form-control" autocomplete="off" required="required" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10 col-md-4">
                <input type="hidden" name="oldpassword" value="<?php echo $row['Passworduser'] ?>" />
                <input type="password" name="newpassword" class="form-control" autocomplete="new-password" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10 col-md-4">
                <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="required"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Full Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="fullname" value="<?php echo $row['FulName'] ?>" class="form-control" required="required"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-md-1">
                <button type="submit" value="Save" class="form-control btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
<?php }
 }
 elseif($do=="update")
 {?>
    <h1 class="text-center">Edit Memebers</h1>
    <div class="container">
 <?php
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
                   $id          = $_POST['userid'];
                   $username    = $_POST['username'];
                   $email       = $_POST['email'];
                   $fullname    = $_POST['fullname'];
                   $pass =empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);
                   $erorrinput = array();

                if(strlen($username)<3)
                 {
                    $erorrinput[] = "<div class='alert alert-danger'> UserName Can Be Liss Than <strong>4 Charcter</strong></div>";
                 }  
                 if(empty($username))
                 {
                    $erorrinput[] = "<div class='alert alert-danger'>UserName Can Be <strong>Empty</strong></div>";
                 }
                 if(empty($email))
                 {
                    $erorrinput[] = "<div class='alert alert-danger'>Email Can Be <strong>Empty</strong></div>";
                 }
                 if(empty($fullname))
                 {
                    $erorrinput[] = "<div class='alert alert-danger'>FullName Can Be <strong>Empty</strong></div>";
                 }
                 foreach($erorrinput as $erorr)
                       echo $erorr;
                  
                if(empty($erorrinputr)){
                    $stat = $con->prepare("UPDATE users SET Username=?,Passworduser=?,Email=?,FulName=? WHERE UserID=?");
                    $stat->execute(array($username, $pass, $email, $fullname, $id));
                    echo '<div class="alert alert-success text-center">'.$stat->rowCount()." ". "Record Update".'</div>';
                 } 
                
  }
  else{
        echo 'Erorr';
  }

 echo '</div>';

}

    include $tpl."footer.php";
}
else{
    header('location:index.php');
    exit();
}

?>