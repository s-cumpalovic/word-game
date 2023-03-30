<?php

namespace App\Model\User;

use App\Model\HighScore\WordHighScore;

class GameUser extends User
{
    private WordHighScore $highScore;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function getHighScore(): WordHighScore
    {
        return $this->highScore;
    }

    public function setHighScore(WordHighScore $highScore): void
    {
        $this->highScore = $highScore;
    }
}
