<?php
    include('../db/db_connect.php');

    if(isset($_GET['book_ID'])){
        $book_ID = $_GET['book_ID'];
        $array = explode('-',$book_ID);
        $book_ID = $array[0];
        $member_ID = $array[1];
        
        $searchBook = "SELECT quantity FROM cart WHERE book_ID='$book_ID' AND member_ID='$member_ID'";
        if(mysqli_query($conn,$searchBook)){
            $res = mysqli_query($conn,$searchBook);
        }else{
            echo mysqli_error($conn);
        }
        $fetched_res = mysqli_fetch_assoc($res);
        $quantity = $fetched_res['quantity'];
        $quantity = $quantity-1;

        $searchBook = "SELECT books_sell FROM books WHERE book_ID='$book_ID'";
        $resSearchBook = mysqli_query($conn,$searchBook);
        $arrBooksSell = mysqli_fetch_assoc($resSearchBook);
        $booksSell = $arrBooksSell['books_sell'];
        $booksSell=$booksSell+1;
        $returnValueBooksSell = "UPDATE books SET books_sell='$booksSell' WHERE book_ID='$book_ID'";
        mysqli_query($conn,$returnValueBooksSell);

        if($quantity==0){
            $sqlDelete = "DELETE FROM cart WHERE book_ID='$book_ID' AND member_ID ='$member_ID'";
            mysqli_query($conn,$sqlDelete);
        }else{
            $sql="UPDATE cart SET quantity='$quantity' WHERE book_ID='$book_ID' AND member_ID ='$member_ID'";
            if(mysqli_query($conn,$sql)){
                mysqli_query($conn,$sql);
            }else{
                echo mysqli_error($conn);
            }
        }
    }
?>