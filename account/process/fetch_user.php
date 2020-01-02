<?php 
    require_once("../admin_partials/db.php");

    if (isset($_POST['userId']) && $_POST['action'] == 'view_user'){
        $user_id = $_POST['userId'];
        $query = $conn->query("SELECT * FROM users WHERE user_id = $user_id");

        if ($query->num_rows == 1){
            $data = $query->fetch_assoc();
            
        }
        echo json_encode($data);
    }

?>