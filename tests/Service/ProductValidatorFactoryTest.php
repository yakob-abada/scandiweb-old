<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Service\BookValidator;
use Service\DvdValidator;
use Service\FurnitureValidator;
use Service\ProductValidator;
use Service\ProductValidatorFactory;

class ProductValidatorFactoryTest extends TestCase
{
    public function testCreatingProductValidator()
    {
        $product = new Product();

        $sut = new ProductValidatorFactory();
        $this->assertInstanceOf(ProductValidator::class, $sut->create($product));
    }

    public function testCreatingBookValidator()
    {
        $product = new Product();
        $product->setProductType(Product::PRODUCT_TYPE_BOOK);

        $sut = new ProductValidatorFactory();
        $this->assertInstanceOf(BookValidator::class, $sut->create($product));
    }

    public function testCreatingDvdValidator()
    {
        $product = new Product();
        $product->setProductType(Product::PRODUCT_TYPE_DVD);

        $sut = new ProductValidatorFactory();
        $this->assertInstanceOf(DvdValidator::class, $sut->create($product));
    }

    public function testCreatingFurnitureValidator()
    {
        $product = new Product();
        $product->setProductType(Product::PRODUCT_TYPE_FURNITURE);

        $sut = new ProductValidatorFactory();
        $this->assertInstanceOf(FurnitureValidator::class, $sut->create($product));
    }
}