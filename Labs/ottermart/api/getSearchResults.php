<?php
include '../dbConnection.php';
$conn = getDataBaseConnection("ottermart");
$namedParameters = array();
$sql = "SELECT * FROM om_product WHERE 1";
//checks wehter the person has typed something in the product box
if(!empty($_GET['product']))
{
    $sql .= " AND productName LIKE :productName";
    $namedParameters[":productName"] = "%" . $_GET['product']. "%";
}
//checks wether the user has selected a category of a product
if(!empty($_GET['category']))
{
    $sql .= " AND catId = :categoryId";
    $namedParameters[":categoryId"] = $_GET['category'];
}

//checks wheater user has typed anything in the price text boxes
if(!empty($_GET['priceFrom']))
{
    $sql .= "AND price >= :priceFrom";
    $namedParameters[":priceFrom"] = $_GET['priceFrom'];
    
}
if(!empty($_GET['priceTo']))
{
    $sql .= "AND price <= :priceTo";
    $namedParameters[":priceTo"] = $_GET['priceTo'];
    
}
if(isset($_GET['orderBy']))
{
    if($_GET['orderBy'] == "price")
    {
        $sql .= " ORDER BY price";
    }
    elseif($_GET['orderBy'] == 'name')
    {
        $sql .= "ORDER BY productName";
    }
}

$stmt = $conn->prepare($sql);
$stmt ->execute($namedParameters);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($records);


?>