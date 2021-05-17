
<?php

function signIn(){
    
    require "dataBaseModule.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $login = $_POST["login"];
        $pass = $_POST["pass"];

        $results = $db->query('SELECT * FROM Users WHERE Email="'. $login. '" AND Pass="'. $pass. '"');


        if(($results->fetchArray()) == null){


            $results = $db->query('SELECT * FROM Users WHERE Email="'. $login. '"');
            if(($results->fetchArray()) == null){
               return "loginError";
            }else{
               return "passError";
            }

        }else{

            $results = $db->query('SELECT * FROM Users WHERE Email="'. $login. '" AND Pass="'. $pass. '"');
            while ($row = $results->fetchArray()) {


                echo'
                <form name="authPost" id="authPost" action="index.php" method="post">
                <input type="hidden" name="login" value="'.$login .'">
                <script>
                    document.authPost.submit();
                </script>
               ';

            }

        }

    }
    
    
    
    
}



?>
