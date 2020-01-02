<?php
    require_once("../admin_partials/db.php");
    session_start();

    if (isset($_POST['action']) && $_POST['action'] === 'check_login') {
        $data = array();

        if (!isset($_SESSION['user'])) {
            return false;
        } else {
            echo 'ok';
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'store_order') {
        $grandTotal = '0';
        $orderNumber = rand(999990, 000000);
        $user_id = $_SESSION['user']['user_id'];
        $name = $conn->real_escape_string($_POST['name']);
        $address = $conn->real_escape_string($_POST['address']);
        $phone = $conn->real_escape_string($_POST['phone']);
        foreach($_SESSION['cart'] as $item) {
            $foodId = $item['item_id'];
            $qty = $item['qty'];

            $query = $conn->query("SELECT * FROM food_menu WHERE food_id = '$foodId'");
            if ($query->num_rows > 0) {
                while($row = $query->fetch_assoc()) {
                    $food_id = $row['food_id'];
                    $foodPrize = $row['food_prize'];
                }

                $foodTotalPrize = $foodPrize * $qty; 
            }

            $grandTotal += $foodTotalPrize;
        }

        // Inserting to the order table
        
        $sql = "INSERT INTO user_orders(userId, orderNumber, orderUserName, orderUserAddress, orderUserPhone, orderAmount, orderStatus)";
        $sql .= "VALUES('$user_id', '$orderNumber', '$name', '$address', '$phone', '$grandTotal', 'on_delivery')";

        $query = $conn->query($sql) or die("ERROR occured". $conn->error);
        if ($query == true) {
           $lastId = $conn->insert_id;

            // Insert into the user items table
            foreach($_SESSION['cart'] as $item) {
                $foodId = $item['item_id'];
                $qty = $item['qty'];

                $query = $conn->query("SELECT * FROM food_menu WHERE food_id = '$foodId'");
                if ($query->num_rows > 0) {
                    while($row = $query->fetch_assoc()) {
                        $food_id = $row['food_id'];
                        $food_name = $row['food_name'];
                        $foodPrize = $row['food_prize'];
                        $foodImage = $row['food_image'];
                    }

                    $foodTotalPrize = $foodPrize * $qty; 

                    $sql = "INSERT INTO user_items(userOrderId, itemName, itemImage, itemPrize, itemQty, itemTotalPrize)";
                    $sql .= "VALUES($lastId, '$food_name', '$foodImage', '$foodPrize', '$qty', '$foodTotalPrize' )";

                    $query = $conn->query($sql) or die("ERROR occured" . $conn->error);
                }

            }

        }

        

    }


    // Updating the user orders
    if (isset($_POST['action']) && $_POST['action'] == 'update_order') {
        $orderId = $conn->real_escape_string($_POST['orderId']);

        $query = $conn->query("UPDATE user_orders SET orderStatus = 'delivered' WHERE orderId = '$orderId'");
        if ($query == true) {
            echo 'ok';
        }
    }
$conn->close();

?>
