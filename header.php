<?php
    session_start();
    
    $member_ID=$_SESSION['member_ID'] ?? 'guest';
    $nickname=$_SESSION['nickname'] ?? 'guest';
    $member_type = $_SESSION['member_type'] ?? 'g';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Nacho Library</title>
    <link rel="stylesheet" type="text/css" href="./style/styles.css" />
    <script type="text/javascript" src="./ajax/showTime.js"></script>
    <script type="text/javascript" src="./ajax/showCart.js"></script>
</head>

<body>
    <header>
        <img id="logo" src="./img/Logo Library.png" alt="Logo Nacho's Library">
        <p id="clock"></p>
    </header>
    <div id="searchingBar">
        <div id="nav">
            <?php
                switch($member_type){
                    case 'g':include('form/form_button_guest.php');break;
                    case 'm':include('form/form_button_member.php');break;
                    case 'l':include('form/form_button_librarian.php');break;
                }
            ?>
        </div>
        <?php
            if($member_type!='g'){
        ?>
        <div id="buttonCart">
            <button id="carritoCompra" onclick="showCart()"></button>
        </div>
        <?php
            }
        ?>
    </div>
    <div id="content">
    <h1 class="welcome">Welcome <?php echo $nickname ?></h1>
    <div id="containerTable"></div>
    