<?php include 'admin_partials/header.php' ?>

<div class="wrapper">

	<!-- Navbar -->
	<?php include 'admin_partials/top-navbar.php' ?>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
 <?php include 'admin_partials/main-sidebar.php' ?>


	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
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
		</div> <!-- /Main content -->
	</div>
	<!-- /.content-wrapper -->


<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>
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
                        url: 'process/admin_profile_process.php',
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
