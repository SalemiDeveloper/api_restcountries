<?php

$apiKey = getenv('RESTCOUNTRIES_API_KEY');

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://api.restcountries.com/countries/v5?q=canada&pretty=1',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $apiKey,
        'Accept: application/json',
    ],
]);

$response = curl_exec($curl);

if ($response === false) {
    die('cURL Error: ' . curl_error($curl));
}

curl_close($curl);

echo $response;