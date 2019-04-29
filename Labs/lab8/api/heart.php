<?php

    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("favorites");
    
    $sql = "INSERT INTO `like`(`link`) VALUES ('" . $_GET["url"] . "')";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($record);
?>