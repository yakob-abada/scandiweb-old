<?php

namespace Controller;

use Entity\Product;
use Repository\ProductRepository;
use Service\JsonResponse;
use Service\ProductMapper;
use Service\ProductValidatorFactory;

class ProductController 
{

    public function __construct(
        private ProductRepository $repository,
        private ProductValidatorFactory $productValidatorFactory,
        private ProductMapper $productMapper
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
        $product = $this->productMapper->convertToObject($_REQUEST);
        $isValid = $this->productValidatorFactory->create(new Product())->validate($product);

        if (!$isValid) {
            echo 401;
            die;
        }

        $this->repository->persist($product);
        echo JsonResponse::generate(['message' => 'created successfully'], 201);
    }
}
