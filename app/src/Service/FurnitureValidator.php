<?php

namespace Service;

use Entity\Product;

class FurnitureValidator extends ProductValidator 
{
    public function validate(Product $product): bool
    {
        parent::validate($product);
        $this->checkMissingProperties($product);

        return count($this->errorMessages) === 0;
    }

    private function checkMissingProperties(Product $product)
    {
        if (Product::PRODUCT_TYPE_FURNITURE !== $product->getProductType()) {
            return;
        }

        $value = $product->getHeight();
        if (null === $value || '' === $value) {
            $this->errorMessages[] = 'Height shouldn\'t be blank';
        }

        $value = $product->getLength();
        if (null === $value || '' === $value) {
            $this->errorMessages[] = 'Length shouldn\'t be blank';
        }

        $value = $product->getWidth();
        if (null === $value || '' === $value) {
            $this->errorMessages[] = 'Width shouldn\'t be blank';
        }
    }
}