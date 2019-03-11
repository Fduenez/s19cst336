<?php
$discount = array();

$discount["getFifty"] = 0.50;
$discount["halfPrice"] = 0.50;

$discount["sand30"] = 0.30;
$dicount["spring30"] = 0.30;

$discount ["beach"] = 0.20;
$discount ["sunny"] = 0.20;

echo json_encode($discount[rand(0,5)]);