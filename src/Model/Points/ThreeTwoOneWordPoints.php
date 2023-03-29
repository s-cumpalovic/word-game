<?php

namespace App\Model\Points;

use App\Model\Word\Word;

class ThreeTwoOneWordPoints extends WordPoints
{
    private const POINT_ZERO = 0;
    private const POINT_UNIQUE_LETTER = 1;
    private const POINT_PALINDROME = 3;
    private const POINT_ALMOST_PALINDROME = 2;

    public function __construct(Word $word)
    {
        return $this->word = $word;
    }

    public function uniqueLetterPoints(): int
    {
        return self::POINT_UNIQUE_LETTER * $this->word->uniqueLetters();
    }

    public function palindromePoints(): int
    {
        if ($this->word->isPalindrome()) {
            return self::POINT_PALINDROME;
        }
        return self::POINT_ZERO;
    }

    public function almostPalindromePoints(): int
    {
        if ($this->word->isAlmostPalindrome()) {
            return self::POINT_ALMOST_PALINDROME;
        }
        return self::POINT_ZERO;
    }
}