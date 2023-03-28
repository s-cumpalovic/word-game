<?php

namespace App\Service;

use App\Model\Dictionary\EnglishDictionary;
use App\Model\Gameplay\Points;
use App\Model\Word\Exception\NotEnglishWordException;

class GameplayService
{
    public function __construct(private EnglishDictionary $dictionaryService)
    {

    }

    /**
     * @param string $word
     * @return int
     * @throws NotEnglishWordException
     */
    public function play(string $word): int
    {
        if (!$this->dictionaryService->checkIfWordInDictionary($word)) {
            throw new NotEnglishWordException();
        }

        $pointManager = new Points($word);
        return $pointManager->getPoints();
    }
}



