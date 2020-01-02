<?php
    require_once("../admin_partials/db.php");

    // Showing all category
    if (isset($_POST['action']) && $_POST['action'] == 'view_food_cat') {
        $cnt = 1;
        $output = '';
        $query = $conn->query("SELECT * FROM food_category ORDER BY cat_id DESC") or die('Failed to load Category');
        if ($query->num_rows > 0){
            $output = '<table id="cat-table" class="table table-sm table-hover table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>S/N</th>
                    <th>CATEGORIES</th>
                    <th>CREATED AT</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>';

            while ($rows = $query->fetch_assoc()){
                $output .= '<tr class="text-center">
                            <td>'.$cnt.'</td>
                            <td>'.$rows['cat_title'].'</td>
                            <td>'.$rows['created_at'].'</td>
                            <td>
                                <a id="'.$rows['cat_id'].'" class="btn btn-primary btn-sm editBtn" href=""><i class="fa fa-fw fa-edit fa-lg"></i></a>
                                <a id="'.$rows['cat_id'].'" class="btn btn-danger btn-sm delBtn" href=""><i class="fa fa-fw fa-times fa-lg"></i></a>
                            </td>
                        </tr>';
                $cnt++;
            }

            $output .= '</tbody>
                    </table>';
            echo $output;

        }
        else {
            echo '<h3 class="text-center text-danger">No data Found in the Table</h3>';
        }
    }

    // Adding Category
    if (isset($_POST['cat_name'])) {
        $catName = $conn->real_escape_string($_POST['cat_name']);

        $check_cat = $conn->query("SELECT cat_title FROM food_category WHERE cat_title = '$catName'");

        if ($check_cat->num_rows > 0){
            return false;
        }
        else {
            $query = $conn->query("INSERT INTO food_category(cat_title) VALUES('$catName')");
            if ($query){
                echo 'ok';
            }
        }
    }


    // DELETING FOOD CATEGORY
    if(isset($_POST['cat_id'])){
        $catId = $_POST['cat_id'];
        $query = $conn->query("DELETE FROM food_category WHERE cat_id = $catId") or die("Error occurred");
        if($query){
            echo 'ok';
        }
        else{
            return false;
        }
    }

    // SELECT FOOD CATEGORY DETAILS
    if(isset($_POST['the_cat_id'])){
        $the_cat_id = $_POST['the_cat_id'];
        $query = $conn->query("SELECT * FROM food_category WHERE cat_id = $the_cat_id");
        if ($query->num_rows == 1) {
            $row = $query->fetch_assoc();
        }

        echo json_encode($row);
    }

    // Updating Food Cat
    if (isset($_POST['editCatId'])) {
        $cat_title = $_POST['newCatName'];
        $cat_id = $_POST['editCatId'];

        // ||||||||||||||||||||||||||||||Coming back to fix this bug!!!!!!!!!!!!!!!!!!!!!!

        // $check_cat_name = $conn->query("SELECT * FROM food_category WHERE cat_title = '$cat_title'");
        // if ($check_cat_name->num_rows > 0){
        //     echo 'Category Name Already Exist';
        // }
        // else {
            $query = $conn->query("UPDATE food_category SET cat_title = '$cat_title' WHERE cat_id = $cat_id");
            if ($query){
                echo 'ok';
            }
            else {
                return false;
            }
        // }


    }
?>
