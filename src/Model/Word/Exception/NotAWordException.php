<?php

namespace App\Model\Word\Exception;

use Exception;

class NotAWordException extends Exception
{
    public function __construct(string $message = "The word must consist of letters only.")
    {
        parent::__construct($message);
    }
}
