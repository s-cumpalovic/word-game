<?php

namespace App\Service;

use App\Model\Dictionary\Dictionary;
use App\Model\Dictionary\Exception\NotEnglishWordException;
use App\Model\Points\ThreeTwoOneWordPoints;
use App\Model\Word\Exception\NotAWordException;
use App\Model\Word\Word;

class GameplayService
{
    public function __construct(private Dictionary $dictionaryService)
    {
    }

    /**
     * @throws NotAWordException
     * @throws NotEnglishWordException
     */
    public function play(string $word): int
    {
        $wordProcessor = new Word($word);

        if (!$this->dictionaryService->checkIfWordInDictionary($wordProcessor)) {
            throw new NotEnglishWordException();
        }

        $pointCalculator = new ThreeTwoOneWordPoints($wordProcessor);

        return $pointCalculator->getTotalPoints();
    }
}
