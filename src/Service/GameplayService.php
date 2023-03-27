<?php

namespace App\Service;

use App\Model\NotEnglishWordException;

class GameplayService
{
    public function __construct(private DictionaryService $dictionaryService)
    {

    }

    /**
     * @param string $word
     * @return int
     * @throws NotEnglishWordException
     */
    public function play(string $word): int
    {
        if (!$this->dictionaryService->checkIfEnglishWord($word)) {
            throw new NotEnglishWordException();
        }

        $points = null;

        $points += $this->dictionaryService->uniqueLetterPoints($word);

        if ($this->dictionaryService->checkIfPalindrome($word)) {
            $points += 3;
        }

        if ($this->dictionaryService->checkIfAlmostPalindrome($word)) {
            $points += 2;
        }
        return $points;
    }
}



