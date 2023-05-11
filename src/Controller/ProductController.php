<?php

namespace Controller;

use Entity\Product;
use Repository\ProductRepository;
use Service\JsonResponse;
use Service\ProductValidatorFactory;

class ProductController 
{

    public function __construct(
        private ProductRepository $repository,
        private ProductValidatorFactory $productValidatorFactory,
    ) {}

    public function getAction() 
    {
        $sku = $_REQUEST['sku'] ?? '';
        $result = $this->repository->findbySku($sku);

        if (null === $result) {
            echo '404';
            die;
        }

        return JsonResponse::generate($result);
    }

    public function saveAction()
    {
        $isValid = $this->productValidatorFactory->create(new Product())->validate(new Product());

        if (!$isValid) {
            echo 401;
            die;
        }

        $this->repository->persist(new Product());
        echo JsonResponse::generate(['message' => 'created successfully'], 201);
    }
}
