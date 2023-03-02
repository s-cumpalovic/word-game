<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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


    public function play(Request $request): JsonResponse
    {
        $wordsData = file_get_contents('https://raw.githubusercontent.com/dwyl/english-words/master/words_alpha.txt');
        $allEnglishWords = explode("\n", $wordsData);

        $word = trim(strtolower($request->getContent()));

        if (!in_array(strtolower($word), array_map('trim', $allEnglishWords))) {
            return new JsonResponse([
                'error' => 'Word not found in dictionary'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Points
        $points = null;
        $uniqueLettersPoints = count(array_unique(str_split($word)));
        $palindromePoints = $this->checkIfPalindrome($word);
        $almostPalindromePoints = $this->checkIfAlmostPalindrome($word);
        $points += $uniqueLettersPoints + $palindromePoints + $almostPalindromePoints;
        return new JsonResponse(['message' => $points]);
    }
}
