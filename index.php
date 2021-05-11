<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Залізничні квитки</title>
    <link rel="stylesheet" href="css\\style.css">
    <?php
    require "modules\\signInAndLogOutButtons.php";
    require "modules\\mainModule.php";
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
        
        
        <table>
            
            
            
            
            <h>Пошук:     </h>
            
            <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" method="post">
            
            
            <input type="text" placeholder="Номер потяга" name="num" class="textbox" size="10">

            <input type="text" placeholder="Початкова станція" name="start" class="textbox" size="20">
            
            <input type="text" placeholder="Кінцева станція" name="end" class="textbox" size="20">
            
            
            <input type="hidden" name="login" value="<?php echo $_POST["login"];?>">
                
            
            
            <input type="submit" value="Знайти" id="find_button">

            </form>
            
            <?php 
            
            Main::setAccountType();
            Main::orderListButton();
            Main::addRoute();
            
            ?>
            
            
            <tr>
            <th>Номер потяга</th>
            <th>Початкова станція</th>
            <th>Кінцева станція</th>
            <th>Проміжні станції</th>
            <th>Час відбуття</th>
            <th>Час прибуття</th>
            <th>Ціна</th>
            <th>Кількість квитків</th>
            <?php
                if(Main::$type == "admin"){
                    echo '<td></td>';
                }
            ?>
            </tr>
            
            
            <?php
            
            Main::addRouteButton(); 
            Main::delRoute();
            Main::routeList();
            
            ?>
            

            
        </table>
        
        
    </main>
    
    </div>
    
    
    
    
</body>
</html>