<div class="formBookInsert">
    <h2>Insert a new book</h2>
    <form action="" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br><br>
        <label for="isbn">ISBN:</label>
        <input type="number" id="isbn" name="isbn" required>
        <br><br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        <br><br>
        <label for="editorial">Editorial:</label>
        <input type="text" id="editorial" name="editorial" required>
        <br><br>
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required>
        <br><br>
        <label for="language">Language:</label>
        <input type="text" id="language" name="language" required>
        <br><br>
        <label for="publicationyear">Publication year:</label>
        <input type="number" id="publicationyear" name="publicationyear" required>
        <br><br>
        <input type="submit" name="book_insert" value="Insert">
        <input type="hidden" name="b_insert_book">
    </form>
</div>