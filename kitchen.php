<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ORDER FOR FOOD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>

<?php include("account/admin_partials/db.php") ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a href="index.php" class="navbar-brand"><i class="fa fa-shopping-cart fa-fw"></i>BelleFul Chefs</a>
    <button class="navbar-toggler" type="button" data-target="#myNav" data-toggle="collapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="myNav">
        <ul class="navbar-nav">

            <li class="nav-item"><a href="index.php" class="nav-link"><i class="fa fa-home fa-fw"></i>Home</a></li>
            <?php
                session_start();
                if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') { ?>
                    <li class="nav-item"><a href="account" class="nav-link"><i class="fa fa-user-secret fa-fw"></i>Manage</a></li>

            <?php    }
            ?>
        </ul>

        <ul class="navbar-nav ml-auto">

            <?php
                if (isset($_SESSION['user'])){ ?>
                    <li class="nav-item"><a href="user_orders_list.php" class="nav-link"><i class="fa fa-list-ol fa-fw"></i>Orders list</a></li>
                    <li class="nav-item"><a href="account/logout.php" class="nav-link"><i class="fa fa-power-off fa-fw"></i>Logout</a></li>
                    <li class="nav-item"><a href="user_profile.php" class="nav-link"><i class="fa fa-user-o fa-fw"></i>Profile</a></li>

            <?php    } else { ?>

                <li class="nav-item"><a href="#" class="nav-link" id="login-modal"><i class="fa fa-sign-in fa-fw"></i>Sign In</a></li>
           <?php }
            ?>

            <li class="nav-item"><a href="view_cart.php" class="nav-link"><i class="fa fa-cart-plus fa-lg fa-fw">
            </i><sup><span class="badge badge-danger"><b id="cart_count"></b></span></sup></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid mt-5">
    <p class="pt-4">Click on the add button to add foods to your cart
        <a title="Adding food to cart" href="#" class=""><i class="fa fa-info-circle"></i></a>
    </p>

<div class="row p-2">
    <?php

        $query = $conn->query("SELECT * FROM food_menu ORDER BY food_id DESC");
        if($query->num_rows > 0) {
            while($row = $query->fetch_assoc()){ ?>

                <div class="col-sm-6 col-md-4 col-lg-2 text-center p-2">
                    <img class="img-responsive rounded" src="account/images/<?php echo $row['food_image'] ?>" alt="" style="width:100%; height:130px">
                    <h6 class="m-0"><?php echo $row['food_name'] ?></h6>
                    <h5><?php echo '<span>&#8358;</span>' . number_format($row['food_prize'], 2) ?></h5>
                    <button type="button" value="<?= $row['food_id'] ?>" class="btn btn-success btn-sm addBtn" name="button">
                        <i class="fa fa-cart-plus fa-fw"></i>Add to Cart
                    </button>

                    </a>
                </div>

        <?php    }
        }
    ?>


</div>

</div>

<div class="container-fluid">
<hr>
     <!-- page footer -->
     <footer class="text-center" style="">
        <ul class="nav float-left">
            <li class="nav-item"><a class="nav-link" href="">Terms And Conditions</a></li>
            <li class="nav-item"><a class="nav-link" href="">FAQ</a></li>
            <li class="nav-item"><a class="nav-link" href="">Policies</a></li>
            <li class="nav-item"><a class="nav-link" href="">Become An Agent</a></li>
        </ul>
        <ul class="nav float-right">
            <li class="nav-item"><a class="nav-link" href="">Connect with us</a></li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-facebook fa-fw"></i>Facebook</a></li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-instagram fa-fw"></i>Instagram</a></li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-whatsapp fa-fw"></i>WhatsApp</a></li>
        </ul>
    </footer>
</div>

<?php include("includes/footer.php") ?>
<?php include("includes/sign_in_forms.php") ?>
<script src="assets/js/main-js.js"></script>

<script>
    $(document).ready(function(){
        cartCount();
        function cartCount() {
            $.ajax({
                url: 'account/process/add_cart_process.php',
                type: 'get',
                data: {action:'cart_count'},
                success:function(response){
                    $("#cart_count").html(response);
                }
            })
        }

        $(".addBtn").click(function(e){
            e.preventDefault();
            let id = $(this).val();

            $.ajax({
                url: 'account/process/add_cart_process.php',
                type: 'POST',
                data: {foodId:id, action:'add_item'},
                success:function(rep){
                    if (rep == 1){
                        toastr.success("Item successfully added to cart");
                        cartCount();

                    }
                    else {
                        toastr.error("Item already added to cart");
                    }

                }
            });
        });
    })


</script>
