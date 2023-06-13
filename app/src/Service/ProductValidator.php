<?php

namespace Service;

use Entity\Product;
use Repository\ProductRepository;

class ProductValidator 
{
    /**
     * @var ProductRepository
     */
    private $repository;
    public function __construct(ProductRepository $repository) 
    {
        $this->repository = $repository;
    }

    private $notBlank = [
        'sku',
        'name',
        'price',
        'productType',
    ];

    protected $errorMessages = [];

    public function validate(Product $product): bool
    {
        $this->checkSkuNotDuplicated($product);
        $this->checkNotBlank($product);
        $this->checkProductTypeValue($product);

        return count($this->errorMessages) === 0;
    }

    public function getErrorMessages(): array 
    {
        return $this->errorMessages;
    }
	
	private function checkSkuNotDuplicated(Product $product)
	{
		$value = $product->getSku() ?? '';
        $result = $this->repository->findbySku($value);

        if ($result !== null && count($result) > 0) {
            $this->errorMessages[] = 'Sku value is already exist';
        }
	}

    private function checkNotBlank(Product $product)
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

    private function checkProductTypeValue(Product $product)
    {
        $value = $product->getProductType();
        if (null !== $value && '' !== $value && !in_array($value, Product::PRODUCT_TYPE_VALUES)) {
            $this->errorMessages[] = 'ProductType got wrong value';
        }
    }
}