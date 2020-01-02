<?php include 'admin_partials/header.php' ?>
<?php include 'admin_partials/db.php' ?>


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
				<!-- Getting cart id -->
					<?php 
						if (isset($_GET['id'])) {
							$orderId = $conn->real_escape_string($_GET['id']);
						?>		

					<a href="" id="<?= $orderId ?>" class="badge badge-danger p-2 float-right update_btn">Order Delivered ?</a>

					<div class="row">
						<div class="col-lg-6">
							<h4 class="">Full Order Details</h4>
						</div>

					</div>
				</div>

				<div class="row">
					
					<div class="col-lg-6 p-1">
						<div class="content shadow rounded p-3">
						<!-- Details of the person that made the order -->
						<div class="card">
								<div class="card-body bg-light">
									<h4>ORDER MADE BY:</h4>
									<div class="table-responsive">
								<table class="table table-sm table-hover">
								<?php 
									$query = $conn->query("SELECT * FROM user_orders WHERE orderId = '$orderId'") or die("ERROR OCCURED");
									if ($query->num_rows == 1) {
										$row = $query->fetch_assoc();
										$userId = $row['userId'];
									}

									$user_query = $conn->query("SELECT * FROM users WHERE user_id = '$userId'") or die("Error Occured");
									if ($user_query->num_rows > 0) {
										$user = $user_query->fetch_assoc();
									}
								
								?>
									<tr>
										<th>Name</th>
										<td><?= $user['firstname'] .' '.$user['lastname'] ?></td>
									</tr>

									<tr>
										<th>Phone Number</th>
										<td><?= $user['phone'] ?></td>
									</tr>

									<tr>
										<th>E-mail</th>
										<td><?= $user['email'] ?></td>
									</tr>

									<tr>
										<th>Address</th>
										<td><?= $user['address'] ?></td>
									</tr>

									
								</table>
								
							</div>
								</div>
							</div>


						<!-- User Delivery details -->
							<div class="card">
								<div class="card-body">
									<h4>DELIVERY ADDRESS:</h4>
									<div class="table-responsive">
								<table class="table table-sm table-hover">
								<?php 
									$query = $conn->query("SELECT * FROM user_orders WHERE orderId = '$orderId'") or die("ERROR OCCURED");
									if ($query->num_rows == 1) {
										$row = $query->fetch_assoc();
										$userId = $row['userId'];
									}
								
								?>

									<tr>
										<th>Receiver Name</th>
										<td><?= $row['orderUserName'] ?></td>
									</tr>

									<tr>
										<th>Phone Number</th>
										<td><?= $row['orderUserPhone'] ?></td>
									</tr>

									<tr>
										<th>Address</th>
										<td><?= $row['orderUserAddress'] ?></td>
									</tr>
								</table>
								
							</div>
								</div>
							</div>

							
						</div>
					</div>

					<div class="col-lg-6 p-1">

						<!-- Order Details -->
						<div class="card">
								<div class="card-body">
									<h4> ORDER DETAILS:</h4>
									<div class="table-responsive">
								<table class="table table-sm table-hover">
								<?php 
									$query = $conn->query("SELECT * FROM user_orders WHERE orderId = '$orderId'") or die("ERROR OCCURED");
									if ($query->num_rows == 1) {
										$row = $query->fetch_assoc();
										$userId = $row['userId'];
									}
								
								?>
									<tr>
										<th>Order Number</th>
										<td><?= $row['orderNumber'] ?></td>
									</tr>

									<tr>
										<th>Order Date</th>
										<td><?= $row['created_at'] ?></td>
									</tr>

									<tr>
										<th>Order Final Status</th>
										<td><?= $row['orderStatus'] ?></td>
									</tr>
								</table>
								
							</div>
								</div>
							</div>


					<!-- Order Items -->
						<div class="content shadow rounded p-4">
							<h3 class="">ITEMS ORDERED:</h3>
							<hr class="my-1">

							<ul class="list-group">
							<?php 
								$item_query = $conn->query("SELECT * FROM user_items WHERE userOrderId = '$orderId'") or die ("Error Occured");
								if ($item_query->num_rows > 0) {
									$grandTotal = 0;
									$totalPrize = 0;
									while ($items = $item_query->fetch_assoc()) { 
										// $foodPrize = $items['itemPrize'];	
									?>
										<li class="list-group-item"><b><?= $items['itemQty'] ?>x</b>&nbsp;<?= $items['itemName'] ?> 
											<span class="float-right"> 
												<img class="img-responsive" src="images/<?= $items['itemImage'] ?>" alt="foodImage" width="50px" height="30px" > 
											</span> 
										</li>
									<?php 
										$totalPrize += $items['itemPrize'] * $items['itemQty'];
									}

									 $grandTotal += $totalPrize;
								}
							?>
                                <p class="badge badge-danger p-2">Total Prize:&nbsp;<span>&#8358;</span>&nbsp;<?= number_format($grandTotal, 2) ?></p>
							</ul>
						</div>

					</div>

				<?php } else {
					echo '<h4 class="text-center">No item From the order lists</h4>';
				}
				
				
				?>

				</div>



					
				
				
			</div>
        </div> <!-- /Main content -->
        
	</div>
	<!-- /.content-wrapper -->  
    
    
    <!-- ./wrapper -->
    <!-- Footer and scripts -->
    <?php include 'admin_partials/footer.php' ?>

	<script>
		$(document).ready(function(){
			$(".update_btn").click(function(e){
				e.preventDefault();
				let orderId = $(this).attr("id");
				Swal.fire({
					icon: 'warning',
					title: 'Update Order?',
					text: 'Mark Order as Delivered',
					showCancelButton: true,
					cancelButtonColor: 'red',
					confirmButtonColor: 'green'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url: 'process/store_items_process.php',
							type: 'POST',
							data: {action:'update_order', orderId:orderId},
							success:function(resp){
								if (resp == 'ok') {
									// location.reload(true);
									toastr.success("Order Set as Delivered");
								}
							}
						})
					}
				})
			})
		})
	</script>

