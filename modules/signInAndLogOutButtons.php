<?php

function signInAndLogOutButtons(){
    
    require "dataBaseModule.php";
    
    if ($_POST["login"] == NULL){
        echo '

        <form action="authorization.php" class="authorization"><input class="login_button" type="submit" value="Вхід"></form>

        <form action="registration.php" class="registration">
        <input class="login_button" type="submit" value="Реєстрація"></form>
        ';

    }else{
        
        $name = ""; 

        
        $results = $db->query('SELECT * FROM Users WHERE Email="'.$_POST["login"] .'"');
        while ($row = $results->fetchArray()) {
            $name = $row[1]. " ". $row[2];
        }



        echo '<p class="label1" align="right">'. $name .'</p>';
        echo '<p class="label2" align="right">'. $_POST["login"] .'</p>';

        echo '
        <form action="index.php" class="exit"><input class="login_button" type="submit" value="Вихід"></form>
        ';


    }
    
    
}


        
?>