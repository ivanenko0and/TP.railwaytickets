
<?php


class Main {
    
    public static $type;
    
    public static function setAccountType(){
        
        require "dataBaseModule.php";
        
        self::$type = "";
        
        $results = $db->query('SELECT AccountType FROM Users WHERE Email="'.$_POST["login"] .'"');
        while ($row = $results->fetchArray()) {
            self::$type = $row[0];
        }
        
    }
    
    
    public static function orderListButton(){
    
        if(self::$type == "cashier"){

            echo '

            <br>
            <br>
            <form action="orderlist.php" method="post">

            <input type="submit" value="Список замовлень" id="order_list_button">
            <input type="hidden" name="login" value="'. $_POST["login"].'">

            </form>';
        }
    }
    
    
    public static function addRoute(){
    
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $trainNumber = $_POST["trainNumber"];
            $startStation = $_POST["startStation"];
            $endStation = $_POST["endStation"];
            $intermediateStations = $_POST["intermediateStations"];
            $startDate = $_POST["startDate"];
            $endDate = $_POST["endDate"];
            $cost = $_POST["cost"];
            $remainingTickets = $_POST["remainingTickets"];


            if(!empty($trainNumber)){
                
                require "dataBaseModule.php";
                
                $db->query('INSERT INTO Routes(TrainNumber, StartStation, EndStation, IntermediateStations, StartDate, EndDate, Cost, RemainingTickets) VALUES ("'. $trainNumber. '","'. $startStation. '","'. $endStation. '","'. $intermediateStations. '", "'. $startDate. '", "'. $endDate. '", "'. $cost. '", "'. $remainingTickets. '" );');


                $_POST["trainNumber"] = "";
                $_POST["startStation"] = "";
                $_POST["endStation"] = "";
                $_POST["intermediateStations"] = "";
                $_POST["startDate"] = "";
                $_POST["endDate"] = "";
                $_POST["cost"] = "";
                $_POST["remainingTickets"] = "";

                echo '

                <script>
                document.mainForm.submit();
                </script>

                ';


            }


        } 

    }
    
    
    
    
    
    public static function addRouteButton(){
    
        if(self::$type == "admin"){

            $trainNumber = "";
            $startStation = "";
            $endStation = "";
            $intermediateStations = "";
            $startDate = "";
            $endDate = "";
            $cost = "";
            $remainingTickets = "";


            echo '


            <form action="'. htmlentities($_SERVER["PHP_SELF"]).'" name="addForm" method="post">


            <td><input type="text" placeholder="Номер потяга" name="trainNumber" value="'. $trainNumber.'" class="add_text" required></td>

            <td><input type="text" placeholder="Початкова станція" name="startStation" value="'. $startStation.'" class="add_text" required></td>

            <td><input type="text" placeholder="Кінцева станція" name="endStation" value="'. $endStation.'" class="add_text" required></td>

            <td><input type="text" placeholder="Проміжні станції" name="intermediateStations" value="'. $intermediateStations.'" class="add_text"></td>

            <td><input type="text" placeholder="Час відбуття" name="startDate" value="'. $startDate.'" class="add_text" required></td>

            <td><input type="text" placeholder="Час прибуття" name="endDate" value="'. $endDate.'" class="add_text" required></td>

            <td><input type="text" placeholder="Ціна" name="cost" value="'. $cost.'" class="add_text" required></td>

            <td><input type="text" placeholder="Кількість квитків" name="remainingTickets" value="'. $remainingTickets.'" class="add_text" required></td>


            <input type="hidden" name="login" value="'. $_POST["login"].'">

            <td>
            <input type="submit" value="Додати" id="add_button">
            </td>
            </form>


            ';
            }

    }
    
    
    
    
    public static function delRoute(){
    
        if(!empty($_POST["del_route"])){
            
            require "dataBaseModule.php";

            $db->query('DELETE FROM Routes WHERE Id="'. $_POST["del_route"].'"');

        }

    }
    
    
    
    
    public static function displayRoute($row){
                
        if(empty($_POST["login"])){

            echo '<tr><td align="center"> ', $row[1], ' </td><td> ', $row[2], ' </td><td> ', $row[3], ' </td><td> ', $row[4], ' </td><td> ', $row[5], ' </td><td> ', $row[6], ' </td><td> ', $row[7], ' </td><td> ', $row[8], ' </td></tr>';

        }else{

            require "dataBaseModule.php";
            
            $results = $db->query('SELECT AccountType FROM Users WHERE Email="'.$_POST["login"] .'"');
            while ($r = $results->fetchArray()) {
                $type = $r[0];
            }

            if(self::$type == "admin"){



                echo '<tr><td>

                <form name="orderingPost" action="ordering.php" method="post">
                <input type="hidden" name="login" value="'. $_POST["login"]. '">
                <input type="hidden" name="route" value="'. $row[0]. '">
                <input type="submit" value="'. $row[1].'" class="id_button">
                </form>

                </td><td> ', $row[2], ' </td><td> ', $row[3], ' </td><td> ', $row[4], ' </td><td> ', $row[5], ' </td><td> ', $row[6], ' </td><td> ', $row[7], ' </td><td> ', $row[8], ' </td><td>



                <form name="delPost" action="index.php" method="post">
                <input type="hidden" name="login" value="'. $_POST["login"]. '">
                <input type="hidden" name="del_route" value="'. $row[0]. '">
                <input type="submit" value="Видалити" class="del_button">
                </form>


                </td></tr>';



            }else{

                echo '<tr><td>

                <form name="orderingPost" action="ordering.php" method="post">
                <input type="hidden" name="login" value="'. $_POST["login"]. '">
                <input type="hidden" name="route" value="'. $row[0]. '">
                <input type="submit" value="'. $row[1].'" class="id_button">
                </form>

                </td><td> ', $row[2], ' </td><td> ', $row[3], ' </td><td> ', $row[4], ' </td><td> ', $row[5], ' </td><td> ', $row[6], ' </td><td> ', $row[7], ' </td><td> ', $row[8], ' </td></tr>';

            }




        }


    }
    
    
    
    
    public static function routeList(){
        
        require "dataBaseModule.php";

        if(!empty($_POST["num"])){

            $routes = $db->query('SELECT * FROM Routes WHERE TrainNumber="'. $_POST["num"].'"');

            while ($row = $routes->fetchArray()) {
                self::displayRoute($row);
            }



        }else{

            $routes = $db->query('SELECT * FROM Routes');

            if(empty($_POST["start"]) && empty($_POST["end"])){

                while ($row = $routes->fetchArray()) {
                    self::displayRoute($row);
                }

            }else{

                if(!empty($_POST["start"]) && !empty($_POST["end"])){



                    while ($row = $routes->fetchArray()) {


                        if(		( $row[2]==$_POST["start"] || !empty(strpos($row[4], $_POST["start"])) ) && ( $row[3]==$_POST["end"] || !empty(strpos($row[4], $_POST["end"])) )	){

                            self::displayRoute($row);

                            }

                    }

                }else{

                    if(!empty($_POST["start"])){

                        while ($row = $routes->fetchArray()) {


                            if(	$row[2]==$_POST["start"] || !empty(strpos($row[4], $_POST["start"]))	){

                                self::displayRoute($row);

                            }

                        }

                    }


                    if(!empty($_POST["end"])){

                        while ($row = $routes->fetchArray()) {



                            if(		$row[3]==$_POST["end"] || !empty(strpos($row[4], $_POST["end"]))	){

                                self::displayRoute($row);

                            }

                        }

                    }              

                }


            }

        }


    }
    

}


?>