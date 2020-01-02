<?php
// SCRIPT FOR MANIPULATING THE SESSION CART $_SESSION['cart']

    include("../admin_partials/db.php");
    // ini_set(session.cookie_lifetime, 60 * 60 * 24 * 7);
    // ini_set(session.gcmaxlifetime, 60 * 60 * 24);
    session_start();

// Adding Item to Cart
    if (isset($_POST['action']) && $_POST['action'] == 'add_item') {
        $data = array();
        $qty = 1;
        $foodId = $_POST['foodId'];
        $item = array("item_id" => $foodId, 'qty' => $qty);

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }

        if(in_array($foodId, array_column($_SESSION['cart'], "item_id"))){
            echo 0;
            return false;
        }
        else {
            array_push($_SESSION['cart'], $item);
            echo 1;
            return true;
        }

        return count($_SESSION['cart']);
    }


// Cart Count
if (isset($_GET['action']) && $_GET['action'] == 'cart_count') {
    if (isset($_SESSION['cart'])){
        echo count($_SESSION['cart']);
    }
    else {
        echo '0';
    }
}

// Deleting a single item from cart
// Removing function removeItem()
function removeItem($id) {
    foreach($_SESSION['cart'] as $key => $value) {
        if ($value['item_id'] == $id){
            unset($_SESSION['cart'][$key]);
            return true;
        }
    }
}

// Removing script
if(isset($_POST['action']) && $_POST['action'] == 'remove_item') {
    $foodId = $_POST['foodId'];
    $resp = removeItem($foodId);
    if ($resp == true) {
        echo "ok";
    }

}

// Updating the cart
function updateCart($id, $qty) {
    $newItem = array('qty' => $qty);
    foreach($_SESSION['cart'] as $key => $value) {
        if ($value['item_id'] == $id){
            $_SESSION['cart'][$key]['qty'] = $qty;
            return true;
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'update_cart'){
    $qty = $conn->real_escape_string($_POST['foodQty']);
    $newQty = $qty < 1 ? 1 : $qty;
    $id = $_POST['foodId'];
    $rep = updateCart($id, $newQty);
    if ($rep == true) {
        echo 'ok';
    }
}

// Remove all from cart
if (isset($_POST['action']) && $_POST['action'] == 'reset') {
    $_SESSION['cart'] = null;
    echo "Cart Cleared";
}


?>
