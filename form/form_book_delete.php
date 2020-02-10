<?php
    //Start connection
    include('db_connect.php');

    if(isset($_POST['b_book_remove'])){
        $book_ID=$_POST['b_book_remove'];
    }
?>
<div class="formBookDelete">
    <h2>Delete a book:</h2>
    <form action="" method="POST">
        <input type="number" id="book_ID" name="book_ID" placeholder="Book_ID" value="<?php if(isset($book_ID)){echo $book_ID;}else{echo '';} ?>" required>
        <input type="submit" name="book_delete" value="Delete">
        <input type="hidden" name="b_delete_book">
    </form>
</div>