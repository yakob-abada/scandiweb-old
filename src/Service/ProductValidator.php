<?php

namespace Service;

use Entity\Product;

class ProductValidator {
    private array $notBlank = [
        'sku',
        'name',
        'price',
        'productType',
    ];

    private array $errorMessages = [];

    public function validate(Product $product): bool
    {
        $this->checkNotBlank($product);

        return count($this->errorMessages) === 0;
    }

    public function getErrorMessages(): array 
    {
        return $this->errorMessages;
    }

    private function checkNotBlank(Product $product): void
    {
        foreach ($this->notBlank as $property) {
            $methodName = 'get' . ucfirst($property);

            if (!method_exists($product, $methodName)) {
                continue;
            }

            $value = $product->$methodName();

            if (null === $value || '' === $value) {
                $this->errorMessages[] = ucfirst($property) . ' shouldn\'t be blank';
            }
        }
    }
}