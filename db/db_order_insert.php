<?php
    include('db_connect.php');

    if(isset($_POST['order_insert'])){
        $member_ID = $_POST['order_insert'];

        $order_ID = date("YmdHis");
        $order_ID=$order_ID.$member_ID;
        $now = date("Y-m-d H:i:s");

        //create sql
        $getCart = "SELECT cart.book_ID,cart.quantity, books.net_price as price FROM cart INNER JOIN books ON books.book_ID = cart.book_ID WHERE member_ID='".$member_ID."'";

        if(mysqli_query($conn, $getCart)){
            $query = mysqli_query($conn, $getCart);
            $cart = mysqli_fetch_all($query,MYSQLI_ASSOC);

            for($i=0;$i<count($cart);$i++){
                $arrBook_ID = $cart[$i]['book_ID'];
                $book_ID = strval($arrBook_ID);
                $arrQuantity = $cart[$i]['quantity'];
                $quantity = strval($arrQuantity);
                $arrPrice = $cart[$i]['price'];
                $price = strval($arrPrice);
                $insertOrder = "INSERT INTO orders VALUES('$order_ID', '$member_ID', '$book_ID', '$quantity', '$price', '$now')";
                mysqli_query($conn,$insertOrder);
            }

            $deleteCart="DELETE FROM cart WHERE member_ID='$member_ID'";
            mysqli_query($conn,$deleteCart);
        }else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }
?>