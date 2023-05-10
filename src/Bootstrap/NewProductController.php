<?php

namespace Bootstrap;

use Controller\ProductController;
use Repository\ProductRepository;

class NewProductController implements NewControllerInterface
{
    public function create(): ProductController
    {
        $mysqli = new \mysqli("localhost","root","","scandiweb");

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        return new ProductController(new ProductRepository($mysqli));
    }
}