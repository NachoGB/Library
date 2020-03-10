<?php
    include('../db/db_connect.php');
    if(isset($_COOKIE['cart'])){
        $infoLS = $_COOKIE['cart'];
        $array = array();

        $numBooks = substr_count($infoLS,"-")+1;
        $book_ID = explode("-",$infoLS);
        for($i=0;$i<$numBooks;$i++){
            $sql = "SELECT book_ID,title,net_price as price FROM books WHERE book_ID='$book_ID[$i]'";
            $res = mysqli_query($conn,$sql);
            $resFetched = mysqli_fetch_assoc($res);
            $resFetched["quantity"]=1;

            if($i==0){
                array_push($array,$resFetched);
            }else{
                $indexBookExisting = array_search($resFetched["book_ID"],array_column($array,"book_ID"),true);
                if($indexBookExisting!==false){
                    $actualBook = $array[$indexBookExisting]["quantity"];
                    $actualBook+=1;
                    $array[$indexBookExisting]["quantity"]=$actualBook;
                }else{
                    array_push($array,$resFetched);
                }
            }
        }

        echo json_encode($array);
    }else{
        echo "{}";
    }
?>