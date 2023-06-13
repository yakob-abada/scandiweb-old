<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Repository\ProductRepository;
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

        $mockRepository = $this->createMock(ProductRepository::class);

        $sut = new ProductValidatorFactory($mockRepository);
        $this->assertInstanceOf(ProductValidator::class, $sut->create($product));
    }

    public function testCreatingBookValidator()
    {
        $product = new Product();
        $product->setProductType(Product::PRODUCT_TYPE_BOOK);

        $mockRepository = $this->createMock(ProductRepository::class);

        $sut = new ProductValidatorFactory($mockRepository);
        $this->assertInstanceOf(BookValidator::class, $sut->create($product));
    }

    public function testCreatingDvdValidator()
    {
        $product = new Product();
        $product->setProductType(Product::PRODUCT_TYPE_DVD);

        $mockRepository = $this->createMock(ProductRepository::class);

        $sut = new ProductValidatorFactory($mockRepository);
        $this->assertInstanceOf(DvdValidator::class, $sut->create($product));
    }

    public function testCreatingFurnitureValidator()
    {
        $product = new Product();
        $product->setProductType(Product::PRODUCT_TYPE_FURNITURE);

        $mockRepository = $this->createMock(ProductRepository::class);   

        $sut = new ProductValidatorFactory($mockRepository);
        $this->assertInstanceOf(FurnitureValidator::class, $sut->create($product));
    }
}