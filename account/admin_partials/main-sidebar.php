<aside class="main-sidebar sidebar-dark-primary bg-success elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
          <i class="fa fa-user-secret fa-3x"></i>
        </div>
        <div class="info">
          <a href="index.php" class="d-block">BELLEFUL -ADMIN</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
<?php
  if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){ ?>
  <li class="nav-item">
            <a href="index.php" class="nav-link active bg-danger">
              <i class="nav-icon fa fa-tachometer"></i>
              <p> Admin Overview</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="food_menu.php" class="nav-link">
              <i class="nav-icon fa fa-list-ol"></i>
              <p> Food Menu </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="users.php" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>All Users </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="food_cat.php" class="nav-link">
              <i class="nav-icon fa fa-reorder"></i>
              <p> Food Category </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="user_orders.php" class="nav-link">
              <i class="nav-icon fa fa-shopping-basket"></i>
              <p>User Orders </p>
            </a>
          </li>

<?php   }
?>
          <li class="nav-item">
            <a href="../kitchen.php" class="nav-link">
              <i class="nav-icon fa fa-cutlery"></i>
              <p> Kitchen</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fa fa-user-o"></i>
              <p>Profile</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="change_password.php" class="nav-link">
              <i class="nav-icon fa fa-lock"></i>
              <p>Change Password</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fa fa-power-off"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
