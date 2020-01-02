<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <title>YOUR ORDER DETAILS</title>
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


<div class="wrapper">
	
			<div class="container-fluid">
				<div class="admin-header pt-3 border-bottom mb-2">
				<!-- Getting cart id -->
					<?php 
						if (isset($_GET['id'])) {
							$orderId = $conn->real_escape_string($_GET['id']);
						?>		

                    <a href="kitchen.php" class="badge badge-primary p-2 float-right"> <i class="fa fa-fw fa-angle-double-left"></i> Make another Order</a>
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
						<div class="card mb-3">
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
							<div class="card mb-3">
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
						<div class="card mb-3">
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
												<img class="img-responsive" src="account/images/<?= $items['itemImage'] ?>" alt="foodImage" width="50px" height="30px" > 
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
    
    
    <!-- ./wrapper -->
    <!-- Footer and scripts -->
    <?php include 'includes/footer.php' ?>



