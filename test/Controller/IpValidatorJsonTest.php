<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpValidatorJsonTest extends TestCase
{


    protected function setUp()
    {
        global $di;
        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->controller = new IpJsonController();
        $this->controller->setDI($this->di);
        $session = $di->get("session");
    }
    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $controller = new IpController();
        $controller->setDI($di);
        $controller->initialize();

        $res = $controller->indexAction();
        $this->assertIsObject($res);
    }

    public function testIndexActionGetTrue()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setGet("ip", "8.8.8.8");
        $this->controller->initialize();
        $res = $this->controller->indexActionGet();
        $this->assertIsArray($res);
    }

    public function testIndexActionGetFalse()
    {
        $this->controller->initialize();
        $res = $this->controller->indexActionGet();
        $this->assertIsArray($res);
    }
}
