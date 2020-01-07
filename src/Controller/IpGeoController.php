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
class IpGeoController implements ContainerInjectableInterface
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



    /**
    * This is the index method action, it handles:
    * ANY METHOD mountpoint
    * ANY METHOD mountpoint/
    * ANY METHOD mountpoint/index
    *
    * @return string
    */
    public function indexAction() : object
    {
        $title = "Ip Validator";

        $page = $this->di->get("page");

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            if (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            } else {
                $ip = "8.8.8.8";
            }
        }

        $page->add("anax/ipvalidatorgeo/index", [
            "ip" => $ip,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
    * Update current selected style.
    *
    * @return object
    */
    public function indexActionPost() : object
    {
        $type = "null";
        $ort = "null";
        $country = "null";
        $domain = "Not found";
        $request = $this->di->get("request");

        $ip = $request->getPost("ip");

        if ($this->IpCheck->validateIp($ip)) {
            $api_result = $this->IpCurl->curl($ip);
            $type = $api_result['type'];
            $ort = $api_result['region_name'];
            $country = $api_result['country_name'];
            $domain = $this->IpCheck->validateDomain($ip);
            $res = "`$ip` is a valid IP Adress. Domainname: $domain";
        } else {
            $res = "`$ip` is not a valid IP Adress. Domainname: Not found";
        }

        $title = "Ip Validator";

        $page = $this->di->get("page");

        $page->add("anax/ipvalidatorgeo/result", [
            "res" => $res,
            "type" => $type,
            "ort" => $ort,
            "country" => $country,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
