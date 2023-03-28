<?php

namespace App\Model\Dictionary;

use App\Model\Word\Word;

interface Dictionary
{
    public function checkIfWordInDictionary(Word $word): bool;
}



