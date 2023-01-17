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
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
    }
    function countitem($item,$table){
    global $con;
    $sttament = $con->prepare("SELECT COUNT($item) FROM $table");
    $sttament->execute();
    $count=$sttament->fetchColumn();
    return $count;
    }
    function gitlatest($select,$table,$order,$limit=5){
    global $con;
    $stat = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $stat->execute();
    $row=$stat->fetchAll();
    return $row;
    }
