<?php

namespace Service;

use Entity\Product;

class BookValidator extends ProductValidator 
{
    public function validate(Product $product): bool
    {
        parent::validate($product);
        $this->checkMissingProperties($product);

        return count($this->errorMessages) === 0;
    }
    
    private function checkMissingProperties(Product $product): void
    {
        if (Product::PRODUCT_TYPE_BOOK !== $product->getProductType()) {
            return;
        }

        $value = $product->getWeight();
        if (null === $value || '' === $value) {
            $this->errorMessages[] = 'Weight shouldn\'t be blank';
        }
    }
}