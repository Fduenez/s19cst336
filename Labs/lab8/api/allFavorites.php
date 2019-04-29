<?php

    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("favorites");
    
    $sql = "SELECT * FROM `like` WHERE 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($record);
?>