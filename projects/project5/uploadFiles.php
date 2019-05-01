<?php 
    if ($_FILES["fileName"]["error"] > 0) {
    echo "Error: " . $_FILES["fileName"]["error"] . "<br>";
    } else {
    echo "Upload: " . $_FILES["fileName"]["name"] . "<br>";
    echo "Type: " . $_FILES["fileName"]["type"] . "<br>";
    echo "Size: " . ($_FILES["fileName"]["size"] / 1024) . " KB<br>";
    echo "Stored in: " . $_FILES["fileName"]["tmp_name"];
    
    include 'dbConnection.php';
    
    $Conn = getDatabaseConnection("event_picture_dump");
    $file = addslashes(file_get_contents($_FILES["fileName"]["tmp_name"]));
    $date = "SELECT NOW()";
    $sql = "INSERT INTO `upload`(`email_address`, `caption`, `media`, `timestamp`) VALUES ('" . $_POST['email'] . "', '" . $_POST['textbox'] . "', '" . $file .  "', '" . $date . "')";
    $stm= $Conn->prepare($sql);
    $stm->execute();
    echo "<br />File saved into database <br /><br />";
    
    
    }

?>

