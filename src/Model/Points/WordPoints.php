<?php

namespace App\Model\Points;

use App\Model\Word\Word;

abstract class WordPoints implements Points
{
    protected Word $word;

    public function getTotalPoints(): int
    {
        return $this->uniqueLetterPoints() + $this->palindromePoints() + $this->almostPalindromePoints();
    }

    abstract public function uniqueLetterPoints(): int;

    abstract public function palindromePoints(): int;

    abstract public function almostPalindromePoints(): int;
}
