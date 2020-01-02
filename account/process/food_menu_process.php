<?php
include_once("../admin_partials/db.php");

function showCatName($catId) {
  global $conn;

  $query = $conn->query("SELECT * FROM food_category WHERE cat_id = $catId");
  while($row = $query->fetch_assoc()){
    return $row['cat_title'];
  }
}

// Showing all food from the menu list

if(isset($_POST['action']) && $_POST['action'] == 'view_all_food'){
  $query = $conn->query("SELECT * FROM food_menu ORDER BY food_id DESC");
  $output = '';
  $cnt = 1;

  if($query->num_rows > 0) {
    $output = '<table id="food_menu_table" class="table table-sm table-hover table-striped table-bordered">
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

      <tbody>';
      
    while($rows = $query->fetch_assoc()) {
      $output .= '<tr>
                    <td>'.$cnt.'</td>
                    <td>'.$rows['food_name'].'</td>
                    <td> 
                      <img class="img-fluid" src="images/'.$rows['food_image'].'" alt="foodImage" style="width:60px; height: 35px"> 
                    </td>
                    <td>'.showCatName($rows['food_cat_id']).'</td>
                    <td>'.$rows['food_status'].'</td>
                    <td>'.$rows['food_prize'].'</td>
                    <td>'.$rows['created_at'].'</td>
                    <td>
                      <a href="" id="'.$rows['food_id'].'" class="btn btn-success btn-sm editBtn">
                        <i class="fa-fw fa fa-info"></i>
                      </a>

                      <a href="#" id="'.$rows['food_id'].'" class="btn btn-danger btn-sm deleteBtn">
                        <i class="fa-fw fa fa-times"></i>
                      </a>
                    </td>
                  </tr>';
  $cnt++;  }

  $output .= '</tbody>
            </table>';

  echo $output;
  }
  else {
      echo '<h2 class="text-danger text-center">No food in the food Menu... Add Food to the Menu</h2>';
  }
}

// Adding Food to the food menu list
if(isset($_POST['food_name'])){
  $foodName     = $conn->real_escape_string($_POST['food_name']);
  $foodImage    = $_FILES['food_image']['name'];
  $foodCat      = $_POST['food_category'];
  $foodStatus   = $_POST['food_status'];
  $foodPrize    = $conn->real_escape_string($_POST['food_prize']);

  $check_food_name = $conn->query("SELECT * FROM food_menu WHERE food_name = '$foodName'");
  if ($check_food_name->num_rows > 0) {
    echo '<div class="alert alert-danger alert-dismissible fade show">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Food Already Exist...try Another
            </div>';
  }
  else{
    if (isset($_FILES['food_image']['name'])) {
      move_uploaded_file($_FILES['food_image']['tmp_name'], "../images/".$foodImage);
    }
    else{
      $foodImage = '';
    }
    $stmt = "INSERT INTO food_menu(food_name, food_image, food_prize, food_status, food_cat_id)";
    $stmt .= "VALUES('$foodName', '$foodImage', '$foodPrize', '$foodStatus', '$foodCat')";

    $query = $conn->query($stmt) or die("Error occurred");
    if($query){
      echo 'ok';
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              An error Occurred...try Again
            </div>';
    }
  }
}

// Getting Food Details Using Id;
if(isset($_POST['food_id'])) {
  $foodId = $_POST['food_id'];
  $query = $conn->query("SELECT * FROM food_menu WHERE food_id = $foodId");
  while ($food = $query->fetch_assoc()) {
    $data = $food;
  }
  echo json_encode($data);
}

// Updating the food in the food menu

if (isset($_POST['new_food_name'])){
  $foodId = $_POST['hiddenId'];
  $foodName = $conn->real_escape_string($_POST['new_food_name']);
  $foodPrize = $conn->real_escape_string($_POST['new_food_prize']);
  $foodCat = $_POST['new_food_category'];
  $foodStatus = $_POST['new_food_status'];
  $file = $_FILES['new_food_image']['name'];

  if ($file == ''){
    $getImage = $conn->query("SELECT * FROM food_menu WHERE food_id = $foodId");
    while($row = $getImage->fetch_assoc()){
      $file = $row['food_image'];
    }
  }
  else {
    move_uploaded_file($_FILES['new_food_image']['tmp_name'], "../images/".$file);
    
  }

  $stmt = "UPDATE food_menu SET food_name = '$foodName', food_image = '$file', food_prize = '$foodPrize', food_status = '$foodStatus', food_cat_id = $foodCat WHERE food_id = $foodId";
  $query = $conn->query($stmt) or die("Error occurred". $conn->error);
  if($query) {
    echo 'ok';
    exit();
  }
}

// Delete A food from food menu list

if(isset($_POST['delId'])) {
  $deleteId = $_POST['delId'];
  $query = $conn->query("DELETE FROM food_menu WHERE food_id = $deleteId");
  exit();
}


