<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Repository\ProductRepository;
use Service\DvdValidator;

class DvdValidatorTest extends TestCase
{
    public function testRightDvd()
    {
        $this->assertTrue(true);
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_DVD)
            ->setSize(700);

        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findbySku')->with('Sku100')->willReturn(null);           

        $sut = new DvdValidator($mockRepository);
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
            ->setProductType(Product::PRODUCT_TYPE_DVD);

        $excpectedErrors = [
            'Size shouldn\'t be blank',
        ];

        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findbySku')->with('Sku100')->willReturn(null);           

        $sut = new DvdValidator($mockRepository);
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }
}