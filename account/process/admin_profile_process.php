<?php
    include_once("../admin_partials/db.php");

    if(isset($_POST['action']) && $_POST['action'] == 'update_admin') {
        $user_id = $_POST['userId'];
        $fname = $conn->real_escape_string($_POST['fname']);
        $lname = $conn->real_escape_string($_POST['lname']);
        $state = $conn->real_escape_string($_POST['state']);
        $address = $conn->real_escape_string($_POST['address']);
        $phone = $conn->real_escape_string($_POST['phone']);

        $query = $conn->query("UPDATE users SET firstname = '$fname', lastname = '$lname', phone = '$phone', state = '$state', address = '$address' WHERE user_id = $user_id");
        if($query){
            session_start();
            $_SESSION['user']['firstname'] = $fname;
            $_SESSION['user']['lastname'] = $lname;
            $_SESSION['user']['state'] = $state;
            $_SESSION['user']['address'] = $address;
            $_SESSION['user']['phone'] = $phone;
            echo 'ok';
        }


    }

    // Will process it 

    // if (isset($_POST['action']) && $_POST['action'] == 'password') {
    //     $oldPass = $conn->real_escape_string($_POST['oldPass']);
    //     $newPass = $conn->real_escape_string($_POST['newPass']);
    //     $cPass = $conn->real_escape_string($_POST['cPass']);
    //
    //     $query = $conn->query("SELECT * FROM users WHERE password = '$oldPass'");
    //     if ($query->num_rows == 1) {
    //
    //     }
    // }
?>
