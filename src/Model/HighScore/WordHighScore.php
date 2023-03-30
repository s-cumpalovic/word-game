<?php

namespace App\Model\HighScore;

use App\Model\Points\Points;
use App\Model\User\User;
use App\Model\Word\Word;

class WordHighScore extends HighScore
{
    private Word $word;

    public function __construct(User $user, Points $points, Word $word)
    {
        parent::__construct($user, $points);
        $this->setWord($word);
    }

    public function getWord(): string
    {
        return $this->word->getWord();
    }

    private function setWord(Word $word): void
    {
        $this->word = $word;
    }
}
