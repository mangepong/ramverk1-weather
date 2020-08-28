<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip Validatorn with Geo.",
            "mount" => "ipvalidatorgeo",
            "handler" => "\Anax\Controller\IpGeoController",
        ],
    ]
];
