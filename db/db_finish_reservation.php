<?php
    include('db_connect.php');

    if(isset($_POST['finishReservation'])){
        $reservation_ID = $_POST['reservation_ID'];
        
        //Prepare query
        $search_book_ID = "SELECT book_ID FROM reservations WHERE reservation_ID='$reservation_ID'";
        $search_member_ID = "SELECT member_ID FROM reservations WHERE reservation_ID='$reservation_ID'";
        $query_finalDate = "SELECT finalDate FROM reservations WHERE reservation_ID='$reservation_ID'";
        $today = date('Y-m-d');

        //Filters & execute the query
        $sql_check="SELECT * FROM reservations WHERE reservation_ID='$reservation_ID'";
        $result=mysqli_query($conn, $sql_check);
        if(mysqli_num_rows($result)>0){
            //Execute query
            if(mysqli_query($conn, $search_book_ID)){
                $resBook_ID = mysqli_query($conn, $search_book_ID);
                $fetched_book_ID = mysqli_fetch_assoc($resBook_ID);
                //We need do that because we use this variable in other queries
                $book_ID = $fetched_book_ID['book_ID'];
                if(mysqli_query($conn, $query_finalDate)){
                    //Change the status of the book always
                    $changeStatus = "UPDATE books SET status='1' WHERE book_ID='$book_ID'";
                    if(mysqli_query($conn, $changeStatus)){
                        echo '<p id="succes">Status of the book changed!</p>';
                    }else{
                        echo 'query error: ' . mysqli_error($conn);
                    }
                    //Set the realFinalDate
                    $realFinalDate = "UPDATE reservations SET realFinalDate='$today' WHERE book_ID='$book_ID'";
                    if(mysqli_query($conn, $realFinalDate)){
                        echo '<p id="succes">The realFinalDate have been set!</p>';
                    }else{
                        echo 'query error: ' . mysqli_error($conn);
                    }
                    //See if the user returned the book on time
                    $finalDate = mysqli_query($conn, $query_finalDate);
                    $res = mysqli_fetch_assoc($finalDate);
                    if($res['finalDate']>=$today){
                        echo '<p id="succes">The user returned the book on time!</p>';
                    }else{
                        $dateFinalDate = date_create($res['finalDate']);
                        $suspension = date_diff($dateFinalDate,$today)->format('%a');
                        $next_allowed_reservation = date("Y-m-d", strtotime($today." +".$suspension." days"));

                        $resMember_ID = mysqli_query($conn, $search_member_ID);
                        $fetched_member_ID = mysqli_fetch_assoc($resMember_ID);
                        $member_ID = $fetched_member_ID['member_ID'];

                        $change_next_allowed_reservation = "UPDATE members SET next_allowed_reservation='$next_allowed_reservation' WHERE member_ID='$member_ID'";
                        mysqli_query($conn, $change_next_allowed_reservation);
                        echo '<p id="error">You have been penalizated, your next day that you can reserve a book is '.$next_allowed_reservation.'</p>';
                    }
                    $reservations_log = "SELECT * FROM reservations WHERE reservation_ID='$reservation_ID'";
                    $resReservations_log = mysqli_query($conn, $reservations_log);
                    $res_fetched_reservations_log = mysqli_fetch_assoc($resReservations_log);

                    $reservation_ID_log = $res_fetched_reservations_log['reservation_ID'];
                    $book_ID_log = $res_fetched_reservations_log['book_ID'];
                    $member_ID_log = $res_fetched_reservations_log['member_ID'];
                    $initialDate_log = $res_fetched_reservations_log['initialDate'];
                    $finalDate_log = $res_fetched_reservations_log['finalDate'];
                    $realFinalDate_log = $res_fetched_reservations_log['realFinalDate'];

                    $insert_log = "INSERT INTO reservations_log(reservation_ID,book_ID,member_ID,initialDate,finalDate,realFinalDate) VALUES('$reservation_ID_log','$book_ID_log','$member_ID_log','$initialDate_log','$finalDate_log','$realFinalDate_log')";
                    mysqli_query($conn, $insert_log);
                    $delete_reservation = "DELETE FROM reservations WHERE reservation_ID='$reservation_ID'";
                    mysqli_query($conn, $delete_reservation);
                }else{
                    echo 'query error: ' . mysqli_error($conn);
                }
            }else{
                echo 'query error: ' . mysqli_error($conn);
            }
        }else{
            echo '<p id="error">Write an existing reservation_ID</p>';
        }
    }
?>