<?php

namespace Jiad\Dice;

use Anax\Controller\SampleAppController;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class DiceControllerTest extends TestCase
{
    private $controller;
    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $app = $di;
        $di->set("app", $app);
        // Create and initiate the controller
        $this->controller = new DiceController();
        $this->controller->setApp($app);
        // $this->controller->initialize();
    }


    /**
     * Call the controller index action.
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertIsString($res);
        // $this->assertStringEndsWith("active", $res);
        $this->assertEquals($res, "Index!");
    }


    // /**
    //  * Call the controller index action.
    //  */
    // public function testInitAction()
    // {
    //     $res = $this->controller->initAction();
    //     $this->assertIsObject($res);
    //     // $this->assertStringEndsWith("active", $res);
    //     // $this->assertEquals($res, "Index!");
    // }
}
