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
        $this->checkProductTypeValue($product);
        $this->checkDVDMissingPropertes($product);
        $this->checkBookMissingPropertes($product);
        $this->checkFurnitureMissingPropertes($product);

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

    private function checkProductTypeValue(Product $product): void
    {
        $value = $product->getProductType();
        if (null !== $value && '' !== $value && !in_array($value, Product::PRODUCT_TYPE_VALUES)) {
            $this->errorMessages[] = 'ProductType got wrong value';
        }
    }

    private function checkDVDMissingPropertes(Product $product): void
    {
        if (Product::PRODUCT_TYPE_DVD !== $product->getProductType()) {
            return;
        }

        $value = $product->getSize();
        if (null === $value || '' === $value) {
            $this->errorMessages[] = 'Size shouldn\'t be blank';
        }
    }

    private function checkBookMissingPropertes(Product $product): void
    {
        if (Product::PRODUCT_TYPE_BOOK !== $product->getProductType()) {
            return;
        }

        $value = $product->getWeight();
        if (null === $value || '' === $value) {
            $this->errorMessages[] = 'Weight shouldn\'t be blank';
        }
    }

    private function checkFurnitureMissingPropertes(Product $product): void
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