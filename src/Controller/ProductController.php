<?php

namespace Controller;

use Repository\ProductRepository;
use Service\JsonResponse;

class ProductController {

    public function __construct(private ProductRepository $repository) 
    {}

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
        echo 405;
    }
}
