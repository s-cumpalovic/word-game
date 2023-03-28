<?php

namespace App\Model\Interface;

interface DictionaryInterface
{
    public function checkIfWordInDictionary(string $word): bool;
}