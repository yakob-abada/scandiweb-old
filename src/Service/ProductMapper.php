<?php

namespace Service;
use Entity\Product;

class ProductMapper 
{
    public function convertToObject(array $data): Product
    {
        $product = new Product();
        $product
            ->setSku($data['sku'] ?? null)
            ->setName($data['name'] ?? null)
            ->setPrice($data['price'] ?? null)
            ->setProductType($data['productType'] ?? null)
            ->setSize($data['size'] ?? null)
            ->setWeight($data['weight'] ?? null)
            ->setLength($data['length'] ?? null)
            ->setHeight($data['heigth'] ?? null)
            ->setWidth($data['width'] ?? null);

        return $product;
    }

    public function convertToArray(Product $product): array
    {
        $data = [
            'sku' => $product->getSku(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'productType' => $product->getProductType(),
            'size' => $product->getSize(),
            'weight' => $product->getWeight(),
            'length' => $product->getLength(),
            'heigth' => $product->getHeight(),
            'width' => $product->getWidth()
        ];

        return $data;
    }
}