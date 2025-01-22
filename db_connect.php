<?php

    $host = "localhost";
    $username = "root";
    $port = 3305;
    $password = "";
    $db_name = "new_crud_image";
    
    function db_connect() {
        global $host, $username, $port, $password, $db_name;
        return new mysqli(hostname: $host, username: $username, port: $port, password: $password, database: $db_name);
    }
