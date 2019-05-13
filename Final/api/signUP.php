<?php
    include '../dbConnection.php';
    session_start();
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
    $conn = getDatabaseConnection("Scheduler");

    $rawJsonString = file_get_contents("php://input");
    $jsonData = json_decode($rawJsonString, true);
  
    $options = [ 'cost' => 11 ];
    try
    {
      $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
      $sql = "INSERT INTO `user`(`username`, `password`) VALUES (:username, :password)";
      
      $stmt = $conn->prepare($sql);
      $stmt->execute(array (
        ":username" => $_POST['username'],
        ":password" => $hashedPassword
        ));
      
      $_SESSION["username"] = $_POST['username'];
      $_SESSION["isAdmin"] = false;
          
      echo json_encode(array("isSignedUp" => true)); 
    }
    catch (PDOException $ex) {
        switch ($ex->getCode()) {
          case "23000":
            echo json_encode(array(
              "isSignedUp" => false, 
              "message"=> "email taken, try another",
              "details" => $ex->getMessage()));
            break;
          default:
            echo json_encode(array(
              "isSignedUp" => false, 
              "message"=> $ex->getMessage(),
              "details" => $ex->getMessage()));
            break;
        }
        exit;
      }
?>