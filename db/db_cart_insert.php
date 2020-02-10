<?php
    include('db_connect.php');

    if(isset($_POST['b_addCart'])){
        $book_ID=$_POST['b_addCart'];
        
        //create sql
            $today = date('Y-m-d');
            $insertCart = "INSERT INTO cart(member_ID,book_ID,quantity,created_on) VALUES('$member_ID', '$book_ID',1,'$today')";
            $searchBook = "SELECT books_sell FROM books WHERE book_ID='$book_ID'";
            $resSearchBook = mysqli_query($conn,$searchBook);
            $arrBooksSell = mysqli_fetch_assoc($resSearchBook);
            $booksSell = $arrBooksSell['books_sell'];
            $booksSell = $booksSell-1;
            
            $updateBook = "UPDATE books SET books_sell='$booksSell' WHERE book_ID='$book_ID'";
            mysqli_query($conn,$updateBook);

            if(mysqli_query($conn, $insertCart)){
                //success
                echo '<p id="succes">Book added to the cart!</p>';
            }else{
                echo '<p id="succes">You already added the book to the cart!</p>';
            }
    }
?>