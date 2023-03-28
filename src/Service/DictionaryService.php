<?php

namespace App\Service;

use App\Model\Interface\DictionaryInterface;

class DictionaryService implements DictionaryInterface
{
    private $englishWords;

    public function __construct()
    {
        $this->setDictionary();
    }

    public function getDictionary(): array|object
    {
        return json_decode(file_get_contents('https://raw.githubusercontent.com/dwyl/english-words/master/words_dictionary.json'), true);
    }

    public function setDictionary(): void
    {
        $this->englishWords = $this->getDictionary();
    }

    public function checkIfWordInDictionary(string $word): bool
    {
        if (array_key_exists(strtolower($word), $this->englishWords)) {
            return true;
        }
        return false;
    }


}



