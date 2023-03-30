<?php

namespace App\Model\HighScore;

use App\Model\Points\Points;
use App\Model\User\User;
use App\Model\Word\Exception\NotAWordException;

class HighScore
{
    private Points $points;
    private User $user;

    /**
     * @throws NotAWordException
     */
    public function __construct(User $user, Points $points)
    {
        $this->setUser($user);
        $this->setPoints($points);
    }

    public function getUser(): string
    {
        return $this->user->getName();
    }

    public function getPoints(): int
    {
        return $this->points->getTotalPoints();
    }

    private function setPoints(Points $points): void
    {
        $this->points = $points;
    }

    private function setUser(User $user): void
    {
        $this->user = $user;
    }
}
