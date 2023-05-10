<?php

namespace Bootstrap;

use Controller\ProductController;
use Repository\ProductRepository;
use Service\ProductValidator;

class NewProductController implements NewControllerInterface
{
    public function create(): ProductController
    {
        $mysqli = new \mysqli(HOST, USERNAME, PASSWORD, DB);

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        return new ProductController(new ProductRepository($mysqli), new ProductValidator());
    }
}