<?php

namespace Repository;

abstract class AbstractRepository 
{

    public function __construct(protected \mysqli $mysqli) {}
}