<?php
    include('../db/db_connect.php');
    session_start();
    if(isset($_GET['infoLS'])){
        $infoLS = $_GET['infoLS'];

        if(strlen($infoLS)>0){
            $today = date('Y-m-d');
            $numBooks = substr_count($infoLS,"-")+1;
            $book_ID = explode("-",$infoLS);
            for($i=0;$i<$numBooks;$i++){
                $book = $book_ID[$i];
                $member = $_SESSION['member_ID'];
                //check if the current book_ID exists in the cart table
                $allCart = "SELECT * FROM cart WHERE book_ID=$book AND member_ID=$member";
                $resAllCart = mysqli_query($conn,$allCart);
                if(mysqli_num_rows($resAllCart)>0){
                    $fetchedAllCart = mysqli_fetch_assoc($resAllCart);
                    $quantity = $fetchedAllCart["quantity"];
                    $quantity+=1;
                    $updateCart = "UPDATE cart SET quantity=$quantity WHERE book_ID=$book AND member_ID=$member";
                    mysqli_query($conn,$updateCart);
                }else{
                    $insertbook = "INSERT INTO cart VALUES($member,$book,1,'$today')";
                    mysqli_query($conn,$insertbook);
                }
                //get bookSell value to update it
                $searchBookSell = "SELECT books_sell FROM books WHERE book_ID=$book";
                $resSearchBooksSell = mysqli_query($conn,$searchBookSell);
                $fetchedBookSell = mysqli_fetch_assoc($resSearchBooksSell);
                $bookSell = $fetchedBookSell['books_sell'];
                $bookSell=$bookSell-1;
                $updateBookSell = "UPDATE books SET books_sell=$bookSell WHERE book_ID=$book";
                mysqli_query($conn,$updateBookSell);
            }
        }
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
    }
?>