<?php


namespace Anax\Controller;

class WeatherCurl
{

    private $key;

    public function setKey($key)
    {
        $this->key = $key;
    }


    /**

     * Curls the ip address to an api

     */

    public function curl($lat, $long)
    {
        // $access_key = "c5d9fa305d5b063807a2cd9ff701c080";
        $url =  "https://api.darksky.net/forecast";
        $time = "12:00:00";
        $date = date("Y-m-d");
        $key = "";
        $days = 7;

        $mh = curl_multi_init();
        $chAll = [];

        $newdate = date('Y-m-d', (strtotime('1 day', strtotime($date))));

        $options = [
                CURLOPT_RETURNTRANSFER => true,
        ];

        if ($this->key) {
            $key = $this->key;
        } else {
            $key = "c5d9fa305d5b063807a2cd9ff701c080";
        }
        while ($days > 0) {
            $ch = curl_init("$url/$key/$lat,$long,{$date}T$time?units=si");
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($mh, $ch);
            $chAll[] = $ch;
            $date = date('Y-m-d', (strtotime('1 day', strtotime($date))));
            $days = $days - 1;
        }

        $go = null;

        do {
            curl_multi_exec($mh, $go);
        } while ($go);

        foreach ($chAll as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);

        $res = [];

        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);

            $res[] = json_decode($data, true);
        }
        return $res;
    }
}
