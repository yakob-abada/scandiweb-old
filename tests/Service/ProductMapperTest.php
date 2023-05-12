<?php

namespace Tests\Service;

use Entity\Product;
use PHPUnit\Framework\TestCase;
use Service\ProductMapper;

class ProductMapperTest extends TestCase
{
    public function testConvertToObject()
    {
        $request = [
            'name' => 'ProductName',
            'sku' => 'Sku100',
            'price' => 100,
            'productType' => 'dvd',
            'size' => 100
        ];

        $product = new Product();
        $product
            ->setName('ProductName')
            ->setSku('Sku100')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_DVD)
            ->setSize(100);

        $sut = new ProductMapper();
        $result = $sut->convertToObject($request);
        $this->assertEquals($product, $result);
    }

    public function testConvertToArray()
    {
        $data = [
            'name' => 'ProductName',
            'sku' => 'Sku100',
            'price' => 100,
            'productType' => 'dvd',
            'size' => 100,
            'weight' => null,
            'length' => null,
            'height' => null,
            'width' => null
        ];

        $product = new Product();
        $product
            ->setName('ProductName')
            ->setSku('Sku100')
            ->setPrice(100)
            ->setProductType(Product::PRODUCT_TYPE_DVD)
            ->setSize(100);

        $sut = new ProductMapper();
        $result = $sut->convertToArray($product);
        $this->assertEquals($data, $result);
    }
}