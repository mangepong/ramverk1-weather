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
class WeatherCheckJsonController implements ContainerInjectableInterface
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
    * Update current selected style.
    *
    * @return object
    */
    public function indexActionGet()
    {
        $request = $this->di->get("request");
        $ip = $request->getGet("ip");

        $ipres = $this->IpCurl->curl($ip);
        $lat = $ipres["latitude"];
        $long = $ipres["longitude"];
        $weatherres = $this->WeatherCurl->curl($lat, $long);

        if (isset($weatherres[0]["daily"])) {
            $day1 = [
                "valid" => "True",
                "summary" => $weatherres[0]["daily"]["data"][0]["summary"],
                "date" => gmdate("Y-m-d", $weatherres[0]["daily"]["data"][0]["time"]),
                "highest_temp" => $weatherres[0]["daily"]["data"][0]["temperatureMax"],
                "lowest_temp" => $weatherres[0]["daily"]["data"][0]["temperatureMin"],
            ];
            $day2 = [
                "valid" => "True",
                "summary" => $weatherres[1]["daily"]["data"][0]["summary"],
                "date" => gmdate("Y-m-d", $weatherres[1]["daily"]["data"][0]["time"]),
                "highest_temp" => $weatherres[1]["daily"]["data"][0]["temperatureMax"],
                "lowest_temp" => $weatherres[1]["daily"]["data"][0]["temperatureMin"],
            ];
            $day3 = [
                "valid" => "True",
                "summary" => $weatherres[2]["daily"]["data"][0]["summary"],
                "date" => gmdate("Y-m-d", $weatherres[2]["daily"]["data"][0]["time"]),
                "highest_temp" => $weatherres[2]["daily"]["data"][0]["temperatureMax"],
                "lowest_temp" => $weatherres[2]["daily"]["data"][0]["temperatureMin"],
            ];
            $day4 = [
                "valid" => "True",
                "summary" => $weatherres[3]["daily"]["data"][0]["summary"],
                "date" => gmdate("Y-m-d", $weatherres[3]["daily"]["data"][0]["time"]),
                "highest_temp" => $weatherres[3]["daily"]["data"][0]["temperatureMax"],
                "lowest_temp" => $weatherres[3]["daily"]["data"][0]["temperatureMin"],
            ];
            $day5 = [
                "valid" => "True",
                "summary" => $weatherres[4]["daily"]["data"][0]["summary"],
                "date" => gmdate("Y-m-d", $weatherres[4]["daily"]["data"][0]["time"]),
                "highest_temp" => $weatherres[4]["daily"]["data"][0]["temperatureMax"],
                "lowest_temp" => $weatherres[4]["daily"]["data"][0]["temperatureMin"],
            ];
            $day6 = [
                "valid" => "True",
                "summary" => $weatherres[5]["daily"]["data"][0]["summary"],
                "date" => gmdate("Y-m-d", $weatherres[5]["daily"]["data"][0]["time"]),
                "highest_temp" => $weatherres[5]["daily"]["data"][0]["temperatureMax"],
                "lowest_temp" => $weatherres[5]["daily"]["data"][0]["temperatureMin"],
            ];
            $day7 = [
                "valid" => "True",
                "summary" => $weatherres[6]["daily"]["data"][0]["summary"],
                "date" => gmdate("Y-m-d", $weatherres[6]["daily"]["data"][0]["time"]),
                "highest_temp" => $weatherres[6]["daily"]["data"][0]["temperatureMax"],
                "lowest_temp" => $weatherres[6]["daily"]["data"][0]["temperatureMin"],
            ];
            $res = [
                "1" => $day1,
                "2" => $day2,
                "3" => $day3,
                "4" => $day4,
                "5" => $day5,
                "6" => $day6,
                "7" => $day7,
            ];
        } else {
            $jsonres = [
                "Message" => "No data found for this location!",
            ];
            return [$jsonres];
        }

        return [$res];
    }
}
