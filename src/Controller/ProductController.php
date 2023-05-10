<?php

namespace Controller;

use Entity\Product;
use Repository\ProductRepository;
use Service\JsonResponse;
use Service\ProductValidator;

class ProductController 
{

    public function __construct(
        private ProductRepository $repository,
        private ProductValidator $productValidator,
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
        $isValid = $this->productValidator->validate(new Product());

        if (!$isValid) {
            echo 401;
            die;
        }

        echo 405;
    }
}
