<?php
    include('../db/db_connect.php');

    if(isset($_GET['book_ID'])){
        $book_ID = $_GET['book_ID'];
        $array = explode('-',$book_ID);
        $book_ID = $array[0];
        $member_ID = $array[1];
        
        $searchBook = "SELECT quantity FROM cart WHERE book_ID='$book_ID' AND member_ID='$member_ID'";
        $res = mysqli_query($conn,$searchBook);
        $fetched_res = mysqli_fetch_assoc($res);
        $quantity = $fetched_res['quantity'];
        $quantity = $quantity+1;

        $searchBook = "SELECT books_sell FROM books WHERE book_ID='$book_ID'";
        $resSearchBook = mysqli_query($conn,$searchBook);
        $arrBooksSell = mysqli_fetch_assoc($resSearchBook);
        $booksSell = $arrBooksSell['books_sell'];
        if($booksSell>0){
            $booksSell=$booksSell-1;
            $returnValueBooksSell = "UPDATE books SET books_sell='$booksSell' WHERE book_ID='$book_ID'";
            mysqli_query($conn,$returnValueBooksSell);

            $sql="UPDATE cart SET quantity='$quantity' WHERE book_ID='$book_ID' AND member_ID ='$member_ID'";
            mysqli_query($conn,$sql);
        }
    }
?>