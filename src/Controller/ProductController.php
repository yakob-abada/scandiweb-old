<?php

namespace Controller;

use Service\JsonResponse;

class ProductController {

    public function indexAction() {
        $data = array("a" => "Apple", "b" => "Ball", "c" => "Cat");

        return JsonResponse::generate($data);
    }
}
