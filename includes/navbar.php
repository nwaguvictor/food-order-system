<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-tranperent shadow">
    <a href="index.php" class="navbar-brand"><i class="fa fa-shopping-cart fa-fw"></i>BelleFul Chefs</a>
    <button class="navbar-toggler" type="button" data-target="#myNav" data-toggle="collapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="myNav">
        <ul class="navbar-nav ml-auto">
            <?php
                if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') { ?>
                    <li class="nav-item"><a href="account" class="nav-link"><i class="fa fa-user-secret fa-fw"></i>Manage</a></li>

            <?php    }
            ?>

            <li class="nav-item"><a href="kitchen.php" class="nav-link"><i class="fa fa-fw fa-cutlery"></i>Kitchen</a></li>
            <li class="nav-item"><a href="view_cart.php" class="nav-link">Make Orders Now</a></li>

            <?php
                if (isset($_SESSION['user'])){ ?>
                    <li class="nav-item"><a href="account/logout.php" class="nav-link"><i class="fa fa-power-off fa-fw"></i>Logout</a></li>

            <?php    } else {

                echo '<li class="nav-item"><a href="" class="nav-link" id="login-modal">Sign In</a></li>';
            }
            ?>

            <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-users fa-fw"></i>Our Chefs</a></li>
            <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-info-circle fa-fw"></i>About Us</a></li>
        </ul>
    </div>
</nav>
