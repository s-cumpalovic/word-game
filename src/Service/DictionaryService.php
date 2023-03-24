<?php

namespace App\Service;

use PhpParser\Node\Expr\Array_;

class DictionaryService
{

    private $englishWords;

    public function __construct()
    {
        $this->englishWords = json_decode(file_get_contents('https://raw.githubusercontent.com/dwyl/english-words/master/words_dictionary.json'), true);
    }

    public function checkIfEnglishWord(string $word): bool
    {
        if (array_key_exists(strtolower($word), $this->englishWords)) {
            return true;
        }
        return false;
    }

    public function uniqueLetterPoints(string $word): int
    {
        return count(array_unique(str_split($word)));
    }

    public function checkIfPalindrome(string $word): bool
    {
        if ($word === strrev($word)) {
            return true;
        }
        return false;
    }

    public function checkIfAlmostPalindrome(string $word): bool
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
}



