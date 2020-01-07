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
class WeatherCheckController implements ContainerInjectableInterface
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
        $this->IpCurl = new IpCurl();
        $this->WeatherCurl = new WeatherCurl();
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
        $title = "Weather Check";

        $page = $this->di->get("page");

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            if (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            } else {
                $ip = "8.8.8.8";
            }
        }

        $page->add("anax/weather/index", [
            "ip" => $ip,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    public function indexActionPost()
    {
        $response = $this->di->get("response");
        $request = $this->di->get("request");
        $session = $this->di->get("session");
        $ip = $request->getPost("ip");

        $ipres = $this->IpCurl->curl($ip);
        $lat = $ipres["latitude"];
        $long = $ipres["longitude"];
        $weatherres = $this->WeatherCurl->curl($lat, $long);

        if (isset($weatherres[0]["daily"])) {
            $res = $weatherres;
        } else {
            $jsonres = [
                "Message" => "No data found for this location!",
            ];
            return [$jsonres];
        }



        $title = "Weather Check";

        $page = $this->di->get("page");

        $page->add("anax/weather/result", [
            "res" => $res,
            "lat" => $lat,
            "long" => $long,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
