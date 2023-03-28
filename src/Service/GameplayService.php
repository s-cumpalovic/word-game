<?php

namespace App\Service;

use App\Model\Dictionary\Dictionary;
use App\Model\Points\WordPoints;
use App\Model\Word\Exception\NotAWord;

class GameplayService
{
    public function __construct(private Dictionary $dictionaryService)
    {

    }

    /**
     * @param string $word
     * @return int
     * @throws NotAWord
     */
    public function play(string $word): int
    {
        $pointManager = new WordPoints($word);
        $this->dictionaryService->checkIfWordInDictionary($word);
        return $pointManager->totalPoints();
    }
}



