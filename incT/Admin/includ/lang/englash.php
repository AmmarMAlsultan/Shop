<?php

     function lang($phiser)
    {
        static $lang=array(
            'MASAGE'        => 'Hello',
            'ADMIN'         =>'Admin',
            'CATEGROISE'    =>'Categroise',
            'ITEM'          =>'Item',
            'MEMBERS'       =>'Memebers',
            'STATISTICS'    =>'Statistics',
            'LOGS'          =>'Logs',
            'EDIT_PROFILE'  =>'Edit Profile',
            'SETTING'       =>'Setting',
            'LOGOUT'        =>'Logout',
            ''              =>''
        );
        return $lang[$phiser];
    }

?>