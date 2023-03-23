<?php

namespace App\Service;

use App\Service\DictionaryService;

class GameplayService
{
    public function __construct(private DictionaryService $dictionaryService)
    {

    }
#Route
    public function play(string $word): int
    {
        $points = null;

//        Unique letters points
        $points += $this->dictionaryService->uniqueLetterPoints($word);

//        Palindrome points
        if ($this->dictionaryService->checkIfPalindrome($word)) {
            $points += 3;
        }
//        Almost palindrome points
        if ($this->dictionaryService->checkIfAlmostPalindrome($word)) {
            $points += 2;
        }

        return $points;
    }
}



