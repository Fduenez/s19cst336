

<?php
//set up the API key for my test account
$apiKey = $_GET['key'];
$query = $_GET['query'];
//step1
$cSession = curl_init();

//step2
curl_setopt($cSession,CURLOPT_URL,"https://pixabay.com/api/?key=$apiKey&q=$query&image_type=photo");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);

// curl_setopt($cSession,CURLOPT_HTTPHEADER, array(
//     "Accept: application/json",
//     "Content-Type: application/json",
//     "Authorization: Bearer $apiKey"
    
//     ));

//step3
$results = curl_exec($cSession);

// Check for specific non-zero error numbers
$errno = curl_errno($cSession);
if ($errno) {
    switch ($errno) {
        default:
            echo "Error #$errno...execution halted";
            break;
    }

    // Close the session and exit
    curl_close($cSession);
    exit();
}

// Close the session
curl_close($cSession);

$picData = json_decode($results);

echo json_encode($picData->hits);






?>