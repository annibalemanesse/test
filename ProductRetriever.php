<?php

class ProductRetriever
{
    public function getFifteenProductsFromAPI($url)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        $curl_data = curl_exec($curl_handle);
        if(!$curl_data) {
            echo curl_error($curl_handle);
        }
        curl_close($curl_handle);
        $response_data = json_decode($curl_data);
        return array_slice($response_data, 0, 15);
    }
}