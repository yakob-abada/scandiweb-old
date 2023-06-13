<?php

namespace Service;

use Entity\Product;
use Repository\ProductRepository;

class ProductValidatorFactory {
    private $repository;
    public function __construct(ProductRepository $repository) 
    {
        $this->repository = $repository;
    }
    public function create(Product $product): ProductValidator 
    {
        switch($product->getProductType()) {
            case Product::PRODUCT_TYPE_BOOK:
                return new BookValidator($this->repository);
            case Product::PRODUCT_TYPE_DVD:
                return new DvdValidator($this->repository);
            case Product::PRODUCT_TYPE_FURNITURE:
                return new FurnitureValidator($this->repository);
            default:
                return new ProductValidator($this->repository);
        }
    }
}