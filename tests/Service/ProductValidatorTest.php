<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Service\ProductValidator;

class ProductValidatorTest extends TestCase
{
    public function testRightDvDProduct()
    {
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_DVD)
            ->setSize(700);

        $sut = new ProductValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertTrue($isValid);
        $this->assertEquals(0, count($errors));
    }

    public function testRightBookProduct()
    {
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_BOOK)
            ->setWeight(700);

        $sut = new ProductValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertTrue($isValid);
        $this->assertEquals(0, count($errors));
    }

    public function testPropertiesAreBlank()
    {
        $product = new Product();

        $excpectedErrors = [
            'Sku shouldn\'t be blank',
            'Name shouldn\'t be blank',
            'Price shouldn\'t be blank',
            'ProductType shouldn\'t be blank',
        ];

        $sut = new ProductValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }

    public function testWrongProductType()
    {
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType('test');

        $excpectedErrors = [
            'ProductType got wrong value',
        ];

        $sut = new ProductValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }

    public function testMissingPropertiesDVD()
    {
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_DVD);

        $excpectedErrors = [
            'Size shouldn\'t be blank',
        ];

        $sut = new ProductValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }

    public function testMissingPropertiesBook()
    {
        $product = new Product();
        $product
            ->setSku('Sku100')
            ->setName('name')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_BOOK);

        $excpectedErrors = [
            'Weight shouldn\'t be blank',
        ];

        $sut = new ProductValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }

    public function testMissingPropertiesFurniture()
    {
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

        $sut = new ProductValidator();
        $isValid = $sut->validate($product);
        $errors = $sut->getErrorMessages();

        $this->assertFalse($isValid);
        $this->assertEquals($excpectedErrors, $errors);
    }
}