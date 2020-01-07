<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpGeoValidatorJsonTest extends TestCase
{


    protected function setUp()
    {
        global $di;
        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->controller = new IpGeoJsonController();
        $this->controller->setDI($this->di);
        $session = $di->get("session");
    }
    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $this->controller->initialize();
        $res = $this->controller->indexActionGet();
        $this->assertIsArray($res);
    }

    public function testIndexActionGetTrue()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->controller->initialize();
        $this->di->set("response", "\Anax\Response\Response");
        $request->setGet("ip", "8.8.8.8");
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
