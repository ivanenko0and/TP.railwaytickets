<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Залізничні квитки</title>
    <link rel="stylesheet" href="css\\style.css">
    <?php
    require "modules\\signInAndLogOutButtons.php";
    require "modules\\orderingModule.php";
    ?>
</head>
<body>
    
    <div class="wrapper">
    
    <header>
        <form name="mainForm" id="mainForm" action="index.php" method="post">
        <input type="hidden" name="login" value="<?php echo $_POST["login"];?>">
        <input id="title" type="submit" value="railwaytickets.ua">
        </form>
        <?php signInAndLogOutButtons(); ?>
    </header>
    
    
    <div class="order_container">
        
        <?php
        Ordering::setCurrentStage();
        Ordering::returnButton();
        ?>
        
        <p align=center>Оформлення квитків</p>
            
        <?php

        $ticketsNumber = "";
        $paymentType = "";

        $ticketsNumberError = "";
        
        $cardNumError = "";
        $pinCodeError = "";
        
        
        Ordering::firstStage();
        Ordering::secondStage();
        Ordering::thirdStage();
        
        ?>
        
    </div>
    
    </div>
    
    
    
</body>
</html>
