<?php
    if(isset($_POST['b_addCart'])){
        $book_ID=$_POST['b_addCart'];

        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            $_SESSION['cart']=$cart."-".$book_ID;
        }else{
            $_SESSION['cart']=$book_ID;
        }
    }
?>