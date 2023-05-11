<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Repository\ProductRepository;

class ProductRepositoryTest extends TestCase
{
    public function testPersistProduct()
    {
        $product = new Product();
        $product
            ->setSku('sku')
            ->setName('productName')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_BOOK)
            ->setWeight(100);

        $mockMysqli = $this->getMockBuilder(\mysqli::class)
            ->setConstructorArgs(['localhost', 'root', '', 'scandiweb'])
            ->getMock();

        $mockMysqli
            ->expects($this->once())
            ->method('query')
            ->with("insert into product (sky, name, price, product_type, size, weight, height, length, width) values ('sku', 'productName', 100, 'book', null, 100, null, null, null)");
  
        $mockMysqli->expects($this->once())->method('close');

        $sut = new ProductRepository($mockMysqli);
        $sut->persist($product);
    }

    // public function testFindbySku()
    // {
    //     $mockMysqli = $this->getMockBuilder(\mysqli::class)
    //     ->setConstructorArgs(['localhost', 'root', '', 'scandiweb'])
    //     ->getMock();

    //     $mockMysqli
    //         ->expects($this->once())
    //         ->method('real_query')
    //         ->with("SELECT * FROM product WHERE sku = 'sku100'");

    //     $mockMysqli->expects($this->once())->method('close');

    //     $sut = new ProductRepository($mockMysqli);
    //     $sut->findbySku('sku100');
    // }
}