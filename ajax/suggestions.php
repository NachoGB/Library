<?php
    include('../db/db_connect.php');
    $sql="SELECT author FROM books";
    $res=mysqli_query($conn,$sql);
    $fetched=mysqli_fetch_all($res);
    $authors=array_unique($fetched,SORT_REGULAR);
    $arraylength = count($authors);
    for($i=0;$i<$arraylength;$i++){
        if($i==0){
            echo ($authors[$i][0]);
        }else{
            echo ("-".$authors[$i][0]);
        }
    }
?>