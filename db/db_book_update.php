<?php
    //Start connection
    include('db_connect.php');

    if(isset($_POST['book_update'])){
        $book_ID = $_POST['book_ID'];
        $title = strtolower(mysqli_real_escape_string($conn, $_POST['title']));
        $isbn = $_POST['isbn'];
        $author = strtolower(mysqli_real_escape_string($conn, $_POST['author']));
        $editorial = strtolower(mysqli_real_escape_string($conn, $_POST['editorial']));
        $category = strtolower(mysqli_real_escape_string($conn, $_POST['category']));
        $language = strtolower(mysqli_real_escape_string($conn, $_POST['language']));
        $publicationYear = $_POST['publicationyear'];

        //Search if the isbn exists
        $sql_check="SELECT * FROM books WHERE book_ID='$book_ID'";
        $result=mysqli_query($conn, $sql_check);
        if(mysqli_num_rows($result)>0){
            //Prepare query & execute query
            $sql="UPDATE books SET title='$title',isbn='$isbn',author='$author',editorial='$editorial',category='$category',language='$language',created_at='$publicationYear' WHERE book_ID='$book_ID'";
            if(mysqli_query($conn,$sql)){
                //success
                echo '<p id="succes">Book updated!</p>';
            }else{
                echo 'query error: ' . mysqli_error($conn);
            }
        }else{
            echo '<p id="error">Write an existing Book_ID</p>';
        }        
    }
?>