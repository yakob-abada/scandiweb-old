<?php

namespace Service;

use Entity\Product;

class ProductValidatorFactory {
    public function create(Product $product): ProductValidator 
    {
        switch($product->getProductType()) {
            case Product::PRODUCT_TYPE_BOOK:
                return new BookValidator();
            case Product::PRODUCT_TYPE_DVD:
                return new DvdValidator();
            case Product::PRODUCT_TYPE_FURNITURE:
                return new FurnitureValidator();
            default:
                return new ProductValidator;
        }
    }
}