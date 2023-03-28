<?php

namespace App\Model\Word;

use App\Model\Word\Exception\NotAWord;

class Word
{
    private string $word;

    /**
     * @throws NotAWord
     */
    public function __construct(string $word)
    {
        $this->validateWord($word);
    }

    /**
     * @param $word
     * @return void
     * @throws NotAWord
     */
    private function validateWord($word): void
    {
        if (!ctype_alpha($word)) {
            throw new NotAWord();
        }
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