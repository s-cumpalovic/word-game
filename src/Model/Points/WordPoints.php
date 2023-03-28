<?php

namespace App\Model\Points;

use App\Model\Word\Word;

class WordPoints extends Points
{
    private Word $word;

    public function __construct(Word $word)
    {
        $this->word = $word;
    }

    public function totalPoints(): int
    {
        return $this->uniqueLetterPoints() + $this->palindromePoints() + $this->almostPalindromePoints();
    }

    protected function uniqueLetterPoints(): int
    {
        return $this->word->uniqueLetters();
    }

    protected function palindromePoints(): int
    {
        if ($this->word->isPalindrome()) {
            return 3;
        }
        return 0;
    }

    protected function almostPalindromePoints(): int
    {
        if ($this->word->isAlmostPalindrome()) {
            return 2;
        }
        return 0;
    }
}
