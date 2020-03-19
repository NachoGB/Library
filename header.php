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
    <link rel="icon" href="./img/Logo Library.png" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="./style/styles.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="./ajax/showTime.js"></script>
    <script type="text/javascript" src="./ajax/showCart.js"></script>
    <script type="text/javascript" src="./ajax/addLocalStorage.js"></script>
    <script type="text/javascript" src="./ajax/weather.js"></script>
    <script type="text/javascript" src="./ajax/suggestions.js"></script>
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
            if($member_type=='g'){
        ?>
        <div id="buttonCart">
            <button id="carritoCompra" onclick="showCartGuest()"></button>
        </div>
        <?php
            }else{
        ?>
        <div id="buttonCart">
            <div id="cartDB">
                <button id="carritoCompra" onclick="showCart()"></button>
                <p>DB</p>
            </div>
            <div id="cartSession">
                <button id="carritoCompra" onclick="showCartSession()"></button>
                <p>Session</p>
            </div>
            <div id="cartCookie">
                <button id="carritoCompra" onclick="showCartCookie()"></button>
                <p>Cookie</p>
            </div>
            <div id="weatherDiv">
                <form action="" method="POST">
                    <button type="submit" id="weather" name="weather"></button>
                </form>
                <p>Weather</p>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <div id="content">
    <h1 class="welcome">Welcome <?php echo $nickname ?></h1>
    <div id="containerTable"></div>
    