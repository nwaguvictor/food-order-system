<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <title>MY PROFILE</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark evlevation-4">
            <a class="navbar-brand" href="index.php"><i class="fa fa-shopping-cart fa-fw"></i>BelleFul Chefs</a>
            <button type="button" class="navbar-toggler" data-target="#myList" data-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="myList">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-shopping-bag"></i>&nbsp;Your Orders</a></li>
                </ul>
            </div>
        </nav>


<?php include 'account/admin_partials/db.php' ?>
<?php 
    session_start();
    $user_id = $_SESSION['user']['user_id'];
?>



<div class="container-fluid">
    <div class="admin-header pt-3 border-bottom mb-2">
    <a href="kitchen.php" class="badge badge-primary p-2 float-right"> <i class="fa fa-fw fa-angle-double-left"></i> Start Shopping</a>
    <?php
                    if (isset($_SESSION['user'])){
                        $user_id = $_SESSION['user']['user_id'];
                        $fname = $_SESSION['user']['firstname'];
                        $lname = $_SESSION['user']['lastname'];
                        $email = $_SESSION['user']['email'];
                        $state = $_SESSION['user']['state'];
                        $address = $_SESSION['user']['address'];
                        $phone = $_SESSION['user']['phone'];
                        $role = $_SESSION['user']['role']; ?>

                        <div class="col-lg-4 mx-auto">
                            <h2 class="text-center">Hello <?= $fname .' '. $lname ?> <i class="fa fa-smile-o"></i></h2>
                            <form class="p-3 bg-light p-4  rounded shadow" id="admin_profile_form">
                                <div class="form-group">
                                    <label for="fname">First Name:</label>
                                    <input type="text" name="fname" value="<?= $fname ?>" id="fname" class="form-control" readonly required>
                                </div>

                                <div class="form-group">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" name="lname" value="<?= $lname ?>" id="lname" class="form-control" readonly required>
                                    <input type="hidden" value="<?= $user_id ?>" id="user_id">
                                </div>

                                <div class="form-group">
                                    <label for="email">E-Mail:</label>
                                    <input type="email" name="email" value="<?= $email ?>" id="email" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="state">State:</label>
                                    <input type="state" name="state" value="<?= $state ?>" id="state" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="state" name="address" value="<?= $address ?>" id="address" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone Number:</label>
                                    <input type="phone" name="phone" value="<?= $phone ?>" id="phone" class="form-control" readonly required>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-danger" type="button" name="edit_user" id="edit_user">Edit Profile</button>
                                    <button style="display:none" class="btn btn-success" type="submit" name="update" id="update_user">
                                        Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    <?php }

                ?>

    
</div>
	
	
	<!-- Footer and scripts -->
	<?php include 'includes/footer.php' ?>

    <script type="text/javascript">
    $(document).ready(function(){
        $("#edit_user").click(function(e){
            e.preventDefault();
            $("#fname").attr('readonly', false);
            $("#lname").attr('readonly', false);
            $("#state").attr('readonly', false);
            $("#address").attr('readonly', false);
            $("#phone").attr('readonly', false);
            $("#edit_user").hide();
            $("#update_user").show();
        });

        $("#admin_profile_form").submit(function(e){
            e.preventDefault();
            let userId = $("#user_id").val();
            let fname = $("#fname").val();
            let lname = $("#lname").val();
            let state = $("#state").val();
            let address = $("#address").val();
            let phone = $("#phone").val();
            Swal.fire({
                icon: 'warning',
                title: 'Update Profile?',
                showCancelButton: true,
                cancelButtonColor: 'red',
                confirmButtonColor: 'green'
            }).then((result) => {
                if(result.value) {
                    $.ajax({
                        url: 'account/process/admin_profile_process.php',
                        type: "POST",
                        data: {userId:userId, fname:fname, lname:lname, state:state, address:address, phone:phone, action:'update_admin'},
                        success:function(rep) {
                            if (rep == 'ok'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Done',
                                    text: 'Profile Updated Successfully',
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                location.reload();
                            }
                        }
                    })
                }
            })

        })
    })
</script>

