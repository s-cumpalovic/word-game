<?php

namespace App\Model\Dictionary;

class EnglishDictionary implements Dictionary
{
    private array $englishWords;

    public function __construct()
    {
        $this->englishWords = json_decode(file_get_contents('https://raw.githubusercontent.com/dwyl/english-words/master/words_dictionary.json'), true);
    }

    public function checkIfWordInDictionary(string $word): bool
    {
        return array_key_exists(strtolower($word), $this->englishWords);
    }
}