<?php
    //connect to database
    $conn = mysqli_connect('localhost', 'nacho', 'nacho1234', 'library');
    mysqli_set_charset($conn,"utf8");

    //check connection
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>