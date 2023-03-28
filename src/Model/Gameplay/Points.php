<?php

namespace App\Model\Gameplay;

use App\Model\Word\Word;

class Points
{
    private int $points = 0;
    private Word $word;

    public function __construct(string $word)
    {
        $this->word = new Word($word);
        $this->uniqueLetterPoints();
        $this->isAlmostPalindromePoints();
        $this->isPalindromePoints();
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    private function uniqueLetterPoints(): void
    {
        $this->points += $this->word->uniqueLetters();
    }

    private function isPalindromePoints(): void
    {
        if ($this->word->isPalindrome()) {
            $this->points += 3;
        }

    }

    private function isAlmostPalindromePoints(): void
    {
        if ($this->word->isAlmostPalindrome()) {
            $this->points += 2;
        }

    }
}