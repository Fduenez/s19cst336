<?php 
include '../dbConnection.php';

$conn = getDatabaseConnection("cinder");
$sql = "SELECT * From `match` INNER JOIN user WHERE 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($records);
?>