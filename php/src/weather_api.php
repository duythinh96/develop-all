<?php
class WeatherApi {
    
    public static function forecast($city) 
    {
        # Secret
        $url = "https://open-weather13.p.rapidapi.com/city/{$city}/EN";
        $host = "open-weather13.p.rapidapi.com";
        $api_key = "073922d575msh362e38820e8e6e2p129d8fjsn3537b7039650";

        # Call Weather api
        try {
            return self::http($url, $host, $api_key);
        } catch (\Error $error) {
            return $error;
        }
    }

    private static function http($url, $host, $api_key) 
    {
        # Init variable
        $response = null;
        $error = null;

        # Start CURL
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: {$host}",
                "x-rapidapi-key: {$api_key}"
            ],
        ]);
        $response = curl_exec($curl);

        # Capture error
        if (curl_errno($curl)) {
            $error = curl_error($curl);
        }

        # End CURL
        curl_close($curl);

        # Throw if error
        if($error) {
            throw new \Error($error);
        }
        return $response;
    }
}
