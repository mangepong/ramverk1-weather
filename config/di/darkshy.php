<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "darksky" => [
            "shared" => true,
            "callback" => function () {
                $darksky = new \Anax\Controller\WeatherCurl();
                $cfg = $this->get("configuration");
                $config = $cfg->load("api_keys.php");
                $darksky->setKey($config['config']['key']);

                return $darksky;
            }
        ],
    ],
];
