<?php

class Ordering{

    public static $currentStage = '1';
    
    public static function setCurrentStage(){
        
        if(!preg_match("/[^0-9\.\-]+/", $_POST["ticketsNumber"])){
            
            if($_POST["paymentType"] == "gpay"){
                self::$currentStage = '2a';
            }else{
                if($_POST["paymentType"] == "card"){
                    self::$currentStage = '2b';
                }

            }
            
            
            if(!preg_match("/[^0-9\.\-]+/", $_POST["card_num"]) && !preg_match("/[^0-9\.\-]+/", $_POST["pin_code"])){
                
                if($_POST["order"] == "true"){
                    self::$currentStage = '3a';
                }
                                 
            }
            
            if($_POST["download"] == "true"){
                self::$currentStage = '3b';
            }
            
            
        }
        
    }
    
    
    public static function returnButton(){
        
        if(self::$currentStage == '1' || self::$currentStage == '3a' || self::$currentStage == '3b'){
            
            echo '
            
            <form action="index.php" method="post">
            <input type="submit" value="Назад" id="return_button">
            <input type="hidden" name="login" value="'. $_POST["login"].'">
            </form>
            
            ';
            
        }else{
            
            if(self::$currentStage == '2a' || self::$currentStage == '2b'){
                
                echo '
                
                <form action="ordering.php" method="post">
                <input type="submit" value="Назад" id="return_button">
                <input type="hidden" name="login" value="'. $_POST["login"].'">
                <input type="hidden" name="route" value="'. $_POST["route"]. '">
                </form>
                
                ';
                
            }   
            
        }
        
    }
    
    public static function firstStage(){
        
        if(self::$currentStage == '1'){
                
             
            if(preg_match("/[^0-9\.\-]+/", $_POST["ticketsNumber"])){

                $ticketsNumberError = "Введіть правильні дані!";
            }

            echo '

            <form action="'. htmlentities($_SERVER["PHP_SELF"]).'" name="registerForm" method="post">



            <p>Кількість квитків:</p>
            <input type="text" id="input_text2" name="ticketsNumber" value="'. $ticketsNumber.'" required>

            <p class="error_text">'. $ticketsNumberError.' </p>


            <p>Спосіб оплати:</p>

            <p> <input type="radio" name="paymentType" value="card"  required>VISA/Mastercard
            <input type="radio" name="paymentType" value="gpay"  required>GooglePay </p>


            <input type="hidden" name="login" value="'.$_POST["login"].'">
            <input type="hidden" name="route" value="'.$_POST["route"].'">


            <input type="submit" id="order_button" value="Далі">


            </form>
            ';


        }
        
        
    }
    
    
    public static function secondStage(){
        
        if(self::$currentStage == '2a' || self::$currentStage == '2b'){
            
            echo '
            
            <form action="ordering.php" method="post">
            
            ';
            
            
            if(self::$currentStage == '2a'){

                
                echo'

                <p>Пароль:</p>
                <input type="password" id="input_text2" required>

                ';
                
                

            }else{
                if(self::$currentStage == '2b'){

                    if(preg_match("/[^0-9\.\-]+/", $_POST["card_num"])){
                        $cardNumError = "Введіть правильні дані!";
                    }
                    if(preg_match("/[^0-9\.\-]+/", $_POST["pin_code"])){
                        $pinCodeError = "Введіть правильні дані!";
                    }  


                    echo'

                    <p>Номер картки:</p>
                    <input type="text" id="input_text2" name="card_num" required>
                    <p class="error_text">'. $cardNumError.' </p>


                    <p>Пін код:</p>
                    <input type="password" id="input_text2" name="pin_code" required>
                    <p class="error_text">'. $pinCodeError.' </p>

                    ';
                    

                }
            }
            
            
            
            echo '
            
            
            <input type="hidden" name="login" value="'.$_POST["login"].'">
            <input type="hidden" name="route" value="'. $_POST["route"].'">
            <input type="hidden" name="ticketsNumber" value="'. $_POST["ticketsNumber"].'">
            <input type="hidden" name="paymentType" value="'. $_POST["paymentType"].'">
            
            <input type="hidden" name="order" value="true">
            
            <input id="order_button" type="submit" value="Замовити">
            </form>
            
            ';
             
        }  
        
    }
    
    
    public static function thirdStage(){
        
        require "dataBaseModule.php";
        
        if(self::$currentStage == '3a' || self::$currentStage == '3b'){
            
            echo '
            
            <div align="center" id="complete_text">Замовлення оформлено!</div>
            
            <form action="ordering.php" method="post">
            <input type="hidden" name="login" value="'.$_POST["login"].'">
            <input type="hidden" name="route" value="'. $_POST["route"].'">
            <input type="hidden" name="ticketsNumber" value="'. $_POST["ticketsNumber"].'">
            <input type="hidden" name="paymentType" value="'. $_POST["paymentType"].'">
            
            <input type="hidden" name="download" value="true">
            
            <input id="order_button" type="submit" value="Завантажити копію квитка">
            </form>
            
            ';
             
            
            if(self::$currentStage == '3a'){
                
                $results = $db->query('SELECT Id FROM Users WHERE Email="'. $_POST["login"]. '"');
                while ($row = $results->fetchArray()) {
                    $id = $row[0];
                }
                $results = $db->query('SELECT Cost FROM Routes WHERE Id="'. $_POST["route"]. '"');
                while ($row = $results->fetchArray()) {
                    $cost = $row[0];
                }

                $db->query('INSERT INTO Orders(UserId, RouteId, TicketsNumber, PaymentType, OrderTime, Price) VALUES ("'. $id. '","'. $_POST["route"]. '","'. $_POST["ticketsNumber"]. '","'. $_POST["paymentType"]. '", "'. date('Y-m-d H:m:s') . '", "'. $_POST["ticketsNumber"]*$cost. '" );');
                


                $results = $db->query('SELECT Id FROM Orders');
                while ($row = $results->fetchArray()) {
                    $num = $row[0];
                }
                $results = $db->query('SELECT * FROM Routes WHERE Id="'. $_POST["route"]. '"');
                while ($row = $results->fetchArray()) {
                    $trainNumber = $row[1];
                    $startStation = $row[2];
                    $endStation = $row[3];  
                    $startDate = $row[5];
                    $endDate = $row[6];

                }

                $new_ticket = fopen("tickets\\ticket№". $num.".txt", "w");

                $text = 'Бланк замовлення

Код: '.$num.'

Відправлення:				
'. $startStation.'
'. $startDate.'
        
Прибуття:
'. $endStation.'
'. $endDate.'

Потяг:
'. $trainNumber.'


Кількість місць:
'. $_POST["ticketsNumber"].'

Ціна:
'. $cost.'

Загальна вартість замовлення:
'. $_POST["ticketsNumber"]*$cost;
        
        
                fwrite($new_ticket, $text);

                fclose($new_ticket);

            }

            if(self::$currentStage == '3b'){

                $results = $db->query('SELECT Id FROM Orders');
                while ($row = $results->fetchArray()) {
                    $num = $row[0];
                }


                $url='tickets\\ticket№'. $num.'.txt';
                $local='D:\\Download\\ticket№'. $num.'.txt';
                file_put_contents($local, file_get_contents($url));

            }
        }
        
        
    }
    
    
    
    

}

?>
