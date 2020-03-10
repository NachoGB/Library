<?php include('header.php') ?>

<div id="search_a_book">
<?php
    if(isset($_POST['b_select_book'])){include('form/form_book_select.php');}
    if(isset($_POST['book_select'])){include('db/db_book_select.php');}
?>
</div>
<?php
    if(isset($_POST['b_login'])){include('form/form_login.php');}
    if(isset($_POST['login'])){include('db/db_login.php');}

    if(isset($_POST['b_logout'])){include('db/db_logout.php');}

    if(isset($_POST['b_signup'])){include('form/form_signup.php');}
    if(isset($_POST['signup'])){include('db/db_signup.php');}

    if(isset($_POST['b_insert_book'])){include('form/form_book_insert.php');}
    if(isset($_POST['book_insert'])){include('db/db_book_insert.php');}

    if(isset($_POST['b_addCart'])){include('db/db_cart_insert.php');include('ajax/addSession.php');include('ajax/addCookie.php');}

    //Button to update when i search a book
    if(isset($_POST['b_book_update'])){include('form/form_book_update.php');}

    if(isset($_POST['b_update_book'])){include('form/form_book_update.php');}
    if(isset($_POST['book_update'])){include('db/db_book_update.php');}
    //Button to delete when i search a book
    if(isset($_POST['b_book_remove'])){include('form/form_book_delete.php');}

    if(isset($_POST['b_delete_book'])){include('form/form_book_delete.php');}
    if(isset($_POST['book_delete'])){include('db/db_book_delete.php');}

    if(isset($_POST['b_reservation'])){include('form/form_reservation_insert.php');}
    if(isset($_POST['reservation_insert'])){include('db/db_reservation_insert.php');}

    if(isset($_POST['b_finish_reservation'])){include('form/form_finish_reservation.php');}
    if(isset($_POST['finishReservation'])){include('db/db_finish_reservation.php');}

    if(isset($_POST['order_insert'])){include('db/db_order_insert.php');}
?>

<?php include('footer.php') ?>