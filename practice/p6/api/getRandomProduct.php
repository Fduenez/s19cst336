<?php
$products = array();
$allProducts = array();

$products["product"] = "Microfiber Beach Towel";
$products["price"] = 40;
$products["qty"] = 2;

array_push($allProducts, $products);

$products["product"] = "Flip-flop Sandals";
$products["price"] = 30;
$products["qty"] = 5;

array_push($allProducts, $products);

$products["product"] = "Sunscreen 80SPF";
$products["price"] = 25;
$products["qty"] = 3;

array_push($allProducts, $products);

$products["product"] = "Plastic Flying Disc";
$products["price"] = 15;
$products["qty"] = 4;

array_push($allProducts, $products);

$products["product"] = "Beach Umbrella";
$products["price"] = 75;
$products["qty"] = 1;

array_push($allProducts, $products);

$allProducts["status"] = "success";

echo json_encode($allProducts[rand(0,4)]);
?>