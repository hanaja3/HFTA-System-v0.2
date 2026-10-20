<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "patient_management_system";

    $conn = mysqli_connect($server, $username, $password ,$database);


    if(!$conn){

        die("Database Connection Failed! " . mysqli_connect_error());

    }
?>