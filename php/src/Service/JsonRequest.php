<?php

namespace Service;

class JsonRequest
{
    public function get(): string|bool
    {
        return file_get_contents('php://input');
    }
}