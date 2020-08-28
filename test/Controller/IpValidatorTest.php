<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpValidatorTest extends TestCase
{


    protected function setUp()
    {
        global $di;
        $this->di = new DIFactoryConfig();
        $di = $this->di;
        // $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
        // $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/cache");
        $this->controller = new IpController();
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
        // $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        // $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $controller = new IpController();
        $controller->setDI($di);
        $controller->initialize();

        $res = $controller->indexAction();
        $this->assertIsObject($res);
    }

    public function testIndexActionPostTrue()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip", "8.8.8.8");
        $res = $this->controller->indexActionPost();
        $this->assertIsObject($res);
    }

    public function testIndexActionPostFalse()
    {

        $res = $this->controller->indexActionPost();
        $this->assertIsObject($res);
    }
}
