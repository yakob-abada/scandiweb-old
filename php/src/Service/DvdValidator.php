<?php

namespace Service;

use Entity\Product;

class DvdValidator extends ProductValidator
{
    public function validate(Product $product): bool
    {
        parent::validate($product);
        $this->checkMissingProperties($product);

        return count($this->errorMessages) === 0;
    }
    
    private function checkMissingProperties(Product $product): void
    {
        if (Product::PRODUCT_TYPE_DVD !== $product->getProductType()) {
            return;
        }

        $value = $product->getSize();
        if (null === $value || '' === $value) {
            $this->errorMessages[] = 'Size shouldn\'t be blank';
        }
    }
}