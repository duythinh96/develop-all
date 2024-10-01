<?php
class WeatherApi {

    protected $host;
    protected $api_token;
    
    /**
     * @param $city
     */
    public static function forecast($city) 
    {
        self::init();
        # Secret
        $url = "https://" . self::$host . "/{$city}/EN";
        $host = self::$host;
        $api_key = self::$api_token;

        # Call Weather api
        try {
            return self::http($url, $host, $api_key);
        } catch (\Error $error) {
            return $error;
        }
    }

    /**
     * @param $url
     * @param $host
     * @param $api_key
     */
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

    /**
     * Set $host, $api_key
     */
    private static function init ()
    {
        // Load env file
        $file_path = '../../config/env.json';
        $json_data = file_get_contents($file_path);
        if ($json_data === false) {
            die('Error reading the JSON file.');
        }

        // Decode Json to Array
        $data = json_decode($json_data, true); 

        if (json_last_error() !== JSON_ERROR_NONE) {
            die('Error decoding JSON: ' . json_last_error_msg());
        }

        // Set attribute
        self::$host = $data["api"]["host"];
        self::$api_token = $data["api"]["api_token"];
    }
}
