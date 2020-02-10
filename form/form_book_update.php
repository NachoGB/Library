<?php
    //Start connection
    include('db_connect.php');

    if(isset($_POST['b_book_update'])){
        $book_ID=$_POST['b_book_update'];
        
        $sql = "SELECT * FROM books WHERE book_ID='$book_ID'";
        $bookData = mysqli_query($conn, $sql);
        $bookFetched = mysqli_fetch_assoc($bookData);
        $title = $bookFetched['title'] ?? "";
        $isbn = $bookFetched['isbn'];
        $author = $bookFetched['author'];
        $editorial = $bookFetched['editorial'];
        $category = $bookFetched['category'];
        $language = $bookFetched['language'];
        $publicationyear = $bookFetched['created_at'];
    }
?>
<div class="formBookUpdate">
    <h2>Update a book</h2>
    <form action="" method="POST">
        <label for="book_ID">Book_ID:</label>
        <input type="number" id="book_ID" name="book_ID" value="<?php if(isset($book_ID)){echo $book_ID;}else{echo '';} ?>" required>
        <br><br>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php if(isset($title)){echo $title;}else{echo "";} ?>" required>
        <br><br>
        <label for="isbn">ISBN:</label>
        <input type="number" id="isbn" name="isbn" value="<?php if(isset($isbn)){echo $isbn;}else{echo "";} ?>" required>
        <br><br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php if(isset($author)){echo $author;}else{echo "";} ?>" required>
        <br><br>
        <label for="editorial">Editorial:</label>
        <input type="text" id="editorial" name="editorial" value="<?php if(isset($editorial)){echo $editorial;}else{echo "";} ?>" required>
        <br><br>
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php if(isset($category)){echo $category;}else{echo "";} ?>" required>
        <br><br>
        <label for="language">Language:</label>
        <input type="text" id="language" name="language" value="<?php if(isset($language)){echo $language;}else{echo "";} ?>" required>
        <br><br>
        <label for="publicationyear">Publication year:</label>
        <input type="number" id="publicationyear" name="publicationyear" value="<?php if(isset($publicationyear)){echo $publicationyear;}else{echo "";} ?>" required>
        <br><br>
        <input type="submit" name="book_update" value="Update">
        <input type="hidden" name="b_update_book">
    </form>
</div>