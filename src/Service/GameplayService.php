<?php

namespace App\Service;

use App\Model\Dictionary\Dictionary;
use App\Model\Points\WordPoints;
use App\Model\Word\Exception\NotAWordException;
use App\Model\Dictionary\Exception\NotEnglishWordException;
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
        $wordManager = new Word($word);
        $pointManager = new WordPoints($wordManager);

        if (!$this->dictionaryService->checkIfWordInDictionary($wordManager)) {
            throw new NotEnglishWordException();
        }

        return $pointManager->totalPoints();
    }
}
