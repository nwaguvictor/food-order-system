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
				<div class="admin-header pt-3 border-bottom mb-2">
					<div class="row">
						<div class="col-lg-6">
							<h4 class="">All Users</h4>
						</div>

						<div class="col-lg-6">
							<button class="btn btn-danger float-right m-1" type="button"><i class="fa-fw fa fa-file-pdf-o fa-lg"></i>Save As PDF</button>
							<button class="btn btn-success float-right m-1" type="button"><i class="fa-fw fa fa-table fa-lg"></i>Export To Excel</button>
						</div>

						</div>
					</div>

					<!-- USERS TABLE LIST |||||||||||||||||||||||||||||||||||||||||||||| -->

					<div class="table-responsive">
						<table id="users-table" class="table table-sm table-hover table-striped table-bordered">
						

						</table>
					</div>

					
				
				
			</div>
		</div> <!-- /Main content -->
	</div>
	<!-- /.content-wrapper -->  
	
	
	<!-- Footer and scripts -->
	<?php include 'admin_partials/footer.php' ?>


<script>
	// SHOWING ALL USER

    showAllUsers();
    
    function showAllUsers() {
        $.ajax({
            url: 'process/all_users_process.php',
            type:'POST',
            data: {action:"view_all_users"},
            success:function(resp){
                $("#users-table").html(resp);
                $("#users-table").DataTable();
            }
        })
    }


    // Showing a user
    $(document).on('click', '.viewBtn', function(e){
        e.preventDefault();
        let userId = $(this).attr('id');
        $.ajax({
            url: 'process/fetch_user.php',
            type:'POST',
            data:{userId:userId, action:'view_user'},
            success:function(resp){
                let data = JSON.parse(resp);
                Swal.fire({
                    title:'User Details',
                    icon:'info',
                    html:'<hr><h2>Name: <strong>'+data.firstname+' '+data.lastname+
                        '</strong></h2> <h3>E-mail: <strong>'+data.email+
                        '</strong></h3> <h4>Phone: <strong>'+data.phone+
                        '</strong></h4> <h4>User Role: <strong>'+data.role+'</strong></h4>'
                });
            }
        })
    });   
</script>