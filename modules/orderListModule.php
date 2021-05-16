<?php


function orderList(){
    
    require "dataBaseModule.php";
        
    $results = $db->query('SELECT * FROM Orders');
    while ($row = $results->fetchArray()) {


        $users = $db->query('SELECT * FROM Users WHERE Id="'. $row[1].'"');
        $routes = $db->query('SELECT * FROM Routes WHERE Id="'. $row[2].'"');

        $name = "";
        while ($users_row = $users->fetchArray()) {
           $name = $users_row[1]. " ". $users_row[2];
        }
        $route_name = "";
        while ($routes_row = $routes->fetchArray()) {
            $route_name = $routes_row[2]. "-". $routes_row[3];
        }


        echo '<tr><td> ', $name, ' </td><td> ', $route_name, ' </td><td> ', $row[3], ' </td><td> ', $row[4], ' </td><td> ', $row[5], ' </td><td> ', $row[6], ' </td></tr>';

    }

    
}



?>








