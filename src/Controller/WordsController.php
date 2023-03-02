<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Word;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class WordsController extends AbstractController
{
    private function checkIfPalindrome($word)
    {
        if ($word === strrev($word)) {
            return 3;
        }

        return null;
    }

    private function checkIfAlmostPalindrome($word)
    {
        $length = strlen($word);

        for ($i = 0; $i <= $length; $i++) {
            $newWord = substr_replace($word, '', $i, 1);
            if ($newWord === strrev($newWord)) {
                return 2;
            }
        }

        return null;
    }

    public function play(ManagerRegistry $doctrine,  Request $request): JsonResponse
    {
        $allEnglishWords = file('https://raw.githubusercontent.com/dwyl/english-words/master/words_alpha.txt');

        $requestBody = json_decode($request->getContent(), true);
        $word = trim(strtolower($requestBody['word']));
        $user = $requestBody['user'];

        if (!in_array(strtolower($word), array_map('trim', $allEnglishWords))) {
            return new JsonResponse([
                'error' => 'Word not found in dictionary'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Points
        $points = null;
        $uniqueLettersPoints = count(array_unique(str_split($word)));
        $palindromePoints = $this->checkIfPalindrome($word);
        $almostPalindromePoints = null;
        if (!$palindromePoints) {
            $almostPalindromePoints = $this->checkIfAlmostPalindrome($word);
        }
        $points += $uniqueLettersPoints + $palindromePoints + $almostPalindromePoints;

        // User
        $userExists = $doctrine->getRepository(User::class)->findOneBy([
            'name' => $user
        ]);

        $userEntity = null;

        if (!$userExists) {
            $userEntity = new User();
        } else {
            $userEntity = $userExists;
        }
        $userEntity->setName($user);
        $currentPoints = $userEntity->getPoints();
        if ($currentPoints < $points) {
            $userEntity->setPoints($points);
        }
        // Store word in database

        $wordEntity = new Word();
        $wordEntity->setWord($word)
            ->setPoints($points)
            ->setPalindrome($palindromePoints)
            ->setAlmostPalindrome($almostPalindromePoints)
            ->setUser($userEntity);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($userEntity);
        $entityManager->persist($wordEntity);
        $entityManager->flush();

        return new JsonResponse(['points' => $points, 'user' => $user]);
    }

    public function highscores(EntityManagerInterface $entityManager): JsonResponse
    {
        $query = $entityManager->createQueryBuilder()
            ->select('user')
            ->from(User::class, 'user')
            ->orderBy('user.points', 'DESC')
            ->setMaxResults(10)
            ->getQuery();

        $results = $query->getResult();
        $highScores = [];

        foreach ($results as $user) {
            $highScores[] = [
                'name' => $user->getName(),
                'points' => $user->getPoints()
            ];
        }
        return new JsonResponse($highScores, JsonResponse::HTTP_OK);
    }
}
