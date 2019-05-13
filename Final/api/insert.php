<?php
    session_start();
    
    include "../dbConnection.php";
    $conn = getDatabaseConnection('Scheduler');
   
   
      
    $sql = "INSERT INTO `reserve`(`username`, `date`, `start_time`, `duration`, `bookedBy`) VALUES ('". $_POST['username'] 
    . "', '" . $_POST['date'] 
    . "', '" . $_POST['start_time'] 
    . "', '" . $_POST['duration'] 
    . "', '" . $_POST['bookedBy'] . "')";
    echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    



?>