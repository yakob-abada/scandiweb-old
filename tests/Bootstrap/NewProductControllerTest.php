<?php

namespace Tests\Service;

use Bootstrap\NewProductController;
use Controller\ProductController;
use PHPUnit\Framework\TestCase;

class NewProductControllerTest extends TestCase
{
    public function testCreatingNewController() 
    {
        define("HOST", "localhost");
        define("USERNAME", "root");
        define("PASSWORD", "");
        define("DB", "");

        $this->getMockBuilder(\mysqli::class)->getMock();

        $sut = new NewProductController();
        $controller = $sut->create();

        $this->assertInstanceOf(ProductController::class, $controller);
    }
}