<?php
require_once("../admin_partials/db.php");

// CHECKS FOR EMAIL AVAILABILITY AND REPORT TO THE WHEN FILLING FORM

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $query = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($query->num_rows > 0) {
        echo '<div class="alert alert-danger alert-dismissable fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Email Already Exist...try Again!
            </div>';
    }

}


// CHECKS E_MAIL AND REGISTER NEW USER
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $state = $conn->real_escape_string($_POST['state']);
    $address = $conn->real_escape_string($_POST['address']);
    $password = md5($conn->real_escape_string($_POST['password']));

    $check_email = $conn->query("SELECT * FROM users WHERE email = '$email'");
    $query = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($query->num_rows > 0) {
    //    email already exist
    return false;
    } else {
        $insert_sql = "INSERT INTO users(firstname, lastname, email, phone, state, address, role, password)
         VALUES('$firstname', '$lastname', '$email', '$phone', '$state', '$address', 'subscriber', '$password')";
         $insert_query = $conn->query($insert_sql) or die("Failed to complete Registration");
         if ($insert_query){
             echo 'ok';
         }
    }
}

?>
