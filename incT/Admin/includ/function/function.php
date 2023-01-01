<?php

    function gettitel(){
        global $pagetitel;
        if(isset($pagetitel)){
        echo $pagetitel;
        }else{
        echo "Admin";
        }
    }

