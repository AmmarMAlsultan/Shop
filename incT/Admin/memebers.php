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

        $stat = $con->prepare("SELECT * FROM user WHERE GroupID != 1 ");
        $stat->execute();
        $rows = $stat->fetchAll();

        ?>
     <h1 class="text-center">Manage Memebers</h1>
    <div class="container">
        <div class="table-responsive text-center">
            <table class="main-table table table-bordered  table-striped">
                <tr>
                    <td>#ID</td>
                    <td>UserName</td>
                    <td>Email</td>
                    <td>FullName</td>
                    <td>Registerd Data</td>
                    <td>Control</td>
                </tr>
                <?php
                    foreach($rows as $row)
                    {
                    echo '<tr>';
                    echo '<td>'.$row['UserID'].'</td>';
                    echo '<td>'.$row['Username'].'</td>';
                    echo '<td>'.$row['Email'].'</td>';
                    echo '<td>'.$row['FulName'].'</td>';
                    echo '<td>'.$row['Add_Date'].'</td>';
                    echo '<td>
                    <a href="memebers.php?do=Edit&ID='.$row['UserID'].'"class="btn btn-success">Edit</a>
                    <a href="memebers.php?do=Delete&ID='.$row['UserID'].'" class="btn btn-danger confirm">Delete</a>
                    </td>';
                    echo '</tr>';
                    }
                ?>
            </table>
        </div>
        <a href="memebers.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add Member</a>
    </div>
    <?php }

    elseif($do=='Add')
    { ?>
        <h1 class="text-center">Add New Memebers</h1>
<div class="container text-center">
    <form class="form-horizontal text-center" action="?do=insert" method="POST">
        <div class="form-group">
            <label class="col-sm-4 control-label">Usern Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Enter UserName" required="required" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Password</label>
            <div class="col-sm-10 col-md-4">
                <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Enter Your Password" required="required" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Email</label>
            <div class="col-sm-10 col-md-4">
                <input type="email" name="email"  class="form-control" placeholder="Enter Your Email" required="required"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Full Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="fullname" placeholder="Enter FullName" class="form-control" required="required"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-md-1">
                <button type="submit" value="Save" class="btn btn-primary">Add Member</button>
            </div>
        </div>
    </form>
</div>
    <?php }
    elseif($do=='insert')
    {
        
     
      if($_SERVER['REQUEST_METHOD']=='POST')
       { ?>
                <h1 class="text-center">Insert Memebers</h1>
                <div class="container">
            <?php
                    $username    = $_POST['username'];
                    $pass        = $_POST['password'];
                    $email       = $_POST['email'];
                    $fullname    = $_POST['fullname'];
                    
                    $hashpass    = sha1($_POST['password']);

                    $erorrinput  = array();
    
                    if(strlen($username)<3)
                     {
                        $erorrinput[] = "UserName Can Be Liss Than <strong>4 Charcter</strong>";
                     }  
                     if(empty($username))
                     {
                        $erorrinput[] = "UserName Can Be <strong>Empty</strong>";
                     }
                     if(empty($pass))
                     {
                        $erorrinput[] = "Password Can Be <strong>Empty</strong>";
                     }
                     if(empty($email))
                     {
                        $erorrinput[] = "Email Can Be <strong>Empty</strong>";
                     }
                     if(empty($fullname))
                     {
                        $erorrinput[] = "FullName Can Be <strong>Empty</strong>";
                     }
                     foreach($erorrinput as $erorr)
                           echo "<div class='alert alert-danger'>".$erorr."</div>";
                      
                    if(empty($erorrinputr)){

                         $chack = checkitem("Username", "user", $username);
                         if($chack==1)
                         {
                         echo 'Ali';
                         }
                         else{
                            $stat = $con->prepare("INSERT INTO user(Username,Passworduser,Email,FulName,Add_Date)VALUE(:auser,:apass,:aemail,:afullname,now())");
                            $stat->execute(
                                array(
                                    'auser'      => $username,
                                    'apass'      => $hashpass,
                                    'aemail'     => $email,
                                    'afullname'  => $fullname
                                )
                            );
    
                            echo '<div class="alert alert-success text-center">'.$stat->rowCount()." ". "Record Iserted".'</div>';
                         }

                        
                     } 
                    
      } else {
            redirecthome("Error");
         }
    
     echo '</div>';
    
    }


    elseif($do=='Edit'){
        $userid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
        $stat = $con->prepare("SELECT * FROM user WHERE UserID=? LIMIT 1");
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
            <label class="col-sm-4 control-label">Usern Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="username" value="<?php echo $row['Username'] ?>" class="form-control" autocomplete="off" required="required" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Password</label>
            <div class="col-sm-10 col-md-4">
                <input type="hidden" name="oldpassword"  value="<?php echo $row['Passworduser'] ?>" />
                <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Email</label>
            <div class="col-sm-10 col-md-4">
                <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="required"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Full Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="fullname" value="<?php echo $row['FulName'] ?>" class="form-control" required="required"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-md-1">
                <button type="submit" value="Save" class="btn btn-primary">Save Edit</button>
            </div>
        </div>
    </form>
</div>
<?php }
 }
 elseif($do=="update")
 {?>
    <h1 class="text-center">Update Memebers</h1>
    <div class="container">
 <?php
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
                   $id          = $_POST['userid'];
                   $username    = $_POST['username'];
                   $email       = $_POST['email'];
                   $fullname    = $_POST['fullname'];
                   $pass        = empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);
                   $erorrinput  = array();

                   if(strlen($username)<3)
                   {
                      $erorrinput[] = "UserName Can Be Liss Than <strong>4 Charcter</strong>";
                   }  
                   if(empty($username))
                   {
                      $erorrinput[] = "UserName Can Be <strong>Empty</strong>";
                   }
                   if(empty($email))
                   {
                      $erorrinput[] = "Email Can Be <strong>Empty</strong>";
                   }
                   if(empty($fullname))
                   {
                      $erorrinput[] = "FullName Can Be <strong>Empty</strong>";
                   }
                   foreach($erorrinput as $erorr)
                         echo "<div class='alert alert-danger'>".$erorr."</div>";
                    
                  if(empty($erorrinputr)){
                      $stat = $con->prepare("UPDATE user SET Username=?,Passworduser=?,Email=?,FulName=?,Add_Date=now() WHERE UserID=?");
                      $stat->execute(array($username, $pass, $email, $fullname, $id));
                      echo '<div class="alert alert-success text-center">'.$stat->rowCount()." ". "Record Update".'</div>';
                   }
  }
  else{
        echo 'Erorr';
  }
 echo '</div>';
}
elseif($do='Delete'){?>
    <h1 class="text-center">Delete Memebers</h1>
    <div class="container text-center">
    <?php
    $userid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
    $stat = $con->prepare("SELECT * FROM user WHERE UserID=? LIMIT 1");
    $stat->execute(array($userid));
    $count = $stat->rowCount();

        if ($count > 0) {
            $stst = $con->prepare("DELETE FROM user WHERE UserID = $userid");
            // $stat->bindParam(':auserid',$userid);
            $stst->execute();
            echo '<div class="alert alert-success text-center">'.$stat->rowCount()." ". "Record Deleted".'</div>';
        }
        else{
                echo "Member Not Found  ";
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