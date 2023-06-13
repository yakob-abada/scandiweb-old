<?php

namespace Bootstrap;

use Controller\ProductController;
use Repository\ProductRepository;
use Service\JsonRequest;
use Service\MysqliConnection;
use Service\ProductMapper;
use Service\ProductValidatorFactory;

class NewProductController implements NewControllerInterface
{
    public function create(): ProductController
    {
        return new ProductController(
            new ProductRepository(MysqliConnection::connect()), 
            new ProductValidatorFactory(new ProductRepository(MysqliConnection::connect())), new ProductMapper(), new JsonRequest());
    }
}