<?php

namespace App\Service;

use App\Model\NotEnglishWordException;
use App\Model\Word;

class GameplayService
{
    public function __construct(private DictionaryService $dictionaryService)
    {

    }

    /**
     * @param Word $wordModel
     * @return int
     * @throws NotEnglishWordException
     */
    public function play(Word $wordModel): int
    {
        $word = $wordModel->getWordLowercase();

        if (!$this->dictionaryService->checkIfWordInDictionary($word)) {
            throw new NotEnglishWordException();
        }

        $points = null;

        $points += $wordModel->getUniqueLetters();

        if ($wordModel->getIsPalindrome()) {
            $points += 3;
        }

        if ($wordModel->getIsAlmostPalindrome()) {
            $points += 2;
        }
        return $points;
    }
}



