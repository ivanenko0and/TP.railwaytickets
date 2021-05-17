<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Залізничні квитки</title>
    <link rel="stylesheet" href="css\\style.css">
    <?php
    require "modules\\authorizationModule.php";
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
        
        $login = "";
        $pass = "";
        
        $error = signIn();
        
        ?>
        
        
        <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" name="auth_form" method="post">
           
            <p align=center>Вхід</p>
            <input type="text" class="input_text" placeholder="Логін" name="login" value="<?php echo $login;?>" required>
            
            <p class="error_text"><?php 
                if($error == "loginError")
                echo "Акаунту з таким логіном не існує";?></p>
            
            <input type="password" class="input_text" placeholder="Пароль" name="pass" value="<?php echo $pass;?>" required>
            
            <p class="error_text"><?php 
                if($error == "passError")
                echo "Введіть правильний пароль";?></p>
            
            
            <input type="submit" class="input_text" value="Увійти">
            
        </form>
            
        <form action="registration.php">
            <input type="submit" class="input_text" value="Реєстрація">
        </form>
              
        
    </div>
    
    </div>
    
    
    
</body>
</html>
