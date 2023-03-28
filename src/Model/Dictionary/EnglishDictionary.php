<?php

namespace App\Model\Dictionary;

use App\Model\Word\Word;

class EnglishDictionary implements Dictionary
{
    private array $englishWords;

    public function __construct()
    {
        $this->englishWords = json_decode(file_get_contents('https://raw.githubusercontent.com/dwyl/english-words/master/words_dictionary.json'), true);
    }

    public function checkIfWordInDictionary(Word $wordModel): bool
    {
        $word = $wordModel->getWord();
        return array_key_exists(strtolower($word), $this->englishWords);
    }
}
