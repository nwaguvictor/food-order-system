<?php 
    require_once("../admin_partials/db.php");
    session_start();

    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        $email = $conn->real_escape_string($_POST['email']);
        $password = md5($conn->real_escape_string($_POST['password']));

        // CHECKING TO CONFIRM EMAIL AND PASSWORD OF USER

        $query = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
        if ($query->num_rows == 1) {
            while ($row = $query->fetch_assoc()) {
                $_SESSION['user'] = $row;
            }
            echo 'ok';
        }
        else {
            echo '<div class="alert alert-danger alert-dismissable fade show">
                <button class="close" type="button" data-dismiss="alert">&times;</button>
                E-mail or password incorrect.
            </div>';
        }
    }

?>