<?php
    //Start connection
    include('db_connect.php');

    if(isset($_POST['book_select'])){
        $author = mysqli_real_escape_string($conn, $_POST['author']);

        //Prepare query
        $sql="SELECT * FROM books WHERE status=1 AND books_sell>0 AND author LIKE '%".$author."%'";

        //Execute query
        $result = mysqli_query($conn,$sql);

        //Get result
        $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo "<div id='books'>";
            foreach($books as $book){
                echo "<div class='book'>";
                echo "<div class='image'></div>";
                echo "<div class='info_book'><strong>".ucfirst($book['title'])."</strong>&nbsp;written by&nbsp;<strong>".ucfirst($book['author'])."</strong></div>";
                if($member_type=='l'){
                    echo "<div class='buttons_book'><form method='POST'>";
                    echo "<button type='submit' class=b_book_update name='b_book_update' value='".$book['book_ID']."'></button>";
                    echo "<button type='submit' class=b_reservation name='b_reservation' value='".$book['book_ID']."'></button>";
                    echo "<button type='submit' class=b_book_remove name='b_book_remove' value='".$book['book_ID']."'></button>";
                    echo "<button type='submit' class=b_addCart name='b_addCart' value='".$book['book_ID']."'></button>";
                }
                if($member_type=='m'){
                    echo "<div class='buttons_book'><form method='POST'>";
                    echo "<button type='submit' class=b_reservation name='b_reservation' value='".$book['book_ID']."'></button>";
                    echo "<button type='submit' class=b_addCart name='b_addCart' value='".$book['book_ID']."'></button>";
                }
                if($member_type=='g'){
                    echo "<div></div>"; //I put this empty div for better appearing.
                }
                echo "</form></div></div>";
            }
            echo "</div>";
    }
?>