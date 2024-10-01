<?php
require_once "src/weather_api.php";

$weatherAPI = new WeatherApi();
$responseWeather = $weatherAPI::forecast("Ho Chi Minh");
try {
    $json = json_decode($responseWeather);
    $data = json_encode($json, JSON_PRETTY_PRINT);
    echo "OK";
    echo "<pre>{$data}</pre>";
} catch (\Error $err) {
    echo "Error\n\n";
    echo $err->getMessage() + "\n\n";
    var_dump($responseWeather);
}