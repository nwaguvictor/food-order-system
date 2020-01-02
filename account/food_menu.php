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
							<h4 class="">Food Menu</h4>
						</div>

						<div class="col-lg-6">
							<button id="food_modal_btn" class="btn btn-success float-right m-1" type="button"><i class="fa-fw fa fa-plus fa-lg"></i>Add Food</button>
						</div>

					</div>
        </div>

                <!-- FOOD MENU TABLE LIST |||||||||||||||||||||||||||||||||||||||||||||| -->

					<div class="table-responsive food_menu">
						<table id="food_menu_table" class="table table-sm table-hover table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>FOOD NAME</th>
									<th>FOOD IMAGE</th>
									<th>FOOD CATEGORY</th>
									<th>FOOD STATUS</th>
									<th>FOOD PRIZE</th>
									<th>DATE ADDED</th>
									<th>ACTION</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>Pizza</td>
									<td> <img src="" alt="foodImage"> </td>
									<td>Fast</td>
									<td>Available</td>
									<td>Rs. 24.00</td>
									<td><?php echo date('d-m-Y') ?></td>
									<td>
										<a href="#" id="id" class="btn btn-success btn-sm">
											<i class="fa-fw fa fa-info"></i>
										</a>

										<a href="#" id="id" class="btn btn-danger btn-sm">
											<i class="fa-fw fa fa-times"></i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
          </div>

                <!-- THE FOOD MODAL FOR ADDING FOOD TO THE MENU -->
                <div class="modal fade" id="food_menu_modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Add Food </h3>
                                <button class="close" data-dismiss="modal" type="button">&times;</button>
                            </div>
                            <div class="modal-body">
                            <div class="message"></div>
                                <form action="" method="post" role="form" id="add_food_form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" name="food_name" class="form-control" placeholder="Enter Food Name" required>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="food_image">Food Image</label>
                                        <input type="file" name="food_image">
                                    </div>

									<div class="form-group">
                                        <select class="custom-select" name="food_category">
                                        	<option selected>--Select Category--</option>
                                            <?php 
                                                $query = $conn->query("SELECT * FROM food_category");
                                                while($row = $query->fetch_assoc()) {
                                                    echo '<option value="'.$row['cat_id'].'">'.$row['cat_title'].'</option>';
                                                }
                                                ?>
                                        </select>
                                    </div>

									<div class="form-group">
                                        <select class="custom-select" name="food_status">
                                        	<option value="" selected>--Select Food Status--</option>
												<option value="available">Available</option>
												<option value="unavailable">Unavailable</option>
                                        </select>
                                    </div>

									<div class="form-group">
                                        <input type="text" name="food_prize" class="form-control" placeholder="Enter Food Prize" required>
                                    </div>


                                    <div class="form-group">
                                        <button class="btn btn-success form-control" type="submit" id="add_food_btn">
                                            <i class="fa fa-plus fa-fw"></i>Add Food
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EDITING FOOD MODAL -->

                <div class="modal fade" id="edit_food_modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Food</h3>
                                <button class="close" data-dismiss="modal" type="button">&times;</button>
                            </div>
                            <div class="modal-body">
                            <div id="message"></div>
                            <form method="post" role="form" id="edit_food_form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" name="new_food_name" id="food_name" class="form-control" placeholder="Enter Food Name" required>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="food_image">Food Image</label>
                                        <input type="file" name="new_food_image" id="food_image">
                                    </div>

									<div class="form-group">
                                        <select class="custom-select" name="new_food_category" id="food_category" required>
                                        	<option selected>--Select Category--</option>
                                            <?php 
                                                $query = $conn->query("SELECT * FROM food_category");
                                                while($row = $query->fetch_assoc()) {
                                                    echo '<option value="'.$row['cat_id'].'">'.$row['cat_title'].'</option>';
                                                }
                                                ?>
                                        </select>
                                    </div>

									<div class="form-group">
                                        <select class="custom-select" name="new_food_status" id="food_status" required>
                                        	<option value="" selected>--Select Food Status--</option>
												<option value="available">Available</option>
												<option value="unavailable">Unavailable</option>
                                        </select>
                                    </div>

									<div class="form-group">
                                        <input type="text" name="new_food_prize" id="food_prize" class="form-control" placeholder="Enter Food Prize" required>
                                        <input type="hidden" id="hiddenId" name="hiddenId">
                                    </div>


                                    <div class="form-group">
                                        <button class="btn btn-success form-control actionBtn" type="submit" id="update_food_btn">
                                            <i class="fa fa-plus fa-fw"></i>Update Food Details
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

    <script src="scripts/food_menu_script.js"></script>
