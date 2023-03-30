<?php

namespace App\Model\Dictionary\Exception;

use Exception;

class NotEnglishWordException extends Exception
{
    public function __construct(string $message = "Word is not an english word.")
    {
        parent::__construct($message);
    }
}
