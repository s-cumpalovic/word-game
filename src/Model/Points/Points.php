<?php

namespace App\Model\Points;

abstract class Points
{
    abstract protected function uniqueLetterPoints(): int;

    abstract protected function palindromePoints(): int;

    abstract protected function almostPalindromePoints(): int;

    abstract public function totalPoints(): int;
}
