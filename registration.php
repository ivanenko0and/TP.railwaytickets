<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Залізничні квитки</title>
    <link rel="stylesheet" href="css\\style.css">
    <?php
    require "modules\\registrationModule.php";
    ?>
</head>
<body>
    
    <div class="wrapper">
    
    <header>
        <form name="mainForm" id="mainForm" action="index.php" method="post">
        <input id="title" type="submit" value="railwaytickets.ua">
        </form>
    </header>
    
    
    <div class="container">
        
        <?php
        
        $name = "";
        $surname = "";
        $email = "";
        $pass = "";
        
        register();
        
        ?>
        
        <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" name="registerForm" method="post">
           
            <p align=center>Реєстрація</p>
            <input type="text" class="input_text2" placeholder="Ім'я" name="name" value="<?php echo $name;?>" required>
            
            <input type="text" class="input_text2" placeholder="Прізвище" name="surname" value="<?php echo $surname;?>" required>
            
            <input type="text" class="input_text2" placeholder="Електронна пошта" name="email" value="<?php echo $email;?>" required>
            
            <input type="password" class="input_text2" placeholder="Пароль" name="pass" value="<?php echo $pass;?>" required>
            
            
            <input type="submit" class="input_text2" value="Зареєструватись">
            
        </form>
        
        
    </div>
    
    </div>
    
    
    
</body>
</html>
