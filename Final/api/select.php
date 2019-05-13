<?php
    session_start();
    
    include "../dbConnection.php";
    $conn = getDatabaseConnection('Scheduler');
   
   
      
    $sql = "SELECT * FROM `reserve` WHERE 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->FetchALL(PDO::FETCH_ASSOC);
    
    echo json_encode($records)
    



?>