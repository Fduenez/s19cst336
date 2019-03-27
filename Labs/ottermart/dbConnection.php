<?php
function getDataBaseConnection($dbname = "ottermart")
{
    $host = "localhost"; //cloud 9
    $username = "root";
    $password = "";
    
    $dbConn = new PDO("mysql:hosr=$host;dbname=$dbname", $username, $password);
    
    //display errors when accessing tables
    
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbConn;
}
?>