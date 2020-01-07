<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Check",
            "mount" => "weatherjson",
            "handler" => "\Anax\Controller\WeatherCheckJsonController",
        ],
    ]
];
