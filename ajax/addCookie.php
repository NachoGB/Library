<?php
    if(isset($_POST['b_addCart'])){
        $book_ID=$_POST['b_addCart'];

        if(isset($_COOKIE['cart'])){
            $cart = $_COOKIE['cart'];
            setcookie('cart',$cart."-".$book_ID,time() + (86400 * 30), "/");
        }else{
            setcookie('cart',$book_ID,time() + (86400 * 30), "/");
        }
    }
?>