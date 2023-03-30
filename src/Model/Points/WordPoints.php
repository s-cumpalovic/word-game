<?php

namespace App\Model\Points;

use App\Model\Word\Word;

abstract class WordPoints implements Points
{
    private Word $word;

    public function __construct(Word $word)
    {
        $this->setWord($word);
    }

    public function getTotalPoints(): int
    {
        return $this->uniqueLetterPoints() + $this->palindromePoints() + $this->almostPalindromePoints();
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    abstract public function uniqueLetterPoints(): int;

    abstract public function palindromePoints(): int;

    abstract public function almostPalindromePoints(): int;

    private function setWord(Word $word): void
    {
        $this->word = $word;
    }
}
