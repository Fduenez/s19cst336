<?php
    session_start();
    
    include "../dbConnection.php";
    $conn = getDatabaseConnection('Scheduler');
   
   
      
    $sql = "DELETE FROM `reserve` WHERE `id` = " . $_POST['id'];
    echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    



?>