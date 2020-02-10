<?php
    include('../db/db_connect.php');
    session_start();
    //create sql
    $sql="SELECT cart.member_ID,cart.book_ID,cart.quantity,books.title,books.net_price as price FROM cart INNER JOIN books ON books.book_ID = cart.book_ID WHERE member_ID='".$_SESSION['member_ID']."'";
    //save to db and check
    if(mysqli_query($conn, $sql)){
        $result = mysqli_query($conn, $sql);
    }else{
        echo mysqli_error($conn);
    }
    $cart = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($cart);
?>