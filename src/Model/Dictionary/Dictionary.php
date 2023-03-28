<?php

namespace App\Model\Dictionary;

interface Dictionary
{
    public function checkIfWordInDictionary(string $word): bool;
}



