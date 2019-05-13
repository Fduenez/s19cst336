<?php

 include 'dbConnection.php';

 $sql = "SELECT * FROM upload WHERE 1";
 $stmt = $dbConn->prepare($sql);
 $stmt->execute();

 $stmt->bindColumn('media', $data, PDO::PARAM_LOB);
 $record = $stmt->fetch(PDO::FETCH_BOUND);

 if (!empty($record)){
    header('Content-Type:' . $record['fileType']);   //specifies the mime type
    header('Content-Disposition: inline;');
    echo $data;
  }
?>
