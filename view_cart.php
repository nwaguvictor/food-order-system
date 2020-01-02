<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ORDER FOR FOOD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<?php include("account/admin_partials/db.php") ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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

<div class="container">
    <h4 class="text-danger">Your Cart Items</h4>
    <p>Verify and confirm the items in your cart before proceeding
        <a title="Preview Your Cart" href="#" class=""><i class="fa fa-info-circle"></i></a>
    </p>
    <a href="kitchen.php"><i class="fa fa-angle-double-left fa-fw"></i>Continue Shopping</a>
    <button type="button" class="btn btn-sm btn-danger float-right mb-2" id="clear_cart" name="button"><i class="fa fa-times fa-fw"></i>Clear Cart</button>

    <div class="table-responsive mt-2">
        <table class="table table-sm table-bordered table-collapse">
            <thead>
                <tr class="bg-light">
                    <th>S/NO</th>
                    <th>Food Name</th>
                    <th>Food Image</th>
                    <th>Prize</th>
                    <th>Quantity</th>
                    <th>Total Prize</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $grandTotal = 0;
                    if (isset($_SESSION['cart'])) {
                        $cnt = 1;
                        foreach($_SESSION['cart'] as $item) {
                            $id = $item['item_id'];
                            $query = $conn->query("SELECT * FROM food_menu WHERE food_id = $id");
                            if ($query->num_rows > 0){
                                while($row = $query->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= $cnt ?></td>
                                        <td><?= $row['food_name'] ?></td>
                                        <td><img class="img-fluid" width="50" style="height:30px" src="account/images/<?= $row['food_image'] ?>" alt="product_image" ></td>
                                        <td><?= '<span>&#8358;</span>' .number_format($row['food_prize'], 2)?></td>
                                        <td>
                                            <form class="qty_form">
                                                <input type="number" class="form-control form-control-sm col-sm-12 food_qty" value="<?= $item['qty']?>">
                                                <input type="hidden" class="food_id" value="<?= $row['food_id']?>">
                                                <input type="hidden" class="food_prize" value="<?= $row['food_prize']?>">
                                            </form>
                                        </td>
                                        <td class="total_prize"><?= '<span>&#8358;</span>'. number_format($row['food_prize'] * $item['qty'], 2) ?></td>
                                        <td class="text-center">
                                            <button type="button" id="<?= $row['food_id'] ?>" class="btn btn-sm btn-danger col-lg-4 remove"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>

                                    <?php $grandTotal += $row['food_prize'] * $item['qty']; ?>

                            <?php  $cnt++;  }
                            }
                        }
                    }
                ?>

            </tbody>
            <tfoot>
                <tr class="">
                    <td colspan="5"><b>Grand Total Prize</b></td>
                    <td><b><?= '<span>&#8358;</span>' ?><span id="grand_total"><?= $grandTotal; ?></span></b></td>
                    <td>
                        <!-- <a href="#" class="btn btn-success btn-sm col-lg-12" id="checkout_btn">Checkout</a> -->
                        <button type="button" class="btn btn-sm btn-success col-sm-12" id="checkout_btn" <?php echo !isset($_SESSION['cart']) || count($_SESSION['cart']) == 0 ? 'disabled' : '' ?>>
                            Checkout
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>



<div class="container-fluid">
<hr>
     <!-- page footer -->
     <footer class="text-center">
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


<script type="text/javascript">

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

        $("#clear_cart").click(function(e){
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: "Clear Cart?",
                showCancelButton: true,
                cancelButtonColor: 'red',
                confirmButtonColor: 'green',
            }).then((result) => {
                if(result.value) {
                    $.ajax({
                        url: 'account/process/add_cart_process.php',
                        type: "POST",
                        data:{action:'reset'},
                        success:function(resp){
                            location.reload();
                        }
                    })
                }
            })
        });

        // Removing item from cart
        $(".remove").click(function(e){
            e.preventDefault();
            let foodId = $(this).attr('id');
            Swal.fire({
                icon: 'warning',
                title: 'Remove Item?',
                showCancelButton: true,
                cancelButtonColor: 'red',
                confirmButtonColor: 'green'
            }).then((result) => {
                if(result.value) {
                    $.ajax({
                        url: 'account/process/add_cart_process.php',
                        type: 'POST',
                        data: {foodId:foodId, action:'remove_item'},
                        success:function(resp) {
                            cartCount();
                            if (resp == 'ok') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Done',
                                    text: 'Item Removed',
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    })
                }
            })

        });

        // Updating the food quantity
        $(".food_qty").on("change", function(){
            let getForm = $(this).closest('form');
            let foodQty = getForm.find('.food_qty').val();
            let foodId = getForm.find('.food_id').val();
            let foodPrize = getForm.find('.food_prize').val();

            $.ajax({
                url: 'account/process/add_cart_process.php',
                type: "POST",
                data: {action:'update_cart', foodId:foodId, foodQty:foodQty, foodPrize:foodPrize},
                success:function(resp){
                    if (resp == 'ok') {
                        location.reload();
                    }
                }
            })
        });

        // Checkout cart items
        $("#checkout_btn").click(function(e){
            e.preventDefault();
            $.ajax({
                url: 'account/process/store_items_process.php',
                type: 'POST',
                data: {action:'check_login'},
                success:function(rep){
                    if (rep == false){
                        $("#login-modal-form").modal("show");
                    } else if(rep == 'ok') {
                        window.location.href = 'checkout.php';

                    }
                }
            })
        });

    })


</script>
