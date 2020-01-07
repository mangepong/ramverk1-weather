<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpGeoJsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
        $this->IpCheck = new IpCheck();
        $this->IpCurl = new IpCurl();
    }

    public function indexActionGet() : array
    {
        $request = $this->di->get("request");

        $ip = $request->getGet("ip");

        if ($this->IpCheck->validateIp($ip)) {
            $api_result = $this->IpCurl->curl($ip);
            $type = $api_result['type'];
            $ort = $api_result['region_name'];
            $country = $api_result['country_name'];
            $domain = $this->IpCheck->validateDomain($ip);
            $json = [
                "valid" => "True",
                "ip" => $ip,
                "domain" => $domain,
                "type" => $type,
                "ort" => $ort,
                "country" => $country,
            ];
        } else {
            $json = [
                "valid" => "False",
                "ip" => $ip,
                "domain" => "Not found",
            ];
        }


        $title = "Ip Validator with Geo";



        return [$json];
    }
}
