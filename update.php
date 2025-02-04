<?php

    include("db_connect.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['edit-id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $sourFile = $_FILES['thumbnail'];

        echo "step1";
        if ($sourFile['name']) {
            $fileName = rand(0, 999999999).date('Y-m-d-h-i-s').'.'.pathinfo($sourFile['name'], PATHINFO_EXTENSION);
            move_uploaded_file( $sourFile['tmp_name'], 'uploads/'.$fileName);
        } else {
            $fileName = $_POST['old-thumbnail'];
        }
        echo $fileName;

        $now = date('Y-m-d');
        $query_update = "UPDATE `Products` SET `name` = '$name', `price` = '$price', `quantity` = '$quantity', `thumbnail` = '$fileName', `updated_at` = '$now' WHERE `id` = '$id';";
        
        db_connect()->query(query: $query_update);
        header("Location: main.php");
    }