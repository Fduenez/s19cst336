<?php 
include '../dbConnection.php';

$conn = getDatabaseConnection("poll");
$sql = "SELECT 
$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($records);
?>