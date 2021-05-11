<?php

function register(){
    
    require "dataBaseModule.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
            
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];

        $results = $db->query('SELECT * FROM Users WHERE Email="'. $email. '" AND Pass="'. $pass. '"');

        $isExist = "";

        while ($row = $results->fetchArray()) {
            $isExist .= $row[0];
        }

        if(empty($isExist)){

            $db->query('INSERT INTO Users(Name, Surname, Email, Pass, AccountType) VALUES ("'. $name. '", "'. $surname. '", "'. $email. '", "'. $pass. '", "client" );');



            echo'
            <form name="authPost" id="authPost" action="index.php" method="post">
            <input type="hidden" name="login" value="'.$email .'">
            <script>
                document.authPost.submit();
            </script>
            ';
        }

    }    
    
    
    
}





?>