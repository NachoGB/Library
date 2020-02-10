<?php
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    
    //Start connection
    include('db_connect.php');

    //Prepare query
    $sql="SELECT * FROM members WHERE nickname='$nickname' AND password='$password'";
    //Execute query
    if(!mysqli_query($conn, $sql)){
        echo mysqli_error($conn);
    }
    $result=mysqli_query($conn, $sql);
    $result_fetched=mysqli_fetch_assoc($result); //Save the information to compare it if is member or librarian
    
    $member_type=$result_fetched['member_type'];
    $member_ID=$result_fetched['member_ID'];
    echo $member_type;
    echo $member_ID;
    echo $nickname;
        
    $_SESSION['member_ID'] = $member_ID;
    $_SESSION['nickname'] = $nickname;
    $_SESSION['member_type'] = $member_type;

    header("location: index.php");
?>