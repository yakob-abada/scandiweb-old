<?php

namespace Service;

class JsonResponse {
    public static function generate(array $data): void
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}