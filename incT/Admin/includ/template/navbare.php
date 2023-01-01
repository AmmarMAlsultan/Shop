<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <!-- <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#app-nav"
                aria-expanded="false">
                <li class="fa fa-solid fa-user"></li>
                <li class="fa fa-solid fa-user"></li>
                <li class="fa fa-solid fa-user"></li>
            </button> -->
            <a class="navbar-brand" href="#"><?php echo lang ('ADMIN') ?></a>
        </div>
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="nav navbar-nav">
                <li><a href="#"><?php echo lang ('CATEGROISE') ?></a></li>
                <li><a href="#"><?php echo lang ('ITEM') ?></a></li>
                <li><a href="memebers.php"><?php echo lang ('MEMBERS') ?></a></li>
                <li><a href="#"><?php echo lang ('STATISTICS') ?></a></li>
                <li><a href="#"><?php echo lang ('LOGS') ?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true"><?php echo ($_SESSION['Username'])?></a>
                     <ul class="dropdown-menu">
                        <li><a href="memebers.php?do=Edit&ID=<?php echo $_SESSION['ID'] ?>"><?php echo lang ('EDIT_PROFILE') ?></a></li>
                        <li><a href="#"><?php echo lang ('SETTING') ?></a></li>
                        <li><a href="logout.php"><?php echo lang ('LOGOUT') ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>