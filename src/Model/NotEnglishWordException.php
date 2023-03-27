<?php

namespace App\Model;

use Symfony\Component\Config\Definition\Exception\Exception;

class NotEnglishWordException extends Exception
{
    public function __construct(string $message = "Word is not an english word.")
    {
        parent::__construct($message);
    }
}