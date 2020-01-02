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
					<div class="row">
						<div class="col-lg-6">
							<h4 class="">User's Orders</h4>
						</div>

						</div>
					</div>

					<!-- USER"S ORDER TABLE LIST |||||||||||||||||||||||||||||||||||||||||||||| -->

					<div class="table-responsive">
						<table id="user-orders-table" class="table table-sm table-hover table-striped table-bordered">
							<thead>
								<tr class="text-center">
									<th>S/N</th>
									<th>ORDER NUMBER</th>
									<th>NAME</th>
									<th>ADDRESS</th>
									<th>PHONE</th>
									<th>AMOUNT</th>
									<th>ORDER STATUS</th>
									<th>DATE ORDERED</th>
									<th>ACTION</th>
								</tr>
							</thead>

							<tbody>
								<?php 
								$i = 1;
								$query = $conn->query("SELECT * FROM user_orders ORDER BY orderId DESC") or die("Error Occured");
								if ($query->num_rows > 0){
									while($row = $query->fetch_assoc()){ ?>
										<tr class="text-center">
											<td><?= $i ?></td>
											<td><?= $row['orderNumber'] ?></td>
											<td><?= $row['orderUserName'] ?></td>
											<td><?= $row['orderUserAddress'] ?></td>
											<td><?= $row['orderUserPhone'] ?></td>
											<td class="badge badge-danger badge-pill mt-1"><span>&#8358;</span>&nbsp;<?= number_format($row['orderAmount'], 2) ?></td>
											<td><?= $row['orderStatus'] ?></td>
											<td><?= $row['created_at'] ?></td>
											<td>
												<a class="badge badge-success items_btn" id="<?= $row['orderId'] ?>" href="#">View More</a>
											</td>
										</tr>
								<?php $i++;	}
								} 
								
								?>
							</tbody>
						</table>
					</div>
				
			</div>
		</div> <!-- /Main content -->
	</div>
	<!-- /.content-wrapper -->  
	
	
	<!-- Footer and scripts -->
	<?php include 'admin_partials/footer.php' ?>

	<script>
		$(document).ready(function(){
			$("#user-orders-table").DataTable();

			$(".items_btn").click(function(e){
				e.preventDefault();
				let id = $(this).attr("id");
				window.location.href = 'view_user_order.php?id='+id;
			})
		})
	</script>


