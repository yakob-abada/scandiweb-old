<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Service\FurnitureValidator;

class FurnitureValidatorTest extends TestCase
{
    public function testRightFurniture()
    {
        $this->assertTrue(true);
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_FURNITURE)
            ->setHeight(700)
            ->setLength(700)
            ->setWidth(700);

        $sut = new FurnitureValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertTrue($isValid);
        $this->assertEquals(0, count($errors));
    }

    public function testMissingProperties()
    {
        $this->assertTrue(true);
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_FURNITURE);

        $excpectedErrors = [
            'Height shouldn\'t be blank',
            'Length shouldn\'t be blank',
            'Width shouldn\'t be blank',
        ];

        $sut = new FurnitureValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }
}