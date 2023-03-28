<?php

namespace App\Model\Points;

interface Points
{
    public function uniqueLetterPoints(): int;

    public function palindromePoints(): int;

    public function almostPalindromePoints(): int;

    public function totalPoints(): int;
}