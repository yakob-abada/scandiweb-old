<?php

namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use Service\JsonResponse;

class JsonResponseTest extends TestCase
{
    public function testGenerateJsonResponse()
    {
        $this->expectOutputString(json_encode(['name' => 'Jakob']));
        JsonResponse::generate(['name' => 'Jakob']);
    }
}