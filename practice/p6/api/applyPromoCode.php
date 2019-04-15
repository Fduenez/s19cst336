<?php
$halfCode = array();
$triCode = array();
$twoCode = array();
$allCodes = array();

$halfCode["code1"] = "getFifty";
$halfCode["code2"] = "halfPrice";
array_push($allCodes, $halfCode);

$triCode["code1"] = "sand30";
$triCode["code2"] = "spring30";
array_push($allCodes, $triCode);

$twoCode["code1"] = "beach";
$twoCode["code2"] = "sunny";
array_push($allCodes, $twoCode);

$promo_code = $_GET["promocode"];

$discount = 0;

if($halfCode["code1"] === $promo_code || $halfCode["code2"] === $promo_code)
{
    $discount = .5;
}
else if ($triCode["code1"] == $promo_code || $triCode["code2"] == $promo_code) {
    $discount = .3;
}
else if ($twoCode["code1"] == $promo_code || $twoCode["code2"] == $promo_code) {
    $discount = .2;
}

echo json_encode($discount);

?>