<?php

namespace App\Model\Points;

use App\Model\Word\Exception\NotAWord;
use App\Model\Word\Word;

class WordPoints implements Points
{
    private Word $word;

    /**
     * @param string $word
     * @throws NotAWord
     */
    public function __construct(string $word)
    {
        $this->word = new Word($word);
    }

    public function uniqueLetterPoints(): int
    {
        return $this->word->uniqueLetters();
    }

    public function palindromePoints(): int
    {
        if ($this->word->isPalindrome()) {
            return 3;
        }
        return 0;
    }

    public function almostPalindromePoints(): int
    {
        if ($this->word->isAlmostPalindrome()) {
            return 2;
        }
        return 0;
    }

    public function totalPoints(): int
    {
        return $this->uniqueLetterPoints() + $this->palindromePoints() + $this->almostPalindromePoints();
    }
}