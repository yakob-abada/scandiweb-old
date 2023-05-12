<?php

namespace Bootstrap;

use Controller\ProductController;
use Repository\ProductRepository;
use Service\ProductMapper;
use Service\ProductValidatorFactory;

class NewProductController implements NewControllerInterface
{
    public function create(): ProductController
    {
        $mysqli = new \mysqli(HOST, USERNAME, PASSWORD, DB);

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        return new ProductController(new ProductRepository($mysqli), new ProductValidatorFactory(), new ProductMapper());
    }
}