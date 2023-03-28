<?php

namespace App\Model\Word;

class Word
{
    private string $word;

    public function __construct(string $word)
    {
        $this->word = trim(strtolower($word));
    }

    public function uniqueLetters(): int
    {
        return count(array_unique(str_split($this->word)));
    }

    public function isPalindrome(): bool
    {
        return $this->word === strrev($this->word);
    }

    public function isAlmostPalindrome(): bool
    {
        if (!$this->isPalindrome()) {
            $length = strlen($this->word);
            for ($i = 0; $i <= $length; $i++) {
                $newWord = substr_replace($this->word, '', $i, 1);
                if ($newWord === strrev($newWord)) {
                    return true;
                }
            }
        }
        return false;
    }
}