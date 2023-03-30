<?php

namespace App\Service;

use App\Model\Dictionary\Dictionary;
use App\Model\Dictionary\Exception\NotEnglishWordException;
use App\Model\HighScore\WordHighScore;
use App\Model\Points\ThreeTwoOneWordPoints;
use App\Model\User\GameUser;
use App\Model\Word\Exception\NotAWordException;
use App\Model\Word\Word;

class GameplayService
{
    private const PATH_HIGH_SCORE = __DIR__.'/../../src/Entity/HighScore/high-scores.json';

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

    /**
     * @throws NotAWordException
     * @throws NotEnglishWordException
     */
    public function highScore(string $word, string $username): array
    {
        if (!$this->checkBetterHighScore($word, $username)) {
            $wordProcessor = new Word($word);
            $pointsCalculator = new ThreeTwoOneWordPoints($wordProcessor);
            $userProcessor = new GameUser($username);
            $newHighScore = new WordHighScore($userProcessor, $pointsCalculator, $wordProcessor);

            $userProcessor->setHighScore($newHighScore);

            $highScores = [
                'points' => $newHighScore->getPoints(),
                'user' => $newHighScore->getUser(),
                'word' => $newHighScore->getWord(),
            ];

            $jsonHighScores = json_encode($highScores, JSON_PRETTY_PRINT);

            $filePointer = fopen(self::PATH_HIGH_SCORE, 'w');
            fwrite($filePointer, $jsonHighScores);
            fclose($filePointer);

            return $highScores;
        }

        return [];
    }

    /**
     * @throws NotAWordException
     * @throws NotEnglishWordException
     */
    private function checkBetterHighScore(string $user, string $word): bool
    {
        $jsonHighScores = file_get_contents(self::PATH_HIGH_SCORE);
        $highScores = json_decode($jsonHighScores, true);

        foreach ($highScores as $highScore) {
            if ($highScore['user'] == $user) {
                $wordProcessor = new Word($word);
                if ($this->play($wordProcessor->getWord()) > $highScore['points']) {
                    return true;
                }
            }
        }

        return false;
    }
}
