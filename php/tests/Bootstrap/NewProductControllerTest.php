<?php

namespace Tests\Service;

use Bootstrap\NewProductController;
use Controller\ProductController;
use PHPUnit\Framework\TestCase;

class NewProductControllerTest extends TestCase
{
    public function testCreatingNewController() 
    {
        $this->assertTrue(true);
        define("HOST", "db");
        define("USERNAME", "scandiweb-user");
        define("PASSWORD", "Admin_123");
        define("DB", "scandiweb");

        $sut = new NewProductController();
        $controller = $sut->create();

        $this->assertInstanceOf(ProductController::class, $controller);
    }
}