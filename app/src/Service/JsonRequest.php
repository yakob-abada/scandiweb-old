<?php

namespace Service;

class JsonRequest
{
    public function get()
    {
        return file_get_contents('php://input');
    }
}