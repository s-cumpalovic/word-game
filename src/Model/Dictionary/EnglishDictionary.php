<?php

namespace App\Model\Dictionary;

use App\Model\Dictionary\Exception\NotEnglishWordException;

class EnglishDictionary implements Dictionary
{
    private array $englishWords;

    public function __construct()
    {
        $this->englishWords = json_decode(file_get_contents('https://raw.githubusercontent.com/dwyl/english-words/master/words_dictionary.json'), true);
    }

    /**
     * @param string $word
     * @return bool
     * @throws NotEnglishWordException
     */
    public function checkIfWordInDictionary(string $word): bool
    {
        if (!array_key_exists(strtolower($word), $this->englishWords)) {
            throw new NotEnglishWordException();
        }
        return true;
    }
}