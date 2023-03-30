<?php

namespace App\Model\Dictionary;

use App\Model\Word\Word;

class EnglishDictionary implements Dictionary
{
    private array $englishWords;

    public function __construct()
    {
        /**
         * @var array $dictionaryFromAPI
         */
        $dictionaryFromAPI = json_decode(file_get_contents('https://raw.githubusercontent.com/dwyl/english-words/master/words_dictionary.json'), true);
        $this->englishWords = $dictionaryFromAPI;
    }

    public function checkIfWordInDictionary(Word $word): bool
    {
        $value = $word->getWord();

        return array_key_exists(strtolower($value), $this->englishWords);
    }
}
