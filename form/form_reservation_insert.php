<?php
    //Start connection
    include('db_connect.php');

    if(isset($_POST['b_reservation'])){
        $book_ID=$_POST['b_reservation'];
    }
?>
<div class="formReservationInsert">
    <h2>Reservations</h2>
    <form action="" method="POST">
        <input type="number" name="book_ID" placeholder="Book_ID" value="<?php if(isset($book_ID)){echo $book_ID;}else{echo '';} ?>" required>
        <br><br>
        <input type="number" name="member_ID" placeholder="Member_ID" value="<?php if(isset($member_ID)){echo $member_ID;}else{echo '';} ?>" required>
        <br><br>
        <input type="date" name="date" required>
        <br><br>
        <input type="submit" name="reservation_insert" value="Reservation">
        <input type="hidden" name="b_reservation">
    </form>
</div>