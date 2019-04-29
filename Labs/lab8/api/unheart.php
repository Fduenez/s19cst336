<?php

    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("favorites");
    
    $sql = "DELETE FROM `like` WHERE `link`='" . $_GET["url"] . "'";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($record);
?>