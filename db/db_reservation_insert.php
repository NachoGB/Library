<?php
    include('db_connect.php');

    if(isset($_POST['reservation_insert'])){
        $book_ID = $_POST['book_ID'];
        $member_ID = $_POST['member_ID'];
        $date = $_POST['date'];
        
        //Prepare query
        $time = strtotime($date);
        $finalDate = date("Y-m-d", strtotime("+1 month", $time));
        $reservation = "INSERT INTO reservations(book_ID,member_ID,initialDate,finalDate,realFinalDate) VALUES('$book_ID', '$member_ID', '$date','$finalDate','')";

        //Filters & execute the query
        $sql_check1="SELECT status FROM books WHERE book_ID='$book_ID'";
        $sql_check2="SELECT * FROM members WHERE member_ID='$member_ID'";
        $sql_check3="SELECT next_allowed_reservation FROM MEMBERS WHERE member_ID='$member_ID'";
        $sql_check4="SELECT status FROM books WHERE book_ID='$book_ID'";
        $result1=mysqli_query($conn, $sql_check1);
        $result2=mysqli_query($conn, $sql_check2);
        $result3=mysqli_query($conn, $sql_check3);
        $result4=mysqli_query($conn, $sql_check4);
        $datePenalization = mysqli_fetch_assoc($result3);
        $next_allowed_reservation = $datePenalization['next_allowed_reservation'];
        $status = mysqli_fetch_assoc($result4);
        $book_status = $status['status'];
        if(mysqli_num_rows($result1)>0){
            if(mysqli_num_rows($result2)>0){
                if($next_allowed_reservation <= $date){
                    if($book_status==1){
                        //Execute query
                        if(mysqli_query($conn, $reservation)){
                            $updateStatus="UPDATE books SET status='0' WHERE book_ID='$book_ID'";
                            if(mysqli_query($conn,$updateStatus)){
                                //success
                                echo '<p id="succes">Reservation done! The '.$date.' you must go to the library for the book.</p>';
                            }else{
                                echo 'query error: ' . mysqli_error($conn);
                            }
                        }else{
                            echo 'query error: ' . mysqli_error($conn);
                        }
                    }else{
                        echo '<p id="error">This book is not available in this moment</p>';
                    }
                }else{
                    echo '<p id="error">This member cannot do reservation until '.$next_allowed_reservation.'</p>';
                }
            }else{
                echo '<p id="error">Write an existing member_ID</p>';
            }
        }else{
            echo '<p id="error">Write an existing book_ID</p>';
        }
    }
?>