<?php 
    $conn = new Mysqli("localhost", "root", "", "food_ordering_system_db");
    if (!$conn) {
        die("Error connecting to database");
        exit();
    }

?>