<?php

namespace Controller;

use Repository\ProductRepository;
use Service\JsonResponse;

class ProductController {

    public function __construct(private ProductRepository $repository) 
    {}

    public function getAction() 
    {
        return JsonResponse::generate($this->repository->findbySku('SKU100'));
    }
}
