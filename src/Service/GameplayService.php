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
        $word = $wordModel->toLowercase()->getWord();

        if (!$this->dictionaryService->checkIfEnglishWord($word)) {
            throw new NotEnglishWordException();
        }

        $points = null;

        $points += $wordModel->uniqueLetterPoints($word);

        if ($wordModel->isPalindrome) {
            $points += 3;
        }

        if ($wordModel->isAlmostPalindrome) {
            $points += 2;
        }
        return $points;
    }
}



