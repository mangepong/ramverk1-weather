<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpGeoValidatorController.
 */
class WeatherCheckTest extends TestCase
{


    protected function setUp()
    {
        global $di;
        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
        // $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->controller = new WeatherCheckController();
        $this->controller->setDI($this->di);
        $session = $di->get("session");
    }
    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $this->controller->initialize();
        $res = $this->controller->indexAction();
        $this->assertIsObject($res);
    }

    public function testIndexActionPostTrue()
    {
        $this->controller->initialize();
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip", "8.8.8.8");
        $res = $this->controller->indexActionPost();
        $this->assertIsObject($res);
    }

    // public function testIndexActionPostFalse()
    // {
    //     $this->controller->initialize();
    //     $request = $this->di->get("request");
    //     $response = $this->di->get("response");
    //     $this->di->set("response", "\Anax\Response\Response");
    //     $request->setPost("ip", "8.8.8.8.1");
    //     $res = $this->controller->indexActionPost();
    //     $this->assertIsObject($res);
    // }
}
