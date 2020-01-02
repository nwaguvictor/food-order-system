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
				<div class="col-lg-5 mx-auto mb-4">
                    <h4 class="text-center mb-4">Change Your Password</h4>
                    <form class="p-4 rounded bg-light shadow" id="change_password_form">
                        <div class="message"></div>
                        <div class="form-group">
                            <input class="form-control" type="password" id="old_pass" placeholder="Enter Old Password" required minLength="5">
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="password" id="new_pass"  placeholder="Enter New Password" required minLength="5">
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="password" id="c_pass" placeholder="Confirm New Password" required minLength="5">
                        </div>

                        <div class="form-group">
                            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Cancel</button>
                            <button type="submit" class="btn btn-success float-right"><i class="fa fa-check fa-fw"></i>Update</button>
                        </div>
                    </form>
                </div>

			</div>
		</div> <!-- /Main content -->
	</div>
	<!-- /.content-wrapper -->


<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#change_password_form").submit(function(event) {
            event.preventDefault();
            let oldPass = $("#old_pass").val();
            let newPass = $("#new_pass").val();
            let cPass = $("#c_pass").val();
            if (newPass !== cPass) {
                alert("Your new Passwords Don't Match");
            }else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Change Password?',
                    showCancelButton: true,
                    cancelButtonColor:'red',
                    confirmButtonColor: 'green'
                }).then((result) => {
                    if(result.value) {
                        $.ajax({
                            url: 'process/admin_profile_process.php',
                            type: 'post',
                            data: {action:'password', oldPass:oldPass, newPass:newPass, cPass:cPass},
                            success:function(rep){
                                console.log(rep);
                            }
                        })
                    }
                })
            }

        });
    })
</script>
