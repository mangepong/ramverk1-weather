<?php


namespace Anax\Controller;

class IpCurl
{

    /**

     * Curls the ip address to an api

     */

    public function curl($ip)
    {


        $access_key = "5f23ea8bea3969482c26bb6b2d8249bf";

        $url = 'http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'';


        // Initialize CURL request:
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        // Store the data in a var:
        $json = curl_exec($ch);
        curl_close($ch);


        // Decode the JSON response:
        $api_result = json_decode($json, true);
        return $api_result;
    }
}
