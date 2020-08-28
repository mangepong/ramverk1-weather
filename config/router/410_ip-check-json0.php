<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip Validatorn with json.",
            "mount" => "ipjson",
            "handler" => "\Anax\Controller\IpJsonController",
        ],
    ]
];
