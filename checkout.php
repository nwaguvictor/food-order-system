<?php 
    session_start();
    if (!isset($_SESSION['user'])){
        header("location: index.php");
        exit();
    }elseif(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
        header("location: kitchen.php");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <title>CHECKOUT CART ITEMS</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark evlevation-4">
            <a class="navbar-brand" href="index.php"><i class="fa fa-shopping-cart fa-fw"></i>BelleFul Chefs</a>
            <button type="button" class="navbar-toggler" data-target="#myList" data-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="myList">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-handshake-o"></i>&nbsp;Secure Checkout</a></li>
                </ul>
            </div>
        </nav>

        <div class="container mt-4">
            <p>Comfirm Your Delivery Address and Items then proceed <span class="fa fa-info-circle text-danger"></span> </p>
            <a href="view_cart.php" class="badge badge-primary"> <i class="fa fa-angle-double-left"></i> back to cart</a>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <h4 class="border-bottom">DELIVERY DETAILS</h4>
                    <div class="card bg-light">

                        <div class="card-body">
                            <h3 class="card-title border-bottom">Items to deliver:</h3>
                            <ul class="list-group">
                                <?php
                                include_once("account/admin_partials/db.php");
                                
                                if(isset($_SESSION['cart'])){
                                    $grandTotal = 0;
                                    foreach($_SESSION['cart'] as $item){
                                        $id = $item['item_id'];
                                        $qty = $item['qty'];
                                        $query = $conn->query("SELECT * FROM food_menu WHERE food_id = $id");
                                        if($query->num_rows > 0){
                                            while($row = $query->fetch_assoc()) { 
                                                $foodPrize = $row['food_prize'];    
                                            ?>
                                                <li class="list-group-item"><b><?= $qty ?>x</b>&nbsp;<?= $row['food_name'] ?> <span class="float-right"> <img class="img-responsive" src="account/images/<?= $row['food_image'] ?>" alt="foodImage" width="50px" height="30px" > </span> </li>
                                        <?php    }
                                        }
                                        $grandTotal += $foodPrize * $qty; 
                                    }
                                }

                                ?>
                            </ul>
                            <a href="kitchen.php" class="badge badge-primary mt-2 float-right"> <i class="fa fa-angle-double-left"></i> Add more items</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <h4 class="border-bottom">DELIVERY ADDRESS</h4>
                    <div class="card bg-light">
                        <div class="card-body">
                            <form id="delivery_address">
                                <h3>Delivering to:</h3>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="name" id="receiver_name" placeholder="Enter Receiver's Name" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="address" id="receiver_address" placeholder="Enter Receiver's Address" required>
                                </div>

                                <div class="form-group">
                                    <input type="tel" class="form-control form-control-sm" name="phone" id="receiver_phone" placeholder="Enter Receiver's Number" required>
                                    <input type="hidden" class="userName" id="<?= $_SESSION['user']['firstname'] .' '. $_SESSION['user']['lastname']; ?>">
                                    <input type="hidden" class="userEmail" id="<?= $_SESSION['user']['email']; ?>">
                                    <input type="hidden" class="userPhone" id="<?= $_SESSION['user']['phone']; ?>">
                                    <input type="hidden" class="totalAmount" id="<?= $grandTotal; ?>">
                                </div>

                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger btn-sm" name="button"> <i class="fa fa-times fa-fw"></i> Clear Form</button>
                                    <button type="submit" class="btn btn-success btn-sm float-right" id="address_btn" name="button"> <i class="fa fa-check fa-fw"></i> Confirm</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </body>
</html>


<?php include("includes/footer.php") ?>
<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
    $(document).ready(function(){
        $("#delivery_address").on("submit", function(e){
            e.preventDefault();
            
            let name = $("#receiver_name").val();
            let address = $("#receiver_address").val();
            let phone = $("#receiver_phone").val();
            let userName = $(".userName").attr("id");
            let userEmail = $(".userEmail").attr("id");
            let userPhone = $(".userPhone").attr("id");
            let grandPrize = $(".totalAmount").attr("id");

            Swal.fire({
                icon: 'info',
                title: 'Confirm Order',
                html: '<span>Order For: <b>'+name+' </b></span><br /> <span>Phone: <b>'+phone+ '</b></span><br /> <span>Address: <b>'+address+'</b></span>',
                showCancelButton: true,
                cancelButtonColor: 'red',
                confirmButtonColor: 'green'
            }).then((result) => {
                if (result.value) {
                    payWithPaystack(userName, userEmail, userPhone, grandPrize, name, address, phone);
                }
            })
        }); 

     })


    // Payment GateWay function
    function payWithPaystack(name, email, phone, total, receiverName, receiverAddress, receiverPhone){
        
        var handler = PaystackPop.setup({
            key: "pk_test_cb8f80241142191101d982249746bc441f7e3547",
            email: email,
            amount: total * 100,
            currency: "NGN",
            metadata: {
                custom_fields: [
                    {
                        display_name: name,
                        variable_name: email,
                        value: phone
                    }
                ]
            },
            callback: function(response){
                // alert('success. transaction ref is ' + response.reference);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'Payment Successful',
                    confirmButtonColor: 'green'
                }).then((result) => {
                    $.ajax({
                        url: 'account/process/store_items_process.php',
                        type: 'POST',
                        data: {name:receiverName, address:receiverAddress, phone:receiverPhone, action:'store_order'},
                        success:function(resp){
                            let name = $("#receiver_name").val("");
                            let address = $("#receiver_address").val("");
                            let phone = $("#receiver_phone").val("");
                            
                            let toast = ()=>{
                                toastr.success("Order Successfully Placed"); 
                            }
                            toast();
                        }
                    });
                });
            },
            onClose: function(){
                // alert('window closed');
            }
        });
        handler.openIframe();
    }   
</script>
