<?php
function consume_joke($url = null)
{
    if (!$url)                          { return false; }
    $ch                                 = curl_init(); // Curl Handle

    //SET SOME CURL OPTIONS - Jokes are only GET , but typically we'd handle all types of rest consumption here - GET, PUT, POST, DELETE, PATCH

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
    $response                           = curl_exec($ch);
    curl_close($ch);
    return json_decode($response,true);
}