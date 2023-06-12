<?php

namespace Service;

class MysqliConnection 
{
    public static function connect(): \mysqli
    {
        $mysqli =  new \mysqli(HOST, USERNAME, PASSWORD, DB);

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        return $mysqli;
    }
}