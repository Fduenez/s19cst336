<?php
    session_start();
    
    include "../dbConnection.php";
    $conn = getDatabaseConnection('Scheduler');
   
   
      
    $sql = "SELECT `password` FROM `user` WHERE `username` = '" . $_POST['username'] . "'";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($records != false)
    {
        if(password_verify($_POST['password'], $records['password']))
        {
            $_SESSION["username"] = $_POST["username"];
            echo json_encode($_POST["username"]);
        }
        else
        {
            echo json_encode("password did not match");
        }
        
    }
    else{
        echo json_encode("username is not found");
    }
    



?>