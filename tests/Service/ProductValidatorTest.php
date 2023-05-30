<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Repository\ProductRepository;
use Service\ProductValidator;

class ProductValidatorTest extends TestCase
{
    public function testPropertiesAreBlank()
    {
        $this->assertTrue(true);
        $product = new Product();

        $excpectedErrors = [
            'Sku shouldn\'t be blank',
            'Name shouldn\'t be blank',
            'Price shouldn\'t be blank',
            'ProductType shouldn\'t be blank',
        ];

        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findbySku')->with('')->willReturn(null);

        $sut = new ProductValidator($mockRepository);
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }

    public function testWrongProductType()
    {
        $this->assertTrue(true);
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType('test');

        $excpectedErrors = [
            'ProductType got wrong value',
        ];

        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findbySku')->with('Sku100')->willReturn(null);

        $sut = new ProductValidator($mockRepository);
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }
}