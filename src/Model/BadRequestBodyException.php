<?php

namespace App\Model;

use Symfony\Component\Config\Definition\Exception\Exception;

class BadRequestBodyException extends Exception
{
    public function __construct(string $message = "Bad request")
    {
        parent::__construct($message);
    }
}