<?php

namespace App\Entity\Traits;

trait WordTrait
{
    protected function uniqueLetterPoints(string $word): int
    {
        return count(array_unique(str_split($word)));
    }

    protected function checkIfPalindrome(string $word): bool
    {
        if ($word === strrev($word)) {
            return true;
        }
        return false;
    }

    protected function checkIfAlmostPalindrome(string $word): bool
    {
        if (!$this->checkIfPalindrome($word)) {
            $length = strlen($word);
            for ($i = 0; $i <= $length; $i++) {
                $newWord = substr_replace($word, '', $i, 1);
                if ($this->checkIfPalindrome($newWord)) {
                    return true;
                }
            }
        }
        return false;
    }

    protected function toLowercase(string $word): string
    {
        return trim(strtolower($word));
    }
}