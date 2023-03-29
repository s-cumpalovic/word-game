<?php

namespace App\Model\Word;

use App\Model\Word\Exception\NotAWordException;

class Word
{
    private string $word;

    /**
     * @throws NotAWordException
     */
    public function __construct(string $word)
    {
        $this->setWord($word);
    }

    public function getWord(): string
    {
        return $this->word;
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

    /**
     * @throws NotAWordException
     */
    private function setWord(string $word): void
    {
        if (!ctype_alpha($word)) {
            throw new NotAWordException();
        }
        $this->word = trim(strtolower($word));
    }
}
