<?php
    include('db_connect.php');

    if(isset($_POST['book_insert'])){
        $title = $_POST['title'];
        $title = addslashes($title);
        $isbn = $_POST['isbn'];
        $author = $_POST['author'];
        $author = addslashes($author);
        $editorial = $_POST['editorial'];
        $editorial = addslashes($editorial);
        $category = $_POST['category'];
        $category = addslashes($category);
        $language = $_POST['language'];
        $publicationYear = $_POST['publicationyear'];

        
        //create sql
        //Query to get the number of books (i need it when i insert a new book for the foreign-key)
        $cont = "SELECT COUNT(*) FROM books";
        $query = mysqli_query($conn, $cont);
        $row = mysqli_fetch_array($query);

        if(mysqli_query($conn, $cont)){
            $sql = "INSERT INTO books(title,isbn,author,editorial,category,language,created_at,status,location_ID) VALUES('$title', '$isbn', '$author', '$editorial', '$category', '$language', '$publicationYear','1' , $row[0]+1)";
        }
        //save to db and check
        if(mysqli_query($conn, $sql)){
            //success
            echo '<p id="succes">Book inserted!</p>';
        }else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }
?>