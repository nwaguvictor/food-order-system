<?php include 'admin_partials/header.php' ?>

<div class="wrapper">

	<!-- Navbar -->
	<?php include 'admin_partials/top-navbar.php' ?>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
 <?php include 'admin_partials/main-sidebar.php' ?>
<?php 
	$query = $conn->query("SELECT * FROM users");
	if ($query->num_rows > 0) {
		$user_row_count = $query->num_rows;
	}

	$orderQuery = $conn->query("SELECT * FROM user_orders");
	if ($orderQuery->num_rows > 0) {
		$user_orders_row_count = $orderQuery->num_rows;
	}

	$pendingOrderQuery = $conn->query("SELECT * FROM user_orders WHERE orderStatus = 'on_delivery'");
	if ($pendingOrderQuery->num_rows > 0) {
		$pending_order_row_count = $pendingOrderQuery->num_rows;
	}else {
		$pending_order_row_count = 0;
	}

	$deliveredOrderQuery = $conn->query("SELECT * FROM user_orders WHERE orderStatus = 'delivered'");
	if ($deliveredOrderQuery->num_rows > 0) {
		$delivered_order_row_count = $deliveredOrderQuery->num_rows;
	}else {
		$delivered_order_row_count = 0;
	}

?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
				<!-- Card Starts here ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
				<h3>Admin Overview</h3>
				<hr class="mb-4">
				<div class="row">

				 <!-- Card 4 -->
				 <div class="col-lg-3">
				 	<div class="card">
						 <div class="card-body bg-white">
							 <div class="float-left">
								 <i class="fa fa-users fa-4x"></i>
							 </div>
							 <div class="float-right">
								 <h1 class="text-right"><?= $user_row_count ?></h1>
								 <h6>TOTAL USERS</h6>
							 </div>
						 </div>
						 <div class="card-footer">
							 <a href="users.php" class="stretched-link">View Total Users
								<i class="fa fa-angle-double-right pull-right"></i>
							</a>
							 
						 </div>
					 </div>
				 </div>

				 <div class="col-lg-3">
					 <div class="card">
						 <div class="card-body bg-white">
							 <div class="float-left">
								 <i class="fa fa-shopping-basket fa-4x"></i>
							 </div>
							 <div class="float-right">
								 <h1 class="text-right"><?= $user_orders_row_count ?></h1>
								 <h6>TOTAL ORDER</h6>
							 </div>
						 </div>
						 <div class="card-footer">
							 <a href="user_orders.php" class="stretched-link">View Total Order
								<i class="fa fa-angle-double-right pull-right"></i>
							</a>
						 </div>
					 </div>
				 </div>

				<!-- Card 5 -->
					<div class="col-lg-3">
						<div class="card">
							<div class="card-body bg-white">
								<div class="float-left">
									<i class="fa fa-motorcycle fa-4x"></i>
								</div>
								<div class="float-right">
									<h1 class="text-right"><?= $pending_order_row_count ?></h1>
									<h6>PENDING DELIVERY</h6>
								</div>
							</div>
							<div class="card-footer">
								<a href="user_orders.php" class="stretched-link">View Pending Delivery
									<i class="fa fa-angle-double-right pull-right"></i>
								</a>
								
							</div>
						</div>
					</div>

					<!-- Card 6 -->
					<div class="col-lg-3">
						<div class="card">
							<div class="card-body bg-white">
								<div class="float-left">
									<i class="fa fa-smile-o fa-4x"></i>
								</div>
								<div class="float-right">
									<h1 class="text-right"><?= $delivered_order_row_count ?></h1>
									<h6>ORDERS DELIVERED</h6>
								</div>
							</div>
							<div class="card-footer">
								<a href="user_orders.php" class="stretched-link">View Food Delivered
									<i class="fa fa-angle-double-right pull-right"></i>
								</a>
								
							</div>
						</div>
				 	</div>
				</div>
				<!-- Card ending here |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
				
			</div>
		</div> <!-- /Main content -->
	</div>
	<!-- /.content-wrapper -->  


<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

