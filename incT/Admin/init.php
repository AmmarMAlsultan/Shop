<?php

    include "conect_db.php";

    $tpl    ='includ/template/';
    $lng    ="includ/lang/";
    $fun    = "includ/function/";
    $css    ='thames/css/';
    $js     ='thames/js/';
    $nav    ="includ/template/";

    include $lng. "englash.php";
    include $fun. "function.php";
    include $tpl."haeder.php";

if(!isset($Navbare)){include $nav . "navbare.php";}

?>