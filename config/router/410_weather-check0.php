<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Check",
            "mount" => "weather",
            "handler" => "\Anax\Controller\WeatherCheckController",
        ],
    ]
];
