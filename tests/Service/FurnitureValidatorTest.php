<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Repository\ProductRepository;
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

        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findbySku')->with('Sku100')->willReturn(null);      

        $sut = new FurnitureValidator($mockRepository);
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

        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findbySku')->with('Sku100')->willReturn(null);      

        $sut = new FurnitureValidator($mockRepository);
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }
}