<?php include("includes/header.php") ?>
<!-- Navigation bar -->
<?php include("includes/navbar.php") ?>

<!-- Page Content -->
<div class="container-d-fluid">
    <div class="header justify-content-center text-center">
        <h1 class="">BelleFul Chefs</h1>
        <p>Order for your fast and tasty foods</p>
        <div class="search-food-form">
        <form action="" method="post" role="form">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                </div>
                <input type="text" name="foods" placeholder="I want to eat..." class="form-control">
                <div class="input-group-append">
                    <button type="submit" id="search-food-btn" class="btn btn-danger">Search</button>
                </div>
            </div>
        </form>
        <a href="kitchen.php" class="btn btn-outline-danger btn-lg text-white my-3" id="go-kitchen-btn"><span class="font-weight-bold">Go Kitchen</span> <i class="fa fa-hand-o-right"></i></a>
    </div>
    </div>





     <

<!-- The kitchen food section -->

<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

<div class="container-fluid">
     <!-- page footer -->
     <footer class="fixed-bottom text-center">
        <ul class="nav float-left">
            <li class="nav-item"><a class="nav-link" href="">Terms And Conditions</a></li>
            <li class="nav-item"><a class="nav-link" href="">FAQ</a></li>
            <li class="nav-item"><a class="nav-link" href="">Policies</a></li>
            <li class="nav-item"><a class="nav-link" href="">Become An Agent</a></li>
        </ul>
        <ul class="nav float-right">
            <li class="nav-item"><a class="nav-link" href="">Connect with us</a></li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-facebook fa-fw"></i>Facebook</a></li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-instagram fa-fw"></i>Instagram</a></li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-whatsapp fa-fw"></i>WhatsApp</a></li>
        </ul>
    </footer>
</div>

<?php include("includes/sign_in_forms.php"); ?>

<?php include("includes/footer.php") ?>
<script src="assets/js/main-js.js"></script>
