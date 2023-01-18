<?php
ob_start();
session_start();
$pagetitel = '';
if(isset($_SESSION['Username']))
{
    include 'init.php';
    $do=isset($_GET['do'])?$_GET['do']:'Manage';
    if($do=='Manage')
    {
        $stat = $con->prepare("SELECT * FROM categoriies");
        $stat->execute();
        $catg = $stat->fetchAll();
        ?>
            <h1 class="text-center">Manage Categories</h1>
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Categories</div>
                    <div class="panel-body">
                        <?php
                            foreach($catg as $catgo){
                            echo $catgo['NameCatg'].'</br>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php
    }
    elseif($do=='Add')
    {?>
         <h1 class="text-center">Add New Categroy</h1>
<div class="container text-center">
    <form class="form-horizontal text-center" action="?do=insert" method="POST">

        <div class="form-group">
            <label class="col-sm-4 control-label">Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Name Of The Categroe" required="required" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Description</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="description" class="form-control" placeholder="Enter Your Description" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Ordering</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="ordering"  class="form-control" placeholder="Number To Aeeange Categroe"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Visiblte</label>
            <div class="col-sm-10 col-md-4">
                <div class="text-left">
                    <input id="vis-yes" type="radio" name="visibility" value="0" checked/>
                    <label for="vis-yes">Yes</label>
                </div>
                <div class="text-left">
                    <input id="vis-no" type="radio" name="visibility" value="1"/>
                    <label for="vis-no">No</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Allow Comment</label>
            <div class="col-sm-10 col-md-4">
                <div class="text-left">
                    <input id="com-yes" type="radio" name="commenting" value="0" checked/>
                    <label for="com-yes">Yes</label>
                </div>
                <div class="text-left">
                    <input id="com-no" type="radio" name="commenting" value="1"/>
                    <label for="com-no">No</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Allow Ads</label>
            <div class="col-sm-10 col-md-4">
                <div class="text-left">
                    <input id="ads-yes" type="radio" name="ads" value="0" checked/>
                    <label for="ads-yes">Yes</label>
                </div>
                <div class="text-left">
                    <input id="ads-no" type="radio" name="ads" value="1"/>
                    <label for="ads-no">No</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-md-1">
                <button type="submit" value="Save" class="btn btn-primary">Add Categroy</button>
            </div>
        </div>
    </form>
</div>
    <?php }
    elseif($do=='insert')
    {
      if($_SERVER['REQUEST_METHOD']=='POST')
      { 
            echo'<h1 class="text-center">Insert Categroy</h1>';
            echo '<div class="container">';
    
                   $name        = $_POST['name'];
                   $descrp      = $_POST['description'];
                   $order       = $_POST['ordering'];
                   $visble      = $_POST['visibility'];
                   $comment     = $_POST['commenting'];
                   $ads         = $_POST['ads'];
                
                $chack = checkitem("NameCatg", "categoriies", $name);
                if($chack==1)
                {
                redirecthome('The name already exists');
                }
                else{
                    $stat = $con->prepare("INSERT INTO categoriies(NameCatg,DescriptionCatg,Ordering,Visibility,Allow_Comment,Allow_Ads)
                    VALUE(:aname,:adesc,:aorder,:avisiblte,:acomment,:aads)");
                    $stat->execute(
                        array(
                            'aname'      => $name,
                            'adesc'      => $descrp,
                            'aorder'     => $order,
                            'avisiblte'  => $visble,
                            'acomment'   => $comment,
                            'aads'       => $ads
                        )
                    );

                    echo '<div class="alert alert-success text-center">'.$stat->rowCount()." ". "Record Iserted".'</div>';
                }
 
     } 
     else
     {
        redirecthome("Error");
     }
   
    echo '</div>';
    }
    elseif($do=='Edit')
    {

    }
    elseif($do=='Update')
    {

    }
    elseif($do=='Delete')
    {

    }
    elseif($do=='Activate')
    {

    }
    include $tpl.'footer.php';   
}
else{
    header('location:index.php');
    exit();
}
ob_end_flush();
?>