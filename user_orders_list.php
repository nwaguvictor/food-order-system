<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <title>YOUR ORDERS</title>
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

<div class="wrapper">

	<!-- Navbar -->

	<!-- /.navbar -->


<div class="container-fluid">
    <div class="admin-header pt-3 border-bottom mb-2">
    <a href="kitchen.php" class="badge badge-primary p-2 float-right"> <i class="fa fa-fw fa-angle-double-left"></i> Make another Order</a>
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
                    $query = $conn->query("SELECT * FROM user_orders WHERE userId = '$user_id' ") or die("Error Occured");
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
                                    <a class="badge badge-success user_items_btn" href="view_order.php?id=<?= $row['orderId'] ?>">View More</a>
                                </td>
                            </tr>
                    <?php $i++;	}
                    } else {
                        
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    
</div>
	
	
	<!-- Footer and scripts -->
	<?php include 'includes/footer.php' ?>

	<script>
		$(document).ready(function(){
			$("#user-orders-table").DataTable();

			$(".user_items_btn").click(function(e){
				e.preventDefault();
				let id = $(this).attr("id");
				window.location.href = 'view_user_order.php?id='+id;
			})
		})
	</script>


