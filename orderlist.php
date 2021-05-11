<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Залізничні квитки</title>
    <link rel="stylesheet" href="css\\style.css">
    <?php
    require "modules\\signInAndLogOutButtons.php";
    require "modules\\orderListModel.php";
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
    
    <main>     
        
        
        <form action="index.php" method="post">
        <input type="submit" value="Назад" id="return_button">
        <input type="hidden" name="login" value="<?php echo $_POST["login"];?>">
        </form>
        
        
        <table class="order_table">
            
            <tr>
            <th>Замовник</th>
            <th>Маршрут</th>
            <th>Кількість квитків</th>
            <th>Тип оплати</th>
            <th>Час замовлення</th>
            <th>Вартість</th>
            </tr>
            
            <?php orderList(); ?>
            
        </table>
        
    </main>
    
    </div>
    
    
    
    
</body>
</html>