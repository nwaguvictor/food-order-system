<?php
    include_once("../admin_partials/db.php");
    session_start();

    function deliveryAddress() {
        if (!isset($_SESSION['address'])){
            $_SESSION['address'] = array();
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'payment') {
        // echo payNow();
        $data = array();

        if (!isset($_SESSION['user'])) {
            return false;
        } else {
            $data['name'] = $_SESSION['user']['firstname'].' '. $_SESSION['user']['lastname'];
            $data['email'] = $_SESSION['user']['email'];
            $data['phone'] = $_SESSION['user']['phone'];

        }
        echo json_encode($data);
    }

?>
