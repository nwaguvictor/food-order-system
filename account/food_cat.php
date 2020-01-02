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
							<h4 class="">Food Categories</h4>
						</div>

						<div class="col-lg-6">
							<button id="cat-modal-btn" class="btn btn-success float-right m-1" type="button"><i class="fa-fw fa fa-plus fa-lg"></i>Add Category</button>
						</div>

					</div>
                </div>
                
                <!-- CATEGORIES TABLE LIST |||||||||||||||||||||||||||||||||||||||||||||| -->

					<div class="table-responsive">
						<table id="cat-table" class="table table-sm table-hover table-striped table-bordered">
							
						</table>
                    </div>
                    
                <!-- THE CATEGORY MODAL FOR ADDING CATEGORIES -->
                <div class="modal fade" id="cat-modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Add A food Category</h3>
                                <button class="close" data-dismiss="modal" type="button">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" role="form" id="add-cat-form">
                                    <div class="form-group">
                                        <input type="text" name="new_cat_name" id="new_cat_name" class="form-control" placeholder="Enter Category Name" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success form-control actionBtn" type="button" id="add_cat_btn">
                                            <i class="fa fa-plus fa-fw"></i>Add Category
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EDITING CAT MODAL -->

                <div class="modal fade" id="edit-cat-modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Category</h3>
                                <button class="close" data-dismiss="modal" type="button">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" role="form" id="update-cat-form">
                                    <div class="form-group">
                                        <input type="text" name="edit_cat_name" id="edit_cat_name" class="form-control" placeholder="Enter Category Name" required>
                                        <input type="hidden" name="id" id="cat_id">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success form-control actionBtn" type="button" id="update_cat_btn">
                                            <i class="fa fa-plus fa-fw"></i>Update Category
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                

					
				
				
			</div>
        </div> <!-- /Main content -->
        
	</div>
	<!-- /.content-wrapper -->  
    
    
    <!-- ./wrapper -->
    <!-- Footer and scripts -->
    <?php include 'admin_partials/footer.php' ?>

    <script src="scripts/food_cat_script.js"></script>

