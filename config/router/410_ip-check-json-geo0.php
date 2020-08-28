<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip Validatorn with json and Geo.",
            "mount" => "ipjsongeo",
            "handler" => "\Anax\Controller\IpGeoJsonController",
        ],
    ]
];
