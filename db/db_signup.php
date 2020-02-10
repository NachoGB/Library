<?php
    if(isset($_POST['signup'])){
        $name = $_POST['name'];
        $surname1 = $_POST['surname1'];
        $surname2 = $_POST['surname2'];
        $nickname = $_POST['nickname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        //Start connection
        include('db_connect.php');

        //Prepare query
        $sql="INSERT INTO members(name,surname1,surname2,nickname,phone,address,password,member_type) VALUES('$name', '$surname1', '$surname2', '$nickname', '$phone', '$address', '$password','m')";

        //Search if the isbn exists
        $sql_check="SELECT * FROM members WHERE nickname='$nickname'";
        $result=mysqli_query($conn, $sql_check);
        if(mysqli_num_rows($result)==0){
            //Execute query
            if(mysqli_query($conn, $sql)){
                //success
                header("Location: index.php");
            }else{
                echo 'query error: ' . mysqli_error($conn);
            }
        }else{
            echo '<br><span style="color:red"><strong>This nickname is already existing</strong></span>';
        }
    }
?>