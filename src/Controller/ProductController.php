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
            return JsonResponse::generate(['messages' => 'product not found'], 404);
        }

        return JsonResponse::generate($result);
    }

    public function saveAction()
    {
        $product = $this->productMapper->convertToObject($_REQUEST);
        $validator = $this->productValidatorFactory->create($product);
        $isValid = $validator->validate($product);

        if (!$isValid) {
            return JsonResponse::generate(['messages' => $validator->getErrorMessages()], 401);
        }

        $this->repository->persist($product);
        return JsonResponse::generate(['message' => 'created successfully'], 201);
    }
}
