<?php
    include("db_connect.php");
    
    // Protect for post request only
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name     = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price    = $_POST['price'];
        
        $sourFile = $_FILES['thumbnail'];

        $filename = rand(0, 999999999).date('Y-m-d-h-i-s').'.'.pathinfo($sourFile['name'], PATHINFO_EXTENSION);
        
        // if you want ot save image into a folder you need to provide two arguments 
        // frist is tmp location for get the sourfile code, seconds argument is a path and file name for upload to 
        move_uploaded_file( $sourFile['tmp_name'], 'uploads/'.$filename);

        $now = date('Y-m-d');

        $insert_query = "INSERT INTO `products`( `name`, `quantity`, `price`, `thumbnail`, `created_at`, `updated_at`)
                        VALUES ('$name', '$quantity', '$price', '$filename', '$now', '$now')";

        db_connect()->query($insert_query);

        header("Location: main.php?status=success");
    }