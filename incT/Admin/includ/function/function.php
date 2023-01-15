<?php

    function gettitel(){
        global $pagetitel;
        if(isset($pagetitel)){
        echo $pagetitel;
        }else{
        echo "Admin";
        }
    }

    function redirecthome($erorrmsg,$secund=3){
    echo "<div class='alert alert-danger'>$erorrmsg</div>";
    echo "<div class='alert alert-info'>Erorr provies $secund</div>";
    header("refresh:$secund;url=index.php");
    }

    function checkitem($select,$from,$value){
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ? LIMIT 1");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
    }
