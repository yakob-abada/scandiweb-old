<?php

namespace Repository;

abstract class AbstractRepository 
{

    protected $mysqli;
    public function __construct(\mysqli $mysqli) 
    {
        $this->mysqli = $mysqli;
    }
}