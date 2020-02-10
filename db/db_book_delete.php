<?php
    //Start connection
    include('db_connect.php');

    if(isset($_POST['book_delete'])){
        $book_ID = $_POST['book_ID'];

        //Prepare query
        $sql="DELETE FROM books WHERE book_ID='$book_ID'";

        //Search if the isbn exists
        $sql_check="SELECT * FROM books WHERE book_ID='$book_ID'";
        $result=mysqli_query($conn, $sql_check);
        if(mysqli_num_rows($result)>0){
            //Execute query
            if(mysqli_query($conn, $sql)){
                //success
                echo '<p id="succes">Book deleted!</p>';
            }else{
                echo 'query error: ' . mysqli_error($conn);
            }
        }else{
            echo '<p id="error">Write an existing Book_ID</p>';
        }
    }
?>